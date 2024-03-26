<?php

namespace App\View\Composers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\View\View;

class NotificationComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $userId = auth()->user()->id ?? 0;
        $notifications = Notification::limit(20)->orderBy('created_at', 'DESC')->where('to', null)->orWhere('to', $userId)->get();
        $unread = Notification::where('to', $userId)->where('read', 0)->get();
        $unread_count = count($unread);
        
        $view->with(['notifications'=>$notifications, 'unread_notification_count'=>$unread_count]);
    }
}