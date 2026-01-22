<?php

namespace App\Providers;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['components.book.create-modal', 'components.book.edit-modal'], function ($view) {
           $authors = Author::all();

           $view->with('authors', $authors);
        });

        Gate::define('book-edit', function (User $user, Book $book) {
            return $user->id === $book->owner_id || $user->hasRole('admin');
        });
    }
}
