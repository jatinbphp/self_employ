<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Composers\MessagesComposer;
use App\View\Composers\NotificationComposer;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.layouts.header', MessagesComposer::class);
        View::composer('frontend.Chat.full-chat', MessagesComposer::class);
        View::composer('frontend.layouts.header', NotificationComposer::class);
    }
}
