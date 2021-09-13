<?php

namespace App\Http\Livewire\Stock;

use Livewire\Component;
use App\Models\Stock;
use App\Models\Deposito;
use App\Models\Tienda;
use App\Models\Salida;
use App\Models\Stocktienda;
use App\Models\Systemvar;

use Livewire\WithPagination;  
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Storage;
use App\Http\Traits\SetImageTrait;

use Carbon\Carbon;

class StockComponente extends Component
{

    use WithPagination;
    use WithFileUploads;

    use SetImageTrait; 

    protected $paginationTheme = 'bootstrap';

    //CAMPOS DE LA TABLA STOCK EN EL FORMULARIO    
    public $deposito_id=1;////No asignado 
    public $cod_prod;//CAMPO VALIDADO
    public $desc_prod;//CAMPO VALIDADO
    public $medida_prod;//CAMPO VALIDADO
    public $color_prod;//CAMPO VALIDADO
    public $um_prod='Tira';
    public $precio_prod;//CAMPO VALIDADO 
    public $entrada_prod;//CAMPO VALIDADO
    public $salida_prod;//CAMPO VALIDADO        
    public $stock_prod;//CAMPO VALIDADO
    public $nota_prod;//CAMPO VALIDADO
    public $foto_prod;//CAMPO VALIDADO 

    public $depositos;//TODOS LOS REGISTROS PARA TAG SELECT    
    public $tiendas;//TODOS LOS REGISTROS PARA TAG SELECT 
    public $precio_deposito;
    public $precio_tienda; 
    public $precio_con_impuesto; 
    public $stock_disponible;
    public $cantidad_salida;
    public $fecha_salida;
    public $tienda_id=1;
    public $categoria_id=1;
    public $iva;
    public $it;
    public $impuestos;

    /*VARIABLE PARA QUE EL USUARIO CARGUE FOTO PRODUCTO */
    /* SE DEBE USAR LOS SIGUIENTES USES: use Livewire\WithFileUploads;, use WithFileUploads;*/
    public $photo, $iteration; //TRUCO PARA LIMPIAR SELECIONAR ARCHIVO EN FORMULARIO BLADE
    //RUTA DONDE SE GUARDARA LA FOTO UPLOAD*/         
    public $rutaFotosProductos = 'FotosProductos';  
    
    //VARIABLES GLOBAL 
    public $ids; 

    public $tipo_cambio_local;

    protected $listeners = ['destroy'];

    //REGLAS DE VALIDACION DE FORMULARIO
    protected $rules = [        
        'cod_prod'   => 'required|min:5|max:100|regex:/^[0-9A-Z-]+$/u',                        
        'desc_prod'   => 'required|min:5|max:100|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*.)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',                        
    ];

    public function resetVar(){        
        $this->reset(['cod_prod','desc_prod', 'medida_prod', 'color_prod', 'precio_prod', 'entrada_prod', 'nota_prod']);   
    }

    public function mount(){                                                  
        $this->depositos = Deposito::all();              
        $this->tiendas = Tienda::all(); 
        $this->fecha_salida = Carbon::now()->format('Y-m-d');
        $systemvar = Systemvar::first();
        $this->tipo_cambio_local = $systemvar->tipo_cambio_sys;
        $this->iva = $systemvar->iva_sys;
        $this->it = $systemvar->it_sys;
    }  

    public function render()
    {
        return view('livewire.stock.stock-componente', [
            'stock' => Stock::all()
        ]);
    }

    public function store(){  
        $stock = Stock::where('cod_prod', '=', ucfirst($this->cod_prod))->first();                      
        if (empty($stock)) {
            if ($this->photo <> null){
                $nombreFotoStockGenerado = $this->setImage($this->photo, $this->rutaFotosStock);
                $this->photo = null; 
                $this->iteration++;//BORRA NOMBRE DE ARCHIVO ANTERIOR SELECCIONADO (TRUCO)  
            } 
            else{
                $nombreFotoStockGenerado = 'noimage.png'; 
            }                
            $stock = Stock::create([
                'deposito_id' => $this->deposito_id, 
                'cod_prod' => $this->cod_prod, 
                'desc_prod' => $this->desc_prod, 
                'medida_prod' => $this->medida_prod, 
                'color_prod' => $this->color_prod, 
                'um_prod' => $this->um_prod,             
                'precio_prod' => $this->precio_prod, 
                'entrada_prod' => $this->entrada_prod, 
                'salida_prod' => 0, 
                'stock_prod' => $this->entrada_prod, 
                'nota_prod' => $this->nota_prod, 
                'foto_prod' => $nombreFotoStockGenerado
            ]);                                      
            $this->emit('alert',['type'=>'success','message'=>'Registro guardado']);   
            $this->resetVar();              
            $this->emit('HideCreateStockModal');            
        } else {            
            $this->emit('msgError', 'Código de producto ya existe!');
        }                      
    } 

    public function edit($id){        
        $stock = Stock::find($id); 
        $this->ids = $stock->id; 
        $this->deposito_id = $stock->deposito_id;
        //MOSTRAR MENSAJE SI SOLO HUBO CAMBIO
        $this->emit('ShowEditStockModal'); 
    }

    public function update(){
        if ($this->ids) {  
            $stock =Stock::find($this->ids); 
            $stock->update([
                'deposito_id' => $this->deposito_id                           
            ]);
            $this->emit('alert',['type'=>'success','message'=>'Depósito asignado']);                                
            $this->emit('HideEditStockModal'); 
        }
    }   
    public function destroy(Stock $registro){        
        $registro->delete(); 
        //SI EL REGISTRO TIENE FOTO SE ELIMINA LA IMAGEN
        if ($registro->foto_prod <> 'noimage.png'){
            Storage::disk('public')->delete($this->rutaFotosStock.'/'.$registro->foto_prod); 
        }        
    }

    public function salida($id){        
        $stock = Stock::find($id); 
        $this->ids = $stock->id;     
        $this->stock_disponible = $stock->stock_prod;    
        $this->cantidad_salida = $stock->stock_prod;  

        $precio_bs = $stock->precio_prod*$this->tipo_cambio_local;
        $this->impuestos = number_format(($precio_bs*($this->iva+$this->it))/100, 2, '.', '');
        $this->precio_con_impuesto = $precio_bs+$this->impuestos;

        $this->precio_deposito =number_format($precio_bs, 2, '.', '');        
        $this->precio_tienda =number_format($this->precio_con_impuesto, 2, '.', '');        
        $this->emit('ShowSalidaStockModal'); 
    }

    public function salidaConfirmada(){  
        //CON EN ID DEL REGISTRO HACEMOS LOS SIGUIENTES PROCEDIMIENTOS       

         //PRIMERO ACTUALIZAMOS STOCK CON LA CANTIDAD DE SALIDA
        if ($this->ids) {  
            $stock =Stock::find($this->ids); 
            if ($this->cantidad_salida <=$stock->stock_prod) {
                $stock->update([
                    'stock_prod' => $stock->stock_prod = $stock->stock_prod - $this->cantidad_salida                           
                ]);
                $this->emit('HideSalidaStockModal'); 
                $this->emit('alert',['type'=>'success','message'=>'Salida registrada']);
            } else {
                $this->emit('msgError', 'Cantidad de salida no puede ser mayor a existencia!');
            }  
            
            //LUEGO REGISTRAMOS LA SALIDA EN LA TABLA SALIDA                
            Salida::create([
                'stock_id' => $stock->id,
                'tienda_id' => $this->tienda_id,
                'fecha_sal' => $this->fecha_salida,                       
                'codprod_sal' => $stock->cod_prod,  
                'cantprod_sal' => $this->cantidad_salida, 
                'precio_sal' => $this->precio_con_impuesto,
                'precio_ven' => $this->precio_tienda                              
            ]); 

            //LUEGO REGISTRAMOS EN LA TABLA VENTAS, ADICIONAMOS O ACTUALIZAMOS
            //VERIFICAMOS SI EL PRODUCTO EXISTE PARA ADICIONAR STOCK O CREAR STOCK
            //PARA UNA DETERMINADA TIENDA
            //FALTA6
            $stocktienda = Stocktienda::where('cod_prod', '=', $stock->cod_prod)
                                      ->where('tienda_id', '=', $this->tienda_id)
                                      ->first(); 
            if (empty($stocktienda)) {
                Stocktienda::create([                     
                    'tienda_id' => $this->tienda_id,              
                    'categoria_id' => $this->categoria_id,    
                    'cod_prod' => $stock->cod_prod,
                    'desc_prod' => $stock->desc_prod,        
                    'medida_prod' => $stock->medida_prod,   
                    'color_prod' => $stock->color_prod,
                    'um_prod' => $stock->um_prod,
                    'precio_prod' => $this->precio_tienda,
                    'stock_prod' => $this->cantidad_salida,        
                    'foto_prod' => $stock->foto_prod,                       
                ]);  
                $this->emit('alert',['type'=>'success','message'=>'Nuevo stock creado']);   
            } else {
                $nuevoStockTienda = $stocktienda->stock_prod+$this->cantidad_salida;
                $stocktienda->update([                    
                    'stock_prod' => $nuevoStockTienda,
                    'precio_prod' => $this->precio_tienda                            
                ]); 
                $this->emit('alert',['type'=>'success','message'=>'Stock actualizado']); 
            }                                              
        }                                   
    }
}
