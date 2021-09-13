<?php

namespace App\Http\Livewire\Pagos;

use Livewire\Component;

use App\Models\Compra; 
use App\Models\Pago;

use Carbon\Carbon;

class PagosComponente extends Component
{

    public $importaciones;//DATOS PARA HTML SELECT DE FECHAS DE IMPORTACION 

    //DATOS DE CABECERA DE IMPORTACION   
    public $pagos_com; 

    public $compra;//VARIABLE GLOBAL EL ID DE COMPRA
    public $compra_id;//CON EL REGISTRO DE LA ULTIMA COMPRA

     //CAMPOS DE LA TABLA EN EL FORMULARIO    
     public $fecha_pago;//CAMPOS FECHA POR DEFAULT FECHA ACTUAL
     public $monto_pago;//CAMPO VALIDADO
     public $desc_pago;//CAMPOS VALIDADO
     public $nota_pago;//CAMPO OPCIONAL

    //VARIABLES GLOBAL 
    public $ids;

    protected $listeners = ['destroy', 'finalizaPagos'];
    
    //REGLAS DE VALIDACION DE FORMULARIO
    protected $rules = [    
        'monto_pago'  => 'required|numeric',            
        'desc_pago'   => 'required|min:5|max:100|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'                        
    ];

    protected $messages = [
        'desc_pago.required' => 'Descripción requerido',             
        'desc_pago.min' => 'Descripción debe contener mínimo 5 caracteres',
        'desc_pago.max' => 'Descripción debe contener máximo 100 caracteres',  
        
        'monto_pago.required' => 'Monto requerido',
        'monto_pago.numeric' => 'Debe ser numérico',
    ];

    public function resetVar(){
        $this->reset(['monto_pago', 'desc_pago', 'nota_pago',]);        
    }

    public function mount(){                                       
        $this->importaciones = Compra::orderBy('id', 'DESC')->get();
        $this->compra = Compra::latest()->first();//EL ULTIMO REGISTRO ALMACENADO             
        $this->compra_id = $this->compra->id;//EL ULTIMO REGISTRO ALMACENADO                              
        $this->fecha_pago = Carbon::now()->format('Y-m-d');               
    }

    public function render()
    {
        $pagos = $this->compra->pagos;  

        return view('livewire.pagos.pagos-componente', [
            'pagos' => $pagos
        ]);        
    } 
    
    public function store(){           
        $this->validate();        
        Pago::create([
            'compra_id' => $this->compra->id,   
            'fecha_pago' => $this->fecha_pago,               
            'monto_pago' => $this->monto_pago,                      
            'desc_pago' => $this->desc_pago,  
            'nota_pago'  => $this->nota_pago                    
        ]);
        $this->emit('alert',['type'=>'success','message'=>'Registro guardado']);
        $this->resetVar();  
        $this->emit('HideCreatePagoModal');  
        $this->filtrar();
    }

    public function edit($id){           
        $this->resetValidation();             
        $pago = Pago::find($id); 
        $this->ids = $pago->id;                       
        $this->fecha_pago = $pago->fecha_pago;   
        $this->monto_pago = $pago->monto_pago;        
        $this->desc_pago = $pago->desc_pago;
        $this->nota_pago = $pago->nota_pago;         
        $this->emit('ShowEditPagoModal');  
    }

    public function update(){                
        $this->validate();         
        if ($this->ids) {            
            $pago =Pago::find($this->ids);            
            $pago->update([                
                'fecha_pago' => $this->fecha_pago,                      
                'monto_pago' => $this->monto_pago,  
                'desc_pago'  => $this->desc_pago,        
                'nota_pago' => $this->nota_pago,               
            ]);            
            $this->emit('alert',['type'=>'success','message'=>'Registro actualizado']);                    
            $this->resetVar();
            $this->emit('HideEditPagoModal'); 
            $this->filtrar(); 
        }  
    }        

    public function destroy(Pago $registro){        
        $registro->delete();          
        $this->filtrar(); 
    }

    public function filtrar(){
        $this->compra = Compra::find($this->compra_id);                             
        $this->render();  
    }

    public function finalizaPagos(){
        $compra = Compra::find($this->compra_id);        
        $compra->update([                                        
            'pagos_com' => 1 //PAGO FINALIZADO
        ]);
        $this->filtrar(); 
    }
}