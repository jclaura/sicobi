<?php

namespace App\Http\Livewire\Sistema;

use Livewire\Component; 
use App\Models\Systemvar;  

class PrincipalComponente extends Component
{
    public $nombre_empresa, $desc_empresa;

    public function mount(){    
        $userId = auth()->user()->id;       
        $empresa = Systemvar::get()->first();   
        $this->nombre_empresa = $empresa->nom_empresa_sys;   
        $this->desc_empresa = $empresa->desc_empresa_sys; 
    }  
    public function render()
    {
        return view('livewire.sistema.principal-componente');
    }
} 
