<?php

namespace App\Http\Controllers\Frontend\Chat;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\ChatUser;
use App\Models\LoginDetailActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.Chat.chat');
    }

    public function getUser(Request $request)
    {
        $users = fetch_user();
        return response()->json(['success' => true, 'data' => $users]);
    }

    public function updateLastActivity(Request $request)
    {
        $activity = LoginDetailActivity::where("user_id", Auth::user()->id)->latest()->first();
        $last_update = LoginDetailActivity::where('id', $activity->id)->update([
            'last_activity' => Carbon::now()
        ]);

        return response()->json(['success' => true, 'data' => $last_update]);
    }

    public function fetchGroupChatHistory(Request $request)
    {
        if ($request->action == "insert_data") {

            $chat = ChatMessage::create([
                'from_user_id' => Auth::user()->id,
                'chat_message' =>  $request->chat_message,
                'status' =>  1,
            ]);
            if ($chat) {
                $result = fetch_group_chat_history();
                return response()->json(['success' => true, 'data' => $result]);
            }
        }
        if ($request->action == "fetch_data") {
            $result = fetch_group_chat_history();
            return response()->json(['success' => true, 'data' => $result]);
        } else {
            return response()->json(['success' => false, 'data' => []]);
        }
    }

    public function fetchUserChatHistory(Request $request)
    {
        $result = fetch_user_chat_history(Auth::user()->id, $request->to_user_id);
        return response()->json(['success' => true, 'data' => $result]);
    }

    public function insertChat(Request $request)
    {
        $chat = ChatMessage::create([
            'to_user_id' => $request->to_user_id,
            'from_user_id' => Auth::user()->id,
            'chat_message' => $request->chat_message,
            'status' => 1,
        ]);
        if ($chat) {
            $result = fetch_user_chat_history(Auth::user()->id, $request->to_user_id);
            return response()->json(['success' => true, 'data' => $result]);
        } else {
            return response()->json(['success' => false, 'data' => []]);
        }
    }

    public function updateIsTypeStatus(Request $request)
    {
        $activity = LoginDetailActivity::where("user_id", Auth::user()->id)->latest()->first();
        LoginDetailActivity::where('id', $activity->id)->update([
            'is_type' => $request->is_type
        ]);

        return response()->json(['success' => true, 'data' => true]);
    }

    public function removeChat(Request $request)
    {
        $remove_chat = ChatMessage::where('id', $request->chat_message_id)->update([
            'status' => 2
        ]);

        return response()->json(['success' => true, 'data' => $remove_chat]);
    }

    public function uploadFile(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'image'    => 'required|mimes:png,jpg,jpeg',
        ]);


        if ($validation->fails()) {
            return response()->json(['success' => false, 'data' => $validation]);
        }
        if ($request->has('image')) {
            $image  = uploadImage($request->image, storage_path('app/public/uploads/chat/'));
            $target_path = env('APP_URL') . 'uploads/chat/' . $image;
            if (empty($request->message)) {
                $chat = ChatMessage::create([
                    'to_user_id' => $request->to_user_id,
                    'from_user_id' => Auth::user()->id,
                    'images' => $image,
                    'status' => 1,
                ]);
            }
            if ($chat) {
                $result = fetch_user_chat_history(Auth::user()->id, $request->to_user_id);
                return response()->json(['success' => true, 'data' => $result]);
            } else {
                return response()->json(['success' => false, 'data' => []]);
            }
        } else {
            return response()->json(['success' => false, 'data' => false]);
        }
    }

    public function chatUsers(Request $request)
    {
        if (session('session_id')) {
            $session_id = session('session_id');
        } else {
            $session_id = md5(uniqid() . mt_rand());
        }
        Session::put('session_id', $session_id);
        if (ChatUser::where(['to_user_id' => $request->to_user_id, 'from_user_id' => $request->from_user_id])->exists()) {
            ChatUser::where(['to_user_id' => $request->to_user_id, 'from_user_id' => $request->from_user_id])->update([
                'session_id' => $session_id,
                'to_user_id' => $request->to_user_id,
                'from_user_id' => $request->from_user_id
            ]);
        } else {
            ChatUser::create([
                'session_id' => $session_id,
                'to_user_id' => $request->to_user_id,
                'from_user_id' => $request->from_user_id
            ]);
        }
    }


}
