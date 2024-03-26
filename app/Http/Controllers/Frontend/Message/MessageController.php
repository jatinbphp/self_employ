<?php

namespace App\Http\Controllers\Frontend\Message;

use App\Http\Controllers\Controller;
use App\Lib\PusherFactory;
use App\Models\LoginDetailActivity;
use App\Models\Post;
use App\Models\Message;
use App\Models\User;
use App\Models\UserLoginHistory;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Pusher\Pusher;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function fullchat(Request $request)
    {
        $user_id = Auth::user()->id;
        $query = User::query();
        
        $query->whereHas('chat_messages_send', function ($cms) use ($user_id) {
            $cms->where('from_user', $user_id);
        })->orWhereHas('chat_messages_receive', function ($cmr) use ($user_id) {
            $cmr->where('to_user', $user_id);
        })->with('getUserLoginHistory', function ($q) {
            $q->where('status', 'active');
        })->with('chat_messages_receive', function ($cmr) use ($user_id){
            $cmr->where('to_user', $user_id)->take(1)->orderBy('created_at', 'ASC');
        });
        
        if($request->ajax())
        {
            $output="";
            $query->when(request('search'), function ($q) {
                return $q->where('first_name', 'like', '%'.request('search').'%');
                // ->orWhere('last_name','LIKE','%'.$search."%");
            });

            $users = $query->get();

            foreach($users as $user) {
                if ($user) {
                    $content = isset($user->chat_messages_receive[0]) ? Str::limit($user->chat_messages_receive[0]->content, 20) : '';
                    $output.= '<div class="select-chtbx1">'.
                            '<a href="javasrpit:void(0)" class="chat-toggle1" data-id="'. $user->id .'"'.
                                'data-user="'. $user->name .'">'.
                                '<div class="chatimgleft">
                                    <img src="'. $user->profile_image .'">'.
                                    // {{-- <img src="{{ asset('assets/images/defult-user1.png') }}"> --}}
                                '</div>'.
                                // if (count($user->getUserLoginHistory) > 0)
                                //     <em style="background: #21F174;width: 8px;height: 8px;display: inline-block; border-radius: 50%; margin-right: 4px;"></em>
                                // @else
                                //     <em style="background: #f10017;width: 8px;height: 8px;display: inline-block; border-radius: 50%; margin-right: 4px;"></em>
                                // @endif
                                '<div class="chat-txtbxright">
                                    <h4>'. $user->name .'</h4>'.
                                    '<p>'. $content .'</p>'.
                                '</div>'.
                            '</a>'.
                        '</div>';   
                }
            }

            return response($output);

        }
     
        $users = $query->get();
     
        return view('frontend.Chat.full-chat', ['users' => $users]);
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $users = User::whereRelation('chat_messages_send', function ($cms) use ($user_id) {
            $cms->where('from_user', $user_id);
        })->orWhereRelation('chat_messages_receive', function ($cmr) use ($user_id) {
            $cmr->where('to_user', $user_id);
        })->with('getUserLoginHistory', function ($query) {
            $query->where('status', 'active');
        })->get();

        return view('frontend.Chat.chat', ['users' => $users]);
    }
    /**
     * getLoadLatestMessages
     *
     *
     * @param Request $request
     */

    public function getLoadLatestMessages(Request $request)
    {
        if (!$request->user_id) {
            return;
        }
        $messages = Message::wherePostId($request->project_id)->where(function ($query) use ($request) {
            $query->where('from_user', Auth::user()->id)->where('to_user', $request->user_id)->where('post_id', $request->project_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('from_user', $request->user_id)->where('to_user', Auth::user()->id)->where('post_id', $request->project_id);
        })->orderBy('created_at', 'ASC')->get();

        $return = [];
        foreach ($messages as $message) {
            $return[] = view('frontend.Chat.message-line')->with('message', $message)->render();
        }
        return response()->json(['state' => 1, 'messages' => $return]);
    }

    public function getReadMessages(Request $request)
    {
        if (!$request->project_id) {
            return;
        }
        $messages = Message::wherePostId($request->project_id)->where('to_user', Auth::user()->id)->update(array('read' => 1));

        $unread = Message::with('post')->where('to_user', Auth::user()->id)->where('read', 0)->get();
        $unread_count = count($unread);
        
        return response()->json(['state' => 1, 'unread' => $unread_count]);
    }

    public function getNotoficationRead(Request $request)
    {
        $messages = Notification::where('to', Auth::user()->id)->update(array('read' => 1));
        
        return response()->json(['state' => 1]);
    }

    /**
     * postSendMessage
     *
     * @param Request $request
     */
    public function postSendMessage(Request $request)
    {

        if (!$request->to_user || !$request->message) {
            return;
        }
        $message = new Message();
        $message->from_user = Auth::user()->id;
        $message->to_user = $request->to_user;
        $message->content = "";
        $message->image = "";
        $message->post_id = $request->post_id;
        $message->type = $request->type;
        if ($request->message != '' && $request->message != null && $request->message != 'null') {
            $message->content = $request->message;
        } else {

            if ($request->hasFile("image")) {
                $filename = $this->uploadImage($request);
                $message->image = $filename;
            }
        }

        $message->save();
        // prepare some data to send with the response
        $message->dateTimeStr = date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString()));
        $message->dateHumanReadable = $message->created_at->diffForHumans();
        $message->fromUserName = $message->fromUser->name;
        $message->from_user_id = Auth::user()->id;
        $message->toUserName = $message->toUser->name;
        $message->to_user_id = $request->to_user;
        $message->post_name = $message->post->name;
        $message->post_status = $message->post->status;
        $message->is_poster = ($message->post->user_id == Auth::user()->id)?0:1;
        $message->type = $request->type;
        PusherFactory::make()->trigger('chat', 'send', ['data' => $message]);

        return response()->json(['state' => 1, 'data' => $message, "poster" => $message->post->user_id]);
    }

    /**
     * getOldMessages
     *
     * we will fetch the old messages using the last sent id from the request
     * by querying the created at date
     *
     * @param Request $request
     */
    public function getOldMessages(Request $request)
    {
        if (!$request->old_message_id || !$request->to_user)
            return;
        $message = Message::find($request->old_message_id);
        $lastMessages = Message::where(function ($query) use ($request, $message) {
            $query->where('from_user', Auth::user()->id)
                ->where('to_user', $request->to_user)
                ->where('created_at', '<', $message->created_at);
        })->orWhere(function ($query) use ($request, $message) {
            $query->where('from_user', $request->to_user)
                ->where('to_user', Auth::user()->id)
                ->where('created_at', '<', $message->created_at);
        })->orderBy('created_at', 'ASC')
        ->get();
        //->limit(10)
        $return = [];

        $noMoreMessages = true;
        /*$previousMessages = $this->getPreviousMessages($request, $message);
        if ($previousMessages->count() > 0) {
            foreach ($previousMessages as $message) {
                $return[] = view('frontend.Chat.message-line')->with('message', $message)->render();
            }
            $noMoreMessages = !($this->getPreviousMessages($request, $previousMessages[$previousMessages->count() - 1])->count() > 0);
            PusherFactory::make()->trigger('chat', 'oldMsgs', ['to_user' => $request->to_user, 'data' => $return]);
        }*/
        if ($lastMessages->count() > 0) {
            foreach ($lastMessages as $message) {
                $return[] = view('frontend.Chat.message-line')->with('message', $message)->render();
            }
            PusherFactory::make()->trigger('chat', 'oldMsgs', ['to_user' => $request->to_user, 'data' => $return]);
        }
        return response()->json(['state' => 1, 'data' => $return, 'no_more_messages' => $noMoreMessages]);
    }

    /**
     * @param Request $request
     * @param $message
     * @return mixed
     */
    private function uploadImage($request)
    {

        $file = $request->file('image');
        //$filename = md5(uniqid()) . "." . $file->getClientOriginalExtension();
        $filename = time() . "." . $file->getClientOriginalExtension();

        $file->move(public_path('uploads/chat/'), $filename);

        return $filename;
    }

    /**
     * @param Request $request
     * @param $message
     * @return mixed
     */
    public function makeSeen(Request $request)
    {
        $message = Message::where('to_user_id', $request->to_user)->where('from_user', Auth::user()->id)->where('read', 0)->latest();
        if ($message) {
            Message::where('to_user_id', $request->to_user)->where('from_user', Auth::user()->id)->update([
                'read' => 1
            ]);
        }

        return response()->json(['success' => true], 200);
    }



    /**
     * @param Request $request
     * @param $message
     * @return mixed
     */
    private function getPreviousMessages(Request $request, $message)
    {
        $previousMessages = Message::where(function ($query) use ($request, $message) {
            $query->where('from_user', Auth::user()->id)
                ->where('to_user', $request->to_user)
                ->where('created_at', '<', $message->created_at);
        })
            ->orWhere(function ($query) use ($request, $message) {
                $query->where('from_user', $request->to_user)
                    ->where('to_user', Auth::user()->id)
                    ->where('created_at', '<', $message->created_at);
            })
            ->orderBy('created_at', 'DESC')->limit(10)->get();

        return $previousMessages;
    }

    public function getMessageSenderHtml($message)
    {
        return `<div class="second-user msg_container base_sent receive-txt" data-message-id="{{ $message->id }}"
        id="message-line-{{ $message->id }}">
                <div class="user-title01">
                    <span>{{ substr($message->fromUser->first_name, 0, 1) }}</span>
                </div>
                <p>
                    @if ($message->content)
                        {!! $message->content !!}
                    @else
                        @if (explode('.', $message->image)[1] == 'jpg' ||
                            (explode('.', $message->image)[1] == ('jpeg')(explode('.', $message->image))[1]) == 'png')
                            <img src="{{ $message->image_url }}">
                        @elseif(explode('.', $message->image)[1] == 'pdf')
                            <a href="images/test.pdf">test.pdf</a>
                        @elseif(explode('.', $message->image)[1] == 'docx' || explode('.', $message->image)[1] == 'doc')
                            <a href="images/test.docx">test.docx</a>
                        @elseif(explode('.', $message->image)[1] == 'xlxs' || explode('.', $message->image)[1] == 'csv')
                            <a href="images/test.xlxs">test.xlxs</a>
                        @else
                            <a href="images/test.pdf">test.pdf</a>
                        @endif
                    @endif
                    <time datetime="{{ date('Y-m-dTH:i', strtotime($message->created_at->toDateTimeString())) }}">
                        {{ $message->created_at->diffForHumans() }}
                        <img src="{{ asset('assets/images/doubletick.png') }}">
                    </time>
                </p>
            </div>`;
    }

    public function getMessageReceiverHtml($message)
    {
        return ``;
    }
}
