<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Services\MailChimpNewsletter;
use App\Services\Newsletter;
use MailchimpMarketing\ApiClient;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use App\Models\User;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //registrar cosas en el service container: contiene un conjunto de valores llave-valor
        app()->bind(Newsletter::class, function() {
            $client = new ApiClient();

            $client->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us18'
            ]);

            return new MailChimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useTailwind();   //es el valor por defecto así que no hace falta ponerlo
        //Model::unguard; //e importarlo arriba. Para no tener que añadir protected $guarded en cada modelo. Impide request()->all().

        //Autorización: permite entrar a determinadas rutas a algunos usuarios y a otros no
        Gate::define('admin', function (User $user) {
            return $user->username === 'admin';
        });

        //Para crear una directiva tipo @admin en lugar de @can o @if en blade
        Blade::if('admin', function () {
            //php8: return request()->user()?->can('admin');

            if(null !== (request()->user())){
                return request()->user()->can('admin');
            }
        });
    }
}
