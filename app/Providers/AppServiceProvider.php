<?php

namespace App\Providers;

use App\Models\ArticleFiles;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
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

        Schema::defaultStringLength(191);
        Validator::extend('uniqueFileName', function ($attribute, $value, $parameters, $validator) {
            $field = $parameters[0];

            $fileName = ArticleFiles::where('fileName', $field)->first();
            if ($fileName) {
                return $value == $fileName;
            }
            return $value != $fileName;
        });
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
