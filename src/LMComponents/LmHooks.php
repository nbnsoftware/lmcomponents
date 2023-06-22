<?php

namespace nbnsoftware\LMComponents;

use Livewire\WithPagination;

trait LmHooks {

    use WithPagination;
    protected $rules=[];


    public $object;
    public function Hook($method) {
        if (method_exists($this,"$method")) {
            return $this->{"$method"}();
        }
        return null;
    }

}
