<?php

namespace App\View\Components\Lm\Input;

use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $model;
    public $title;
    public $name;
    public $label;

    public function __construct($model="",$title="",$name="",$label="")
    {
        //
        $this->model = $model;
        $this->title = $title;
        $this->name = $name;

        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.lm.input.select');
    }
}
