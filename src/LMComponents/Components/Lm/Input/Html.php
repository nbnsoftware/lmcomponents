<?php

namespace App\View\Components\Lm\Input;

use Illuminate\View\Component;

class Html extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $model;
    public $title;
    public function __construct($model="",$title="")
    {
        //
        $this->model = $model;
        $this->title = $title;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.lm.input.html');
    }
}
