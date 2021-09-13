<?php

namespace App\Http\Livewire\Ventas;

use Livewire\Component;
use App\Models\Empleado;
use App\Models\Caja; 
use App\Models\Venta; 
use App\Models\Detalle; 
use App\Models\Cliente; 

class ReportesComponente extends Component
{
    public $userId;      
    public $tienda_nombre;
    public $tienda_id; 
    public $activo_caja;
    public $ventas;
    public $detalles;
    public $cliente_nombre;
    public $fecha_apertura_caja, $hora_apertura_caja;

    public function mount(){      
        $this->userId = auth()->user()->id;       
        $empleado = Empleado::where('user_id', '=', $this->userId)->first(); 
        $this->tienda_nombre = $empleado->tienda->nom_tienda;
        $this->tienda_id = $empleado->tienda_id;        
        $this->detalles=[];                        
        if($empleado){//EXISTE EL  EMPLEADO
            if($empleado->estado_emp){ //VERIFICAMOS SU ESTADO  1->CAJA ABIERTA      
                //VERIIFICAR A QUE CAJJA CORESPONDE               
                $caja = Caja::where('empleado_id', '=', $this->userId)
                    ->where('tienda_id', '=', $this->tienda_id)
                    ->where('activo_caja', '=', true)
                    ->first();                 
                if($caja){
                    //AQUI RECUPERAMOS LAS VENTA DE ESA CAJA
                    $this->activo_caja = $caja->activo_caja;     
                    $this->fecha_apertura_caja = $caja->fecha_apertura_caja;//FECHA APERTURA CAJA 
                    $this->hora_apertura_caja = $caja->hora_apertura_caja;//HORA APERTURA CAJA               
                    $this->ventas = $caja->ventas;                    
                }                                                                         
            }                       
        }
        else{              
            $this->emit('alert',['type'=>'error','message'=>$e->getMessage()]); 
        }                        
    }

    public function render()
    {
        return view('livewire.ventas.reportes-componente', ['ventas' => $this->ventas]);
    }

    public function verDetalle($venta_id)
    {           
        $venta = Venta::where('id','=',$venta_id)->first();
        $this->detalles = $venta->detalles;                  
        $this->cliente_nombre = $venta->cliente->nom_cli;
    }

    public function imprimeRecibo($ventaId){          
        //dd($ventaId);
        return redirect()->route('recibo', $ventaId);          
    }
    
}
