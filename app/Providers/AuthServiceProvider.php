<?php

namespace Corp\Providers;

use Corp\Models\Article;
use Corp\Policies\ArticlePolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Article::class => ArticlePolicy::class
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('VIEW_ADMIN', function ($user){
            return $user->canDo('VIEW_ADMIN'); // true if user have permission
        });

        $gate->define('VIEW_ARTICLES', function ($user){
            return $user->canDo('VIEW_ARTICLES'); // true if user have permission
        });

    }
}
