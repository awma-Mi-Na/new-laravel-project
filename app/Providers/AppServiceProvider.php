<?php

namespace App\Providers;

use App\Models\User;
use App\Services\Newsletter;
use App\Services\MailchimpNewsletter;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(Newsletter::class, function () {
            $client = new ApiClient();

            $client->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us20'
            ]);
            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //? set all attributes of tables in db to be unguarded
        Model::unguard();

        Gate::define('admin', function (User $user) {
            return $user->username === 'awma123';
        });

        Blade::if('admin', function () {

            if ((auth()->user()) !== null)
                return Auth::user()->can('admin');
        });

        // Gate::define('user_check', function (User $user) {
        //     if (auth()->user() !== null) {
        //         return auth()->user()->username === $user->username;
        //     }
        //     return false;
        // });
    }
}
