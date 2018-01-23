<?php

namespace Alyahmmed\MediasciMail;

use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->publishes([__DIR__ . '/plugin/config' => base_path('/config')]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
