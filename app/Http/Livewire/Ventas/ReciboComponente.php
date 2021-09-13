<?php

namespace App\Http\Livewire\Ventas;

use Livewire\Component;

use App\Models\Empleado;
use App\Models\Caja; 
use App\Models\Tienda; 
use App\Models\Venta; 
use App\Models\Detalle; 
use PDF;


class ReciboComponente extends Component
{
    
    public function render()
    {
        return view('livewire.ventas.recibo-componente');
    }

    public function livewirePDF($ventaId){          
        
        $userId = auth()->user()->id; 
        $empleado = Empleado::where('user_id', '=', $userId)->first();         
        $tienda_id = $empleado->tienda_id;

        $venta = Venta::find($ventaId);        
        
        $cliente = $venta->cliente->nom_cli;
        $nit = $venta->doc_ven;

        $caja = Caja::find($venta->caja_id);

        $reg_tienda = Tienda::find($caja->tienda_id);
        $tienda = $reg_tienda->nom_tienda;               
        $nombre = auth()->user()->name;
        $recibo = $venta->detalles;              
        
        $customPaper = array(0,0,612,396);//TAMANIO MEDIA CARTA  
        $pdf = PDF::loadView('livewire.ventas.recibo-componente', compact('recibo','tienda','nombre','cliente','nit'))       
                ->setPaper($customPaper, 'landscape');

        return $pdf->stream('recibo.pdf');       
    }

    public function guardarpdf(){

    	$productos = Producto::all();
    	$pdf = PDF::loadView('productoshorizontal', compact('productos'))->output();
    	Storage::disk('public')->put(date('Y-m-d-H-i-s').'-productos.pdf', $pdf);

    	return redirect()->back()->with('status','¡PDF Productos guardado con éxito!');
    }
}
