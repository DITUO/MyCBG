<?php

namespace App\Providers;

use App\Model\Reply;
use App\Model\Topic;
use App\Observers\ReplyObserver;
use App\Observers\TopicObserver;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
	\Carbon\Carbon::setLocale('zh');
	Reply::observe(ReplyObserver::class);
	Topic::observe(TopicObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
