<?php

namespace App\View\Components\Lm\Input;

use Illuminate\View\Component;

class BelongsTo extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $model;
    public $relation;

    public function __construct($model="",$title="")
    {
        //
        $parts=explode(".",$model);
        $this->relation=$parts[0];
        $this->model=$parts[1]??"";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.lm.input.belongs-to');
    }
}
