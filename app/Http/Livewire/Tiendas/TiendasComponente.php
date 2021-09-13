<?php

namespace App\Http\Livewire\Tiendas;

use Livewire\Component;
use App\Models\Tienda;

use Carbon\Carbon;

class TiendasComponente extends Component
{

    //CAMPOS DE LA TABLA EN EL FORMULARIO    
    public $nom_tienda;//CAMPOS FECHA POR DEFAULT FECHA ACTUAL
    public $dir_tienda;//CAMPO VALIDADO
    public $fecha_ini_tienda;//CAMPOS VALIDADO    


    //VARIABLES GLOBAL 
    public $ids;

    protected $listeners = ['destroy'];

    //REGLAS DE VALIDACION DE FORMULARIO
    protected $rules = [    
        'nom_tienda'   => 'required|min:5|max:30|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',                                 
        'dir_tienda'   => 'required|min:5|max:50|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*.)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',                               
    ];

    protected $messages = [       
        'nom_tienda.required' => 'Nombre de tienda requerido',             
        'nom_tienda.min' => 'Nombre de tienda debe contener mínimo 5 caracteres',
        'nom_tienda.max' => 'Nombre de tienda debe contener máximo 30 caracteres',        
        'nom_tienda.regex' => 'Formato de entrada no válido',        
        'dir_tienda.required' => 'Dirección de tienda requerido',             
        'dir_tienda.min' => 'Dirección de tienda debe contener mínimo 5 caracteres',
        'dir_tienda.max' => 'Dirección de tienda debe contener máximo 50 caracteres',        
        'dir_tienda.regex' => 'Formato de entrada no válido', 
    ];

    public function resetVar(){
        $this->reset(['nom_tienda', 'dir_tienda']);        
    }

    public function mount(){                                                             
        $this->fecha_ini_tienda = Carbon::now()->format('Y-m-d');               
    }

    public function render()
    {
        return view('livewire.tiendas.tiendas-componente', [
            'tiendas' => Tienda::all()
        ]);
    }

    public function store()
    {            
        $this->validate();
        Tienda::create([
            'nom_tienda' => ucfirst($this->nom_tienda),
            'dir_tienda'  => ucfirst($this->dir_tienda),                       
            'fecha_ini_tienda' => $this->fecha_ini_tienda,            
        ]);                                      
        $this->emit('alert',['type'=>'success','message'=>'Registro guardado']);         
        $this->resetVar();              
        $this->emit('HideCreateTiendaModal');     
    }

    public function edit($id)
    {       
        $this->resetValidation(); 
        $tienda = Tienda::find($id);    
        $this->ids = $tienda->id;          
        $this->nom_tienda = $tienda->nom_tienda;
        $this->dir_tienda = $tienda->dir_tienda;
        $this->fecha_ini_tienda = $tienda->fecha_ini_tienda;        
        $this->emit('ShowEditTiendaModal');              
    }

    public function update(){                
        $this->validate();         
        if ($this->ids) {            
            $tienda =Tienda::find($this->ids);            
            $tienda->update([                
                'nom_tienda' => ucfirst($this->nom_tienda),
                'dir_tienda'  => ucfirst($this->dir_tienda),                       
                'fecha_ini_tienda' => $this->fecha_ini_tienda,                                                 
            ]);            
            $this->emit('alert',['type'=>'success','message'=>'Registro actualizado']);                    
            $this->resetVar();
            $this->emit('HideEditTiendaModal');             
        }  
    }   

    public function destroy(Tienda $registro){        
        $registro->delete();                  
    }
}
