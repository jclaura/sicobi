<?php

namespace App\Http\Livewire\Compras;

use Livewire\Component;

//ADICIONADO
use App\Models\Compra;   
use Livewire\WithPagination;

use Carbon\Carbon;

class ComprasComponente extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //CAMPOS DE LA TABLA EN EL FORMULARIO    
    public $fecha_com;//CAMPOS FECHA POR DEFAULT FECHA ACTUAL
    public $items_com;//CAMPOS FECHA POR DEFAULT FECHA ACTUAL
    public $tipo_com;//CAMPO VALIDADO
    public $moneda_com='Yuan';//CAMPOS VALIDADO
    public $pais_com='China';//CAMPO  VALIDADO
    public $comprador_com;//CAMPO VALIDADO    

    //VARIABLES GLOBAL 
    public $ids;

    protected $listeners = ['destroy'];

    //REGLAS DE VALIDACION DE FORMULARIO
    protected $rules = [    
        'tipo_com'  => 'required|numeric',  
        'moneda_com'  => 'required|min:4|max:15|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
        'pais_com'  => 'required|min:4|max:15|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',          
        'comprador_com'  => 'required|min:5|max:50|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'                
    ];

    protected $messages = [       
        'tipo_com.required' => 'Tipo de cambio requerido',
        'tipo_com.numeric' => 'Debe ser numérico',
        'moneda_com.required' => 'Moneda requerido',             
        'moneda_com.min' => 'Moneda debe contener mínimo 4 caracteres',
        'moneda_com.max' => 'Moneda debe contener máximo 15 caracteres',  
        'pais_com.required' => 'Nombre de país requerido',             
        'pais_com.min' => 'País debe contener mínimo 4 caracteres',
        'pais_com.max' => 'País debe contener máximo 15 caracteres',  
        'comprador_com.required' => 'Comprador requerido',             
        'comprador_com.min' => 'Comprador debe contener mínimo 5 caracteres',
        'comprador_com.max' => 'comprador debe contener máximo 50 caracteres',          
    ];

    public function resetVar(){
        $this->reset(['tipo_com', 'moneda_com', 'pais_com', 'comprador_com']);        
    }      

    public function mount(){                                                             
        $this->fecha_com = Carbon::now()->format('Y-m-d');               
    }

    public function render()
    {
        return view('livewire.compras.compras-componente',[
            'compras' => Compra::paginate(10)
        ]);
    }

    public function store(){                   
        $this->validate();        
        Compra::create([            
            'fecha_com' => $this->fecha_com,               
            'tipo_com' => $this->tipo_com,   
            'items_com' => $this->items_com,
            'moneda_com' => $this->moneda_com,                      
            'pais_com' => $this->pais_com,  
            'comprador_com'  => $this->comprador_com            
        ]);
        $this->emit('alert',['type'=>'success','message'=>'Registro guardado']);
        $this->resetVar();  
        $this->emit('HideCreateCompraModal');          
    }

    public function edit($id){          
        $this->resetValidation();                            
        $compra = Compra::find($id); 
        $this->ids = $compra->id;                       
        $this->items_com = $compra->items_com;   
        $this->fecha_com = $compra->fecha_com;   
        $this->tipo_com = $compra->tipo_com;   
        $this->moneda_com = $compra->moneda_com;   
        $this->pais_com = $compra->pais_com;                     
        $this->comprador_com = $compra->comprador_com;   
        $this->emit('ShowEditCompraModal');  
    }

    public function update(){                
        $this->validate();         
        if ($this->ids) {            
            $compra =Compra::find($this->ids);            
            $compra->update([                
                'fecha_com' => $this->fecha_com,                      
                'tipo_com' => $this->tipo_com,
                'items_com' => $this->items_com,
                'moneda_com' => $this->moneda_com,
                'pais_com' => $this->pais_com,
                'comprador_com' => $this->comprador_com                
            ]);            
            $this->emit('alert',['type'=>'success','message'=>'Registro actualizado']);                    
            $this->resetVar();
            $this->emit('HideEditCompraModal');             
        }  
    }    


    public function destroy(Compra $registro){        
        $registro->delete();                   
    }

}
