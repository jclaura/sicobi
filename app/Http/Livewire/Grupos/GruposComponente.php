<?php

namespace App\Http\Livewire\Grupos;

use Livewire\Component;
use App\Models\Grupo; 
use App\Models\Deposito;

use Livewire\WithPagination;  
use Livewire\WithFileUploads;


class GruposComponente extends Component
{

    use WithPagination;
    use WithFileUploads;    

    protected $paginationTheme = 'bootstrap';


    //CAMPOS DE LA TABLA EN EL FORMULARIO      
    public $estante_gru;//VALIDADO
    public $fila_estante_gru;//VALIDADO    
    public $tipo_prod_gru='A';//CLASE A POR DEFAULT
    public $codprod_gru;//VALIDADO
    public $etiqueta_gru;//VALIDADO
    public $rotulo_gru=0;//VALIDADO
    public $nota_gru;//OPCIONAL


    public $depositos;//TODOS LOS REGISTROS PARA TAG SELECT        
    public $deposito_id=1; //No asignado

    //VARIABLES GLOBAL 
    public $ids;

    public $prueba='Prueba';

    protected $listeners = ['destroy'];

    //REGLAS DE VALIDACION DE FORMULARIO
    protected $rules = [    
        'estante_gru'  => 'required|integer|min:1|max:100',
        'fila_estante_gru'  => 'required|integer|min:1|max:10',
        'codprod_gru'   => 'required|min:5|max:20|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',                                 
        'etiqueta_gru'   => 'required|min:5|max:50|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',                                 
        
    ];

    protected $messages = [       
        'estante_gru.required' => 'Número de estante requerido',             
        'fila_estante_gru.required' => 'Número de fila requerido',
        'codprod_gru.required' => 'Código de producto requerido',             
        'codprod_gru.min' => 'Código de producto debe contener mínimo 5 caracteres',
        'codprod_gru.max' => 'Código de producto debe contener máximo 20 caracteres',  
        'codprod_gru.regex' => 'Formato de entrada no válido', 
        'etiqueta_gru.required' => 'Etiqueta de producto requerido',             
        'etiqueta_gru.min' => 'Etiqueta de producto debe contener mínimo 5 caracteres',
        'etiqueta_gru.max' => 'Etiqueta de producto debe contener máximo 50 caracteres',  
        'etiqueta_gru.regex' => 'Formato de entrada no válido',         
    ];

    public function resetVar(){
        $this->reset(['estante_gru', 'fila_estante_gru', 'tipo_prod_gru', 'codprod_gru', 'etiqueta_gru', 'rotulo_gru', 'nota_gru']);        
    }  

    public function mount(){                                               
        $this->depositos = Deposito::all();         
    }  

    public function render()
    {
        return view('livewire.grupos.grupos-componente', [
            'grupos' => Grupo::paginate(10)
        ]);
    }

    public function store()
    {        
        $this->validate();
        Grupo::create([
            'deposito_id' => $this->deposito_id,
            'estante_gru' => $this->estante_gru,
            'fila_estante_gru' => $this->fila_estante_gru,
            'tipo_prod_gru' => $this->tipo_prod_gru,
            'codprod_gru' => $this->codprod_gru,
            'etiqueta_gru' => $this->etiqueta_gru,
            'rotulo_gru' => $this->rotulo_gru,
            'nota_gru' => $this->nota_gru
        ]); 
        $this->emit('alert',['type'=>'success','message'=>'Registro guardado']);  
        $this->resetVar();              
        $this->emit('HideCreateGrupoModal');                                                                                     
    }

    public function edit($id)
    {       
        $this->resetValidation(); 
        $grupo = Grupo::find($id);      
        $this->ids = $grupo->id;      
        $this->deposito_id = $grupo->deposito_id;
        $this->estante_gru = $grupo->estante_gru;
        $this->fila_estante_gru = $grupo->fila_estante_gru;
        $this->tipo_prod_gru = $grupo->tipo_prod_gru;
        $this->codprod_gru = $grupo->codprod_gru;
        $this->etiqueta_gru = $grupo->etiqueta_gru;
        $this->rotulo_gru = $grupo->rotulo_gru;
        $this->nota_gru = $grupo->nota_gru;
        $this->emit('ShowEditGrupoModal');               
    }

    public function update(){                       
        $this->validate();         
        if ($this->ids) {            
            $grupo =Grupo::find($this->ids);            
            $grupo->update([                
                'deposito_id' => $this->deposito_id,
                'estante_gru' => $this->estante_gru,
                'fila_estante_gru' => $this->fila_estante_gru,
                'tipo_prod_gru' => $this->tipo_prod_gru,
                'codprod_gru' => $this->codprod_gru,
                'etiqueta_gru' => $this->etiqueta_gru,
                'rotulo_gru' => $this->rotulo_gru,
                'nota_gru' => $this->nota_gru                                        
            ]);            
            $this->emit('alert',['type'=>'success','message'=>'Registro actualizado']);                    
            $this->resetVar();
            $this->emit('HideEditGrupoModal');             
        }  
    }   

    public function destroy(Grupo $registro){        
        $registro->delete();                  
    }
}
