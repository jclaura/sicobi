<?php

namespace App\Http\Livewire\Ventas;

use Livewire\Component;

use App\Models\Empleado;
use App\Models\Categoria; 
use App\Models\Caja; 
use App\Models\Stocktienda;  
use App\Models\Cliente; 

use App\Models\Venta; 
use App\Models\Detalle; 
use App\Models\Gasto; 

use Illuminate\Support\Collection;

use Cart;
use DB;
use Carbon\Carbon;
use Livewire\WithPagination;

class VentasComponente extends Component
{
    public $tienda_nombre;
    //public $tienda_id;
    public $factura;

    //VARIABLES PARA CART
    public $total=0;    
    public $subTotal;    
    public $articulos;
    public $userId;
    public $forma_pago = 1; //POR DEFAULT "Efectivo"

    //VARIABLES RESUMEN VENTA
    public $totalVenta;
    public $descuento;    
    public $efectivo;
    public $cambio;
    public $venta_id;//PARA IMPRIMIR RECIBO

    
    /*************************************************************************************
    ************    VARIABLES PARA FORMULARIO DE CIERR/APERTURA CAJA        **************
    **************************************************************************************/
    public $tienda_id; //QUE TIENDA ES
    public $empleado_id; //QUIEN ABRIO LA CAJA
    public $fecha_apertura_caja; //CUANDO SE ABRIO LA CAJA  
    public $hora_apertura_caja; //A QUE HORA SE ABRIO LA CAJA  
    public $fecha_cierre_caja; //CUANDO SE ABRIO LA CAJA  
    public $hora_cierre_caja; //A QUE HORA SE ABRIO LA CAJA 
    public $saldo_caja;   
    public $venta_caja;   
    public $ingresos_caja=0;   
    public $egresos_caja;               
    public $efectivo_caja;              
    public $nota_caja; //ALGUNA NOTA SOBRE APERTURA Y CIERRE DE CAJA 
    public $activo_caja;
    
    
    public $total_caja;
    public $diferencia_caja;              
    public $input_efectivo_caja = 'Disabled';     
    public $titulo_caja = 'APERTURA DE CAJA';  
    public $funcion_caja = 'abrirCaja'; 
    public $texto_boton_caja = 'Abrir caja'; 

    //VARIABLE DE BUSQUEDA DE PRODUCTO
    public $search;  

    //VARIABLE PARA TAG SELECT CATEGORIAS
    public $categoria, $categoriaSelectedId, $categoriaSelectedName; 
    //VARIABLE PARA TAG SELECT CLIENTES 
    public $clientes, $clienteSelectedId;

    /*************************************************************************************
    ************        VARIABLES PARA DATOS DE CABECERA DE FACTURA         **************
    **************************************************************************************/    
    public $cab_doc_cli = 'Sin datos';
    public $fecha_venta; 

    public $cliente_id = 1; //POR DEFAULT "Sin datos"

    /*************************************************************************************
    ************              VARIABLES PARA DATOS DE GASTOS               **************
    **************************************************************************************/
    public $gastos;
    public $monto_gas;
    public $desc_gas;

    /*************************************************************************************
    ************              VARIABLES PARA DATOS DE CLIENTE               **************
    **************************************************************************************/
    public $nom_cli;
    public $doc_cli = 'Sin datos';
    public $tel_cli;
    public $ciudad_cli = 'La Paz';

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['filtraCategoria', 'obtieneDatosCliente', 'calcula_diferencia', 'saldo_inicial', 'cerrarCaja'];    

    public function resetVar(){        
        $this->reset(['monto_gas', 'desc_gas']);        
    }

    public function mount(){      
        $this->userId = auth()->user()->id;       
        $empleado = Empleado::where('user_id', '=', $this->userId)->first();                
        if($empleado){//EXISTE EL  EMPLEADO
            $this->tienda_nombre = $empleado->tienda->nom_tienda;
            $this->tienda_id = $empleado->tienda_id;//VARIABLE GLOBAL PARA FILTRAR EL STOCK DE LA TIENDA  
            if($empleado->estado_emp){ //VERIFICAMOS SU ESTADO  1->CAJA ABIERTA      
                //VERIIFICAR A QUE CAJJA CORESPONDE               
                $caja = Caja::where('empleado_id', '=', $this->userId)
                    ->where('tienda_id', '=', $this->tienda_id)
                    ->where('activo_caja', '=', true)
                    ->first();                 
                if($caja){
                    $this->activo_caja = $caja->activo_caja;                    
                    $this->input_efectivo_caja = 'Enabled';                    
                    $this->titulo_caja = 'MODIFICAR / CIERRE DE CAJA';  
                    $this->funcion_caja = 'cerrarCaja'; 
                    $this->texto_boton_caja = 'Cerrar caja'; 
                    $this->gastos = $caja->gastos; 
                }                                                                         
            }            
            
            $primer_registro = Categoria::first();             
            $this->categoriaSelectedId = $primer_registro->id;//POR DEFECTO PRIMER ID DE CATEGORIA                

            $this->categoria = [];
            $this->clientes = [];
            
            Cart::session($this->userId)->clear(); 
            
            $this->search = '';//INICIALIZA VARIABLE BUSCADOR 
            $this->fecha_venta = Carbon::now()->format('Y-m-d');  
        }
        else{                          
            return redirect()->route('home');            
        }                        
        
        
    }


    public function render()
    {
        $this->categoria = Categoria::orderBy('cat_desc', 'asc')->get();  
        $this->clientes = Cliente::get();      
        return view('livewire.ventas.ventas-componente',[
            'stock' =>  Stocktienda::where('desc_prod', 'like', "%{$this->search}%")
                                    ->where('tienda_id', '=', $this->tienda_id)
                                    ->where('categoria_id', '=', $this->categoriaSelectedId)
                                    ->paginate(5)
        ]);         
    } 
    
    /*********************************************************
     ********  FUNCIONES PARA MODULO CABECERA FACTURA ********
    **********************************************************/
    public function filtraCategoria(){       
        if ($this->categoriaSelectedId==""){
            $this->categoriaSelectedId = 1;
        }              
    }
    public function obtieneDatosCliente(){          
        $cliente = Cliente::find($this->clienteSelectedId);               
        $this->cab_doc_cli = $cliente->doc_cli;  
        $this->cliente_id =  $cliente->id;                 
    }

    /*********************************************************
     **********    FUNCIONES PARA MODULO DE VENTA   **********
    **********************************************************/
    public function factura($productId, $um, $desc, $precio, $cant = 1){          
        $userId = auth()->user()->id;   

        $product = Stocktienda::find($productId);        
        $exist = Cart::session($userId)->get($productId);        
        if ($exist) {            
            if ($product->stock_prod < ($cant + $exist->quantity)){                
                $this->emit('msgError', 'Stock insuficiente!');               
                return;
            }
        }         

        Cart::session($userId)->add(array(
            'id' => $productId, 
            'name' => $desc,
            'price' => $precio,
            'quantity' => 1,
            'attributes' => array(
                'um' => $um               
              )            
        ));         
        $this->actualizaVariables();
    }

    public function anulaFila($rowId){                 
        $userId = auth()->user()->id; 
        Cart::session($userId)->remove($rowId);        
        $this->actualizaVariables(); 
    }  
    
    public function incCant($productId, $cant = 1){            
        $userId = auth()->user()->id;  
        $product = Stocktienda::find($productId);        
        $exist = Cart::session($userId)->get($productId);        
        if ($exist) {            
            if ($product->stock_prod < ($cant + $exist->quantity)){                
                $this->emit('msgError', 'Stock insuficiente!');               
                return;
            }
        }                   
        Cart::session($userId)->add(array(
            'id' => $product->id, 
            'name' => $product->desc_prod,
            'price' => $product->precio_prod,
            'quantity' => $cant,
            'attributes' => array(
                'um' => $product->um_prod               
              )            
        ));   
        $this->actualizaVariables();        
    }   

    public function decCant($productId){        
        $userId = auth()->user()->id; 
        $item = Cart::session($userId)->get($productId);
        Cart::session($userId)->remove($productId);
        $newQty = $item->quantity - 1;
        if ($newQty > 0){
            Cart::session($userId)->add(array(
                'id' => $item->id, 
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => $newQty,
                'attributes' => array(
                    'um' => $item->attributes['um']               
                  )            
            ));                    
        }
        $this->actualizaVariables();
    }

    public function actCant($productId, $cant = 1){
        $userId = auth()->user()->id;  
        $product = Stocktienda::find($productId);        
        $exist = Cart::session($userId)->get($productId);        
        if ($exist) {            
            if ($product->stock_prod < ($cant)){                
                $this->emit('msgError', 'Stock insuficiente!');
                return;
            }
            Cart::session($userId)->remove($productId);
            if ($cant > 0){
                Cart::session($userId)->add(array(
                    'id' => $product->id, 
                    'name' => $product->desc_prod,
                    'price' => $product->precio_prod,
                    'quantity' => $cant,
                    'attributes' => array(
                        'um' => $product->um_prod               
                      )            
                ));                   
                $this->actualizaVariables();   
            }
        }       
    }    

    public function actualizaVariables(){
        $userId = auth()->user()->id;
        $this->subTotal = Cart::session($userId)->getSubTotal(); 
        $this->total = Cart::session($userId)->getTotal();       
        $this->articulos = Cart::session($userId)->getTotalQuantity(); 
        $this->totalVenta =  number_format($this->total, 2, '.', '');
        $this->descuento = number_format(0, 2, '.', '');
        $this->efectivo = number_format(0, 2, '.', '');
        $this->cambio = number_format(0, 2, '.', '');    
    }

    public function restaDescuento(){  
        $userId = auth()->user()->id;
        $this->totalVenta = Cart::session($userId)->getTotal(); 
        $this->totalVenta = number_format($this->totalVenta-$this->descuento, 2, '.', '');  
        $this->efectivo = number_format(0, 2, '.', '');
        $this->cambio = number_format(0, 2, '.', '');   
    }

    public function calculaCambio(){          
        $this->cambio = number_format($this->efectivo-$this->totalVenta, 2, '.', '');     
    }
    
    public function finVenta(){    
        $userId = auth()->user()->id;     
        $articulos = Cart::session($userId)->getTotalQuantity(); 
        if ($articulos < 1){            
            $this->emit('msgError', 'Agregue productos para la venta!');
            return;
        }  
        $caja = Caja::where('empleado_id', '=', $userId)//MAL
                    ->where('tienda_id', '=', $this->tienda_id)
                    ->where('activo_caja', '=', true)
                    ->first();                        
        DB::beginTransaction();
        try {               
            $venta = Venta::create([
                'caja_id' =>  $caja->id,//ANTES OBTENER ID CAJA ABIERTO
                'cliente_id' => $this->cliente_id,                                         
                'fecha_ven' => Carbon::now(),
                'hora_ven' => Carbon::now(),        
                'doc_ven' => $this->cab_doc_cli,   
                'total_ven' => $this->totalVenta,
                'rebaja_ven' => $this->descuento,
                'tipo_pago_ven' => $this->forma_pago     
            ]);   

            if ($venta){                 
                $this->venta_id = $venta->id;               
                $items = $articulos = Cart::session($userId)->getContent();
                foreach($items as $item){                    
                    $producto =  Stocktienda::where('id', '=', $item->id)
                                    ->where('tienda_id', '=', $this->tienda_id)                                   
                                    ->first();                    
                    Detalle::create([
                        'venta_id' => $venta->id,
                        'cod_prod_det' => $producto->cod_prod,
                        'cant_det' => $item->quantity,
                        'um_det' => $item->attributes['um'],
                        'desc_det' => $item->name,
                        'precio_det' => $item->price
                    ]);                    
                    $producto->stock_prod = $producto->stock_prod - $item->quantity;
                    $producto->save();
                    $this->cab_doc_cli = 'Sin datos';
                    $this->emit('clienteOcacional'); 
                }
            }
            DB::commit();
            Cart::session($userId)->clear();
            $this->actualizaVariables();
            $this->emit('alert',['type'=>'success','message'=>'Venta registrada con éxito']);   
            //PREGUNTA SI DESEA IMPRIMIR RECIBO
            //FUNCION DEFINIDA EN LIVEWIRE/VENTAS/INDEX-COMPONENTE.BLADE
            $this->emit('imprimirRecibo');            
        } catch (Exception $e) {            
            DB::rollback();
            $this->emit('alert',['type'=>'error','message'=>$e->getMessage()]);            
        }
    }

    /*********************************************************
     **********    FUNCIONES PARA MODULO CAJA       **********
    **********************************************************/
    public function saldo_inicial(){           
        if(gettype($this->saldo_caja) == 'string'){
            
            $float = floatval($this->saldo_caja);
            $this->saldo_caja = $float;
            $this->total_caja = number_format(($this->saldo_caja+$this->venta_caja+$this->ingresos_caja)-$this->egresos_caja, 2, '.', '');            
        }
        else{
            $this->total_caja = number_format(($this->saldo_caja+$this->venta_caja+$this->ingresos_caja)-$this->egresos_caja, 2, '.', '');    
        }             
    }

    public function abrirCaja(){          
        $validatedData = $this->validate([
            'saldo_caja'   =>'required',                                 
        ]);  
        if ($this->saldo_caja < 1){
            $this->emit('alert',['type'=>'error','message'=>'Saldo inicial no puede ser menor a 1']); 
            return;
        }               
        $caja = Caja::create([            
            'tienda_id' => $this->tienda_id,
            'empleado_id' => auth()->user()->id,
            'fecha_apertura_caja' => Carbon::now(), 
            'hora_apertura_caja'  => Carbon::now(), 
            'fecha_cierre_caja'   => null, 
            'hora_cierre_caja'    => null, 
            'saldo_caja'          => $this->saldo_caja,
            'venta_caja'          => 0, 
            'ingresos_caja'       => $this->ingresos_caja, 
            'egresos_caja'        => 0, 
            'efectivo_caja'       => 0, 
            'nota_caja'           => $this->nota_caja,                 
            'activo_caja'           => true    
        ]);
        if($caja){
            $empleado = Empleado::where('user_id', '=',auth()->user()->id)->first();        
            $empleado->estado_emp = 1;           
            $empleado->save();   

            if($empleado->estado_emp){  
                $this->activo_caja = $caja->activo_caja;                                                                                 
                $this->input_efectivo_caja = 'Enabled';                
                $this->titulo_caja = 'MODIFICAR / CIERRE DE CAJA';
                $this->funcion_caja = 'cerrarCaja'; 
                $this->texto_boton_caja = 'Cerrar caja'; 
                $this->gastos = $caja->gastos; 
                $this->emit('alert',['type'=>'success','message'=>'Caja abierta y usuario habilitado...']);                                                      
                $this->emit('HideCajaModal');  
            }       
        }                   
    }

    public function racuperaDatosCaja(){       
        $userId = auth()->user()->id;   
        $caja = Caja::where('empleado_id', '=', $userId)
                    ->where('tienda_id', '=', $this->tienda_id)
                    ->where('activo_caja', '=', true)
                    ->first(); 

        $this->saldo_caja = $caja->saldo_caja; 
        $this->ingresos_caja = $caja->ingresos_caja;        
        $this->nota_caja = $caja->nota_caja; 

        $reg_ventas = $caja->ventas->count();
        if ($reg_ventas) {
            $this->venta_caja = number_format($caja->ventas->sum('total_ven'), 2, '.', '');
        } else {
            $this->venta_caja = 0;
        }

        $reg_gastos = $caja->gastos->count();        
        if ($reg_gastos) {            
            $this->egresos_caja = number_format($caja->gastos->sum('monto_gas'), 2, '.', '');    
        } else {
            $this->egresos_caja = 0;    
        }           
        
        $this->total_caja = number_format(($this->venta_caja+$this->ingresos_caja+$this->saldo_caja)-$this->egresos_caja, 2, '.', ''); //(VENTA + INGRESO EXTRA)-EGRESOS        
        $this->emit('ShowCajaModal'); 
    }

    public function calcula_diferencia(){
        if(gettype($this->efectivo_caja) == 'string'){
            
            $float = floatval($this->efectivo_caja);
            $this->efectivo_caja = $float;
            $this->diferencia_caja=number_format($this->total_caja-$this->efectivo_caja, 2, '.', '');                 
        }
        else{
            $this->diferencia_caja=number_format($this->total_caja-$this->efectivo_caja, 2, '.', '');                
        }             
    }    


    public function cerrarCaja(){                       
        $validatedData = $this->validate([
            'saldo_caja'   =>'required',
            'efectivo_caja'=>'required',                       
        ]); 
        if ($this->saldo_caja < 1){
            $this->emit('alert',['type'=>'error','message'=>'Saldo inicial no puede ser menor a 1']); 
            return;
        }           
        if ($this->efectivo_caja < 1){
            $this->emit('alert',['type'=>'error','message'=>'Efectivo no puede ser menor a 1']); 
            return;
        }          
        
        $userId = auth()->user()->id;   
        $caja = Caja::where('empleado_id', '=', $userId)
                    ->where('tienda_id', '=', $this->tienda_id)
                    ->where('activo_caja', '=', true)
                    ->first();                 
        
        $caja->fecha_cierre_caja = Carbon::now();
        $caja->hora_cierre_caja = Carbon::now();
        $caja->venta_caja = $this->venta_caja;
        $caja->ingresos_caja = $this->ingresos_caja;
        $caja->egresos_caja = $this->egresos_caja;
        $caja->efectivo_caja = $this->efectivo_caja;
        $caja->nota_caja = $this->nota_caja;
        $caja->activo_caja = false;
        $caja->save();                             
        
        $empleado = Empleado::where('user_id', '=', $userId)->first();        
        $empleado->estado_emp = 0;           
        $empleado->save();            
        
        $this->emit('alert',['type'=>'success','message'=>'Cierre de caja registrado con éxito']); 
        $this->reset(['saldo_caja','venta_caja','efectivo_caja','total_caja','diferencia_caja','egresos_caja']);  
        $this->emit('HideCajaModal'); 
        $this->emit('refreshPage'); 
        //SE DEBE RECARGAR LA PAGINA         
    }  

    public function modificaDatosCaja(){        
        $userId = auth()->user()->id;   
        $caja = Caja::where('empleado_id', '=', $userId)
                    ->where('tienda_id', '=', $this->tienda_id)
                    ->where('activo_caja', '=', true)
                    ->first();     
        if (($this->saldo_caja <> $caja->saldo_caja) || ($this->ingresos_caja <> $caja->ingresos_caja) || ($this->nota_caja <> $caja->nota_caja)){
            $caja->saldo_caja = $this->saldo_caja;
            $caja->ingresos_caja = $this->ingresos_caja; 
            $caja->nota_caja = $this->nota_caja;              
            $caja->save();                                           
            
            $this->emit('alert',['type'=>'success','message'=>'Datos modificados con éxito']);         
            $this->emit('HideCajaModal'); 
        }                         
        else {
            $this->emit('alert',['type'=>'info','message'=>'No hay nada que modificar']); 
        }
        
            
    }
    
    /*********************************************************
     **********    FUNCIONES PARA MODULO GASTOS     **********
    **********************************************************/

    public function gastos(){          
        $userId = auth()->user()->id;       
        $caja = Caja::where('empleado_id', '=', $this->userId)
                    ->where('tienda_id', '=', $this->tienda_id)
                    ->where('activo_caja', '=', true)
                    ->first();                 
                if($caja){
                    $this->gastos = $caja->gastos; 
                }      
        $this->emit('ShowGastosModal');        
    }    

    public function guardaGastos(){  
        $validatedData = $this->validate([
            'monto_gas' => 'required',
            'desc_gas' => 'required',
        ]);                  
        $caja = Caja::where('empleado_id', '=', $this->userId)
                    ->where('tienda_id', '=', $this->tienda_id)
                    ->where('activo_caja', '=', true)
                    ->first(); 
        $gasto = Gasto::create([
            'caja_id' =>  $caja->id,
            'monto_gas' =>  $this->monto_gas,
            'desc_gas' => $this->desc_gas, 
        ]);
        $this->gastos = $caja->gastos;
        $this->emit('alert',['type'=>'success','message'=>'Gasto registrada con éxito']);
        //$this->emit('HideGastosModal');
        $this->resetVar();
    }

    public function borrarGastos(Gasto $registro){
        $registro->delete();
        $caja = Caja::where('empleado_id', '=', $this->userId)
                    ->where('tienda_id', '=', $this->tienda_id)
                    ->where('activo_caja', '=', true)
                    ->first(); 
        $this->gastos = $caja->gastos;
    }    

     /*********************************************************
     **********   FUNCIONES PARA MODULO DE CLIENTE   **********
    **********************************************************/
    public function guardaCliente(){
        $validatedData = $this->validate([
            'nom_cli' => 'required',            
            'tel_cli' => 'required',            
        ]);    
        $cliente = Cliente::create([
            'nom_cli' =>  $this->nom_cli,
            'doc_cli' =>  $this->doc_cli,
            'tel_cli' => $this->tel_cli,
            'ciudad_cli' => $this->ciudad_cli,
        ]);        
        $this->emit('alert',['type'=>'success','message'=>'Cliente registrado con éxito']);        
        $this->emit('HideClienteModal');
        $this->reset(['nom_cli', 'doc_cli', 'tel_cli', 'ciudad_cli']);         
    }

    public function imprimeRecibo(){          
        return redirect()->route('recibo', $this->venta_id);          
    }   
}
