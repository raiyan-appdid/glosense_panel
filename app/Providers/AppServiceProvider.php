<?php

namespace App\Providers;

use App\Models\BusinessSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $businessSettings = BusinessSetting::all();
        // foreach ($businessSettings as $data) {
        //     $info[] = [
        //         $data->key => $data->value,
        //     ];
        // }
        // $businessSettings = (!$businessSettings->isEmpty()) ? (array_merge(...$info)) : [];
        // view()->share('businessSettings', $businessSettings);
    }
}
