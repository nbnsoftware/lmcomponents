<?php

namespace nbnsoftware;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;



class LMComponentsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lmcomponents');

        //
    }
}