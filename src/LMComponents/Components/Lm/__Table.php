<?php

namespace App\View\Components\Lm;

use Illuminate\View\Component;

class __Table extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $builder;
    public $title;
    public $query;  //?
    public $columns;
    public $additions;
    public $editions;
    public $deletions;
    public function __construct($columns,$title="",$additions="false",$editions="false",$deletions="false")
    {
        //
        $this->title = $title;
        $this->columns=$columns;
        $this->additions = $additions;
        $this->editions = $editions;
        $this->deletions = $deletions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.lm.table');
    }
}
