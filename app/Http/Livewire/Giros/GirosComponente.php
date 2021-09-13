<?php

namespace App\Http\Livewire\Giros;

use Livewire\Component;

use App\Models\Compra; 
use App\Models\Giro;

use Carbon\Carbon;

class GirosComponente extends Component
{

    public $importaciones;//DATOS PARA HTML SELECT DE FECHAS DE IMPORTACION 

    //DATOS DE CABECERA DE IMPORTACION    
    public $giros_com;   

    public $compra;//VARIABLE GLOBAL EL ID DE COMPRA
    public $compra_id;//CON EL REGISTRO DE LA ULTIMA COMPRA

    //CAMPOS DE LA TABLA EN EL FORMULARIO    
    public $fecha_giro;//CAMPOS FECHA POR DEFAULT FECHA ACTUAL
    public $monto_giro;//CAMPO VALIDADO
    public $comision_giro;//CAMPOS VALIDADO
    public $docs_giro;//CAMPO  VALIDADO
    public $itf_giro;//CAMPO VALIDADO
    public $extravio_giro;//CAMPO VALIDADO

    //VARIABLES GLOBAL 
    public $ids;

    protected $listeners = ['destroy', 'finalizaGiros'];

    //REGLAS DE VALIDACION DE FORMULARIO
    protected $rules = [    
        'monto_giro'  => 'required|numeric',                    
        'comision_giro'  => 'required|numeric', 
        'docs_giro'  => 'required|numeric', 
        'itf_giro'  => 'required|numeric',         
    ];

    protected $messages = [       
        'monto_giro.required' => 'Monto requerido',
        'monto_giro.numeric' => 'Debe ser numérico',
        'comision_giro.required' => 'Comision requerido',
        'comision_giro.numeric' => 'Debe ser numérico',
        'docs_giro.required' => 'Gastos de papeleo requerido',
        'docs_giro.numeric' => 'Debe ser numérico',
        'itf_giro.required' => 'ITF requerido',
        'itf_giro.numeric' => 'Debe ser numérico'        
    ];

    public function resetVar(){
        $this->reset(['monto_giro', 'comision_giro', 'docs_giro', 'itf_giro', 'extravio_giro']);        
    }    

    public function mount(){                                       
        $this->importaciones = Compra::orderBy('id', 'DESC')->get();
        $this->compra = Compra::latest()->first();//EL ULTIMO REGISTRO ALMACENADO               
        $this->compra_id = $this->compra->id;//EL ULTIMO REGISTRO ALMACENADO                      
        $this->fecha_giro = Carbon::now()->format('Y-m-d');               
    }


    public function render()
    {
        $giros = $this->compra->giros;  

        return view('livewire.giros.giros-componente', [
            'giros' => $giros 
        ]);        
    }

    public function store(){           
        $this->validate();        
        Giro::create([
            'compra_id' => $this->compra->id,   
            'fecha_giro' => $this->fecha_giro,               
            'monto_giro' => $this->monto_giro,                      
            'comision_giro' => $this->comision_giro,  
            'docs_giro'  => $this->docs_giro,                    
            'itf_giro' => $this->itf_giro,  
            'extravio_giro'  => $this->extravio_giro 
        ]);
        $this->emit('alert',['type'=>'success','message'=>'Registro guardado']);
        $this->resetVar();  
        $this->emit('HideCreateGiroModal');  
        $this->filtrar();
    } 

    public function edit($id){  
        $this->resetValidation();                            
        $giro = Giro::find($id); 
        $this->ids = $giro->id;                       
        $this->fecha_giro = $giro->fecha_giro;   
        $this->monto_giro = $giro->monto_giro;        
        $this->comision_giro = $giro->comision_giro;   
        $this->docs_giro = $giro->docs_giro;
        $this->itf_giro = $giro->itf_giro;   
        $this->extravio_giro = $giro->extravio_giro;              
        $this->emit('ShowEditGiroModal');  
    }

    public function update(){                
        $this->validate();         
        if ($this->ids) {            
            $giro =Giro::find($this->ids);            
            $giro->update([                
                'fecha_giro' => $this->fecha_giro,                      
                'monto_giro' => $this->monto_giro,
                'comision_giro' => $this->comision_giro,
                'docs_giro' => $this->docs_giro,
                'itf_giro' => $this->itf_giro,
                'extravio_giro' => $this->extravio_giro                              
            ]);            
            $this->emit('alert',['type'=>'success','message'=>'Registro actualizado']);                    
            $this->resetVar();
            $this->emit('HideEditGiroModal'); 
            $this->filtrar(); 
        }  
    }    

    public function destroy(Giro $registro){        
        $registro->delete();          
        $this->filtrar(); 
    }

    public function filtrar(){
        $this->compra = Compra::find($this->compra_id);                    
        $this->render();  
    }   

    public function finalizaGiros(){
        $compra = Compra::find($this->compra_id);        
        $compra->update([                                        
            'giros_com' => 1 //TRANSFERENCIAS FINALIZADO
        ]);
        $this->filtrar(); 
    }
}
