<?php

namespace App\Http\Livewire\Salidas;

use Livewire\Component;
use App\Models\Salida;

class SalidasComponente extends Component
{
    public function render()
    {
        return view('livewire.salidas.salidas-componente',[
            'salida' => Salida::all()
        ]);
    }
}
