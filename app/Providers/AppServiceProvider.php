<?php

namespace App\Providers;

use App\Models\AddCredit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('*', function ($view) {
            // Check if the user is logged in
            if (Auth::check()) {
                $userId = auth()->id();
                // Calculate the total amount for the logged-in user
                $totalAmount = AddCredit::where('user_id', $userId)->sum('amount');
                $view->with('totalAmount', $totalAmount);
            } else {
                // Optionally, you can pass null or an empty value when no user is logged in
                $view->with('totalAmount', null);
            }
        });
    }
}
