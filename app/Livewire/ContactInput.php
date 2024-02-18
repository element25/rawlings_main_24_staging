<?php

namespace App\Livewire;

use Livewire\Component;

class ContactInput extends Component
{
    public $inputname;

    public $placeholder;

    #[Modelable]
    public $inputvalue;

    public function render()
    {
        return view('livewire.contact-input');
    }
}
