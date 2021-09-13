<?php

namespace App\Http\Livewire\Depositos;

use Livewire\Component;
use App\Models\Deposito;

class DepositosComponente extends Component
{

    //CAMPOS DE LA TABLA EN EL FORMULARIO    
    public $nom_dep;//CAMPOS FECHA POR DEFAULT FECHA ACTUAL
    public $dir_dep;//CAMPO VALIDADO
    public $supervisor_dep;//CAMPOS VALIDADO    

    //VARIABLES GLOBAL 
    public $ids; 

    protected $listeners = ['destroy'];

    //REGLAS DE VALIDACION DE FORMULARIO
    protected $rules = [    
        'nom_dep'   => 'required|min:5|max:20|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*.)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',                                 
        'dir_dep'   => 'required|min:5|max:50|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*.)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',                        
        'supervisor_dep'   => 'required|min:5|max:100|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*.)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',                        
    ];

    protected $messages = [       
        'nom_dep.required' => 'Nombre de depósito requerido',             
        'nom_dep.min' => 'Nombre de depósito debe contener mínimo 5 caracteres',
        'nom_dep.max' => 'Nombre de depósito debe contener máximo 20 caracteres',        
        'dir_dep.required' => 'Dirección de depósito requerido',             
        'dir_dep.min' => 'Dirección de depósito debe contener mínimo 5 caracteres',
        'dir_dep.max' => 'Dirección de depósito debe contener máximo 50 caracteres',    
        'supervisor_dep.required' => 'Supervisor requerido',             
        'supervisor_dep.min' => 'Supervisor debe contener mínimo 5 caracteres',
        'supervisor_dep.max' => 'Supervisor debe contener máximo 100 caracteres', 
    ];

    public function resetVar(){
        $this->reset(['nom_dep', 'dir_dep', 'supervisor_dep']);        
    }    

    public function render()
    {
        return view('livewire.depositos.depositos-componente', [
            'depositos' => Deposito::all()
        ]);
    }

    public function store()
    {        
        $this->validate();
        Deposito::create([
            'nom_dep' => ucfirst($this->nom_dep),
            'dir_dep'  => ucfirst($this->dir_dep),                       
            'supervisor_dep' => ucfirst($this->supervisor_dep),            
        ]);                                      
        $this->emit('alert',['type'=>'success','message'=>'Registro guardado']);         
        $this->resetVar();              
        $this->emit('HideCreateDepositoModal');                                                
    }

    public function edit($id)
    {       
        $this->resetValidation(); 
        $deposito = Deposito::find($id);    
        $this->ids = $deposito->id;          
        $this->nom_dep = $deposito->nom_dep;
        $this->dir_dep = $deposito->dir_dep;
        $this->supervisor_dep = $deposito->supervisor_dep;        
        $this->emit('ShowEditDepositoModal');               
    }

    public function update(){                
        $this->validate();         
        if ($this->ids) {            
            $deposito =Deposito::find($this->ids);            
            $deposito->update([                
                'nom_dep' => $this->nom_dep,                      
                'dir_dep' => $this->dir_dep,
                'supervisor_dep' => $this->supervisor_dep                                           
            ]);            
            $this->emit('alert',['type'=>'success','message'=>'Registro actualizado']);                    
            $this->resetVar();
            $this->emit('HideEditDepositoModal');             
        }  
    }   

    public function destroy(Deposito $registro){        
        $registro->delete();                  
    }
}
