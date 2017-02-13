<?php

namespace App\Providers;

use App\Article;
use App\Policies\ArticlePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Article::class => ArticlePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */

    public function boot()
    {
        $this->registerPolicies();

        /* Gate::define('add-content', function (User $user) {

             foreach ($user->roles as $role) {
                 if($role->name == 'Admin') {
                     return true;
                 }
             }

             return false;


         });

         Gate::define('update-content', function (User $user, $article) {

                 if($user->id == $article->user_id) {
                     return true;
                 }

             return false;
         });

 */


        //

    }
}
