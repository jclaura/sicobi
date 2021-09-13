<?php

namespace App\Http\Livewire\Entradas;

use Livewire\Component;
use App\Models\Entrada; 

class EntradasComponente extends Component
{
   
    public function render()
    {
        return view('livewire.entradas.entradas-componente', [
            'entradas' => Entrada::all()
        ]);
    }
}
