<?php

namespace nbnsoftware\LMComponents;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use TuNombreDeUsuario\LMComponents\Components\Table;
use TuNombreDeUsuario\LMComponents\Components\Input;

class LMComponentsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lmcomponents');

        Blade::component('lmcomponents-table', Table::class);
        Blade::component('lmcomponents-input', Input::class);
    }
}