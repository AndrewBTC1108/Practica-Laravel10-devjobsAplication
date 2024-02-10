<?php

namespace App\Livewire;

use Livewire\Component;

class MostrarAlerta extends Component
{
    //bedemos pasarle la variable
    public $message;

    public function render()
    {
        return view('livewire.mostrar-alerta');
    }
}
