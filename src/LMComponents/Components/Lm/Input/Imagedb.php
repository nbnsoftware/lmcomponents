<?php

namespace App\View\Components\Lm\Input;

use Illuminate\View\Component;

class Imagedb extends Component
{
    public $label;
    public $disabled;
    public $width;
    public $height;
    public $required;
    public $myid;
    public $background; // background url when no image loaded
    public $readonly;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label="",$disabled='',$width=1024,$height=768,$required="",$id="",$background="",$readonly=false)
    {
        $this->label = $label;
        $this->disabled=$disabled;
        $this->width=$width;
        $this->height=$height;
        $this->required=$required=="required";
        $this->myid=$id;
        $this->background=$background;
        $this->readonly=$readonly;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.lm.input.imagedb');
    }
}
