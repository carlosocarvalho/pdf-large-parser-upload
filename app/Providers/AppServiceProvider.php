<?php

namespace App\Providers;

use App\Observers\AttachmentObserver;
use Illuminate\Support\ServiceProvider;
use Orchid\Attachment\Models\Attachment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        Attachment::observe(AttachmentObserver::class);
    }
}
