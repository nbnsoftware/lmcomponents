<?php

namespace App\View\Components\Lm;

use Illuminate\View\Component;
use Illuminate\View\View;


class _Table extends Component
{


    public function __construct(
        public $name,
        public $title="",
        public $query="",
        public $columns=[],
        public $additions=false,
        public $editions=false,
        public $object="object",
        public $pagination=false,
    ) {


    }



    public function render(): View
    {

        return view('components.lm.table');
    }
}


