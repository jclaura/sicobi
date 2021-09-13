<?php

namespace App\Http\Livewire\Empresa;

use Livewire\Component;
use App\Models\Systemvar; 

class EmpresaComponente extends Component
{
    //VARIABLE DE FORMULARIO DE TABLA
    public $nom_empresa_sys, $desc_empresa_sys, $tipo_cambio_sys, $utilidad_sys, $iva_sys, $it_sys;
    //VARIABLES GLOBAL 
    public $ids;

    //REGLAS DE VALIDACION DE FORMULARIO
    protected $rules = [   
        'nom_empresa_sys'  => 'required',                     
        'tipo_cambio_sys'  => 'required|numeric',
        'utilidad_sys'  => 'required|numeric',
        'iva_sys'  => 'required|numeric',
        'it_sys'  => 'required|numeric',
    ]; 
    
    public function render()
    {
        return view('livewire.empresa.empresa-componente', [
            'empresa' => Systemvar::all()
        ]);
    }

    public function edit($id){        
        $sistema = Systemvar::find($id);  
        $this->ids = $sistema->id;  
            
        $this->nom_empresa_sys = $sistema->nom_empresa_sys; 
        $this->desc_empresa_sys = $sistema->desc_empresa_sys; 
        $this->tipo_cambio_sys = $sistema->tipo_cambio_sys; 
        $this->utilidad_sys = $sistema->utilidad_sys; 
        $this->iva_sys = $sistema->iva_sys; 
        $this->it_sys = $sistema->it_sys;
        $this->emit('ShowEditEmpresaModal');
    }

    public function update(){
        if ($this->ids) {            
            $sistema =Systemvar::find($this->ids);
        }
        
        $sistema->nom_empresa_sys = $this->nom_empresa_sys;
        $sistema->desc_empresa_sys = $this->desc_empresa_sys;
        $sistema->tipo_cambio_sys = $this->tipo_cambio_sys;
        $sistema->utilidad_sys = $this->utilidad_sys;
        $sistema->iva_sys = $this->iva_sys;
        $sistema->it_sys = $this->it_sys;

        if($sistema->isDirty()){                        
            $sistema->save();
            $this->emit('alert',['type'=>'success','message'=>'Registro actualizado']); 
        }
        else
        {
            $this->emit('alert',['type'=>'info','message'=>'Nada para actualizar']); 
        }       
        
        $this->emit('HideEditEmpresaModal');
    }
}
                                                                     