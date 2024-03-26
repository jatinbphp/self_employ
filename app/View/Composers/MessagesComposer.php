<?php

namespace App\View\Composers;

use App\Models\Message;
use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;

class MessagesComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $userId = auth()->user()->id ?? 0;
        $messages = Message::with('post')->where('from_user', $userId)->orWhere('to_user', $userId)->latest()->get();
        $unread = Message::with('post')->where('to_user', $userId)->where('read', 0)->get();
        $unread_count = count($unread);

        $unique = $messages->unique('post_id');
        $unique = $unique->take(5);
        // for ($i = 0; $i < count($unique) ; $i++ ){
        //     $messages = Message::with('post')->where('from_user', $unique[$i]->post_id)->where('read', 0)->get();
        //     $unique[$i]["unread"] = count($messages);
        // }
        foreach ($unique as $each) {
            $messages = Message::with('post')->where('post_id', $each->post_id)->where('to_user', $userId)->where('read', 0)->get();
            $post = Post::where('id', $each->post_id)->first();
            $each["unread"] = count($messages);
            $each['is_poster'] = $post->user_id==$userId?1:0;
            $each['post_status'] = $post->status;
        }
        $view->with(['messages'=>$unique, 'unread'=>$unread_count]);
    }
}
