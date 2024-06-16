<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Category; //category model imported 


use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /*public function update(User $user, Category $category)   //i tried category instead of post from wk-9 slides
    {
        return $user->id === $category->user_id;
    }*/

    /*public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    } */

    /**
     * Bootstrap any application services.
     */
    
    
     public function boot(): void
    {
        Gate::define('is_admin', function(User $user) {
            return $user->role == 'admin';
        });
        Gate::define('is_user', function(User $user) {
            return $user->role == 'user';
        });
    }
}
