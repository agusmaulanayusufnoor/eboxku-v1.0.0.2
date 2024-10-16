<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class DateTimeServiceProvider extends ServiceProvider
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
        Carbon::setLocale('id'); // Set locale ke bahasa Indonesia

        view()->composer('*', function ($view) {
            $currentDateTime = Carbon::now();
            $dayName = $currentDateTime->translatedFormat('l'); // Nama hari dalam bahasa Indonesia
            $formattedDate = $currentDateTime->format('d-m-Y'); // Format tanggal dd-mm-yyyy

            $view->with('currentDate', "$dayName, $formattedDate");
            $view->with('currentTime', $currentDateTime->toTimeString());
        });
    }
}
