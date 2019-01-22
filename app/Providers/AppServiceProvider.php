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

        Validator::extend('greater_than_field', function ($attribute, $value, $parameters, $validator) {
            $min_field = $parameters[0];
            $data = $validator->getData();
            $min_value = $data[$min_field];
            return $value > $min_value;
        });
        Validator::extend('greater_than_now', function ($attribute, $value, $parameters, $validator) {

            return $value >= date("Y-m-d");
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
