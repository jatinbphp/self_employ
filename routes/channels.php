<?php

use Illuminate\Support\Facades\Broadcast;

use App\Models\User;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('user.{userId}', function ($user, $userId) {
  if ($user->id === $userId) {
    return array('name' => $user->name);
  }
});

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('online', function (User $user) {
    
    if (auth()->check()) {
        return $user->toArray();
    }
    
});

Broadcast::channel('notification', function(){
        return true;
});