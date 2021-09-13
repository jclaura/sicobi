<?php

namespace App\Http\Livewire\Productos;

use Livewire\Component;

//ADICIONADO
use App\Models\Proveedor;  
use App\Models\Compra;  
use App\Models\Categoria; 
use App\Models\Producto;   
use App\Models\Stock;  
use App\Models\Entrada; 
use App\Models\Pago; 
use App\Models\Systemvar; 

use Carbon\Carbon;

use Livewire\WithPagination;  
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Storage;

use App\Http\Traits\SetImageTrait;  


class ProductosComponente extends Component
{    
    use WithPagination;
    use WithFileUploads;

    use SetImageTrait;

    protected $paginationTheme = 'bootstrap';   
    
    public $compra;//VARIABLE CLAVE PARA FILTRAR PRODUCTOS COMPRADOS EN ESA FECHA

    public $importaciones;//DATOS PARA HTML SELECT DE FECHAS DE IMPORTACION  
    public $proveedores;//TODOS LOS REGISTROS PARA TAG SELECT
    public $categorias;//TODOS LOS REGISTROS PARA TAG SELECT
    
    public $tipo_cambio;//SE USA EN ARCHIVO BLADE PARA CONVERTIR MONEDA ORIGEN A DOLAR    
    
    /*VARIABLE PARA QUE EL USUARIO CARGUE FOTO PRODUCTO */
    /* SE DEBE USAR LOS SIGUIENTES USES: use Livewire\WithFileUploads;, use WithFileUploads;*/
    public $photo, $iteration; //TRUCO PARA LIMPIAR SELECIONAR ARCHIVO EN FORMULARIO BLADE
    //RUTA DONDE SE GUARDARA LA FOTO UPLOAD*/
    public $rutaFotosProductos = 'FotosProductos';    

    //CAMPOS DE LA TABLA PRODUCTO EN EL FORMULARIO    
    public $cod_prod, $desc_prod, $cant_prod, $medida_prod, $color_prod;//CAMPOS VALIDADOS
    public $um_prod='Tira';//UNIDA DE MANEJO TIRA
    public $precio_prod; //CAMPO VALIDADO
    public $calidad_prod='B';//CALIDAD BAJA
    public $foto_prod; 
    public $nota_prod='N.E.';//NO EXISTE
    public $ok_prod=0;//POR DEFAULT NO VERIFICADO
    public $ok_inv=0;//POR DEFAULT NO INVENTARIADO
    public $compra_id;//CON EL REGISTRO DE LA ULTIMA COMPRA
    public $categoria_id=1; //Piedras Naturales 
    public $proveedor_id=1; //Sin datos

    //VARIABLES GLOBAL 
    public $ids;
    public $idStock;
    public $idProd;
    public $idProdGlobal;
    public $cantidad_producto; //CANTIDAD A ADICIONAR SI EL CODIGO DE PRODUCTO YA ESTA EN INVENTARIO
    
    public $utilidad;   
    public $items_comprados;   
    public $items_productos;
    public $ind_inv=0; //INDICADOR DE INVENTARIO DE LOTE DE PRODUCTOS POR FECHA

    //MONTO TOTALES POR FECHA DE MERCANCIAS Y GASTOS (VARIABLES GLOBALES)
    public $totalMercanciaOrigen=0;
    public $totalMercanciaSus=0;
    public $totalPagosSus=0;
    public $totalAdicionalSus=0;
    public $precio_venta_dolar=0;
    
    protected $listeners = ['destroy', 'addstock', 'newStock'];

    //REGLAS DE VALIDACION DE FORMULARIO
    protected $rules = [   
        'cod_prod'  => 'required|min:12|max:12|regex:/^[A-Z]{2}[-]{1}[A-Z]{2}[-]{1}[0-9]{2}[-]{1}[0-9]{3}$/',                       
        'desc_prod'  => 'required|min:5|max:100|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',          
        'cant_prod'  => 'required|integer|min:1|max:1000000',
        'medida_prod'  => 'required|min:3|max:10|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',                                
        'color_prod'  => 'required|min:3|max:15|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',                                
        'precio_prod'  => 'required|numeric'
    ]; 

    protected $messages = [
        'cod_prod.required' => 'Código de producto requerido',             
        'cod_prod.min' => 'Código de producto debe contener mínimo 12 caracteres',
        'cod_prod.max' => 'Código de producto debe contener máximo 12 caracteres',   
        'cod_prod.regex' => 'Código de producto no válido', 

        'desc_prod.required' => 'Nombre de empresa requerido',             
        'desc_prod.min' => 'Nombre de empresa debe contener mínimo 5 caracteres',
        'desc_prod.max' => 'Nombre de empresa debe contener máximo 100 caracteres',        

        'cant_prod.required' => 'Cantidad es requerido',
        'cant_prod.min' => 'Mínimo debe ser 1',
        'cant_prod.max' => 'Máximo debeser 1.000.000',
        'cant_prod.integer' => 'Cantidad debe ser un número entero',

        'medida_prod.required' => 'Medida es requerido',
        'medida_prod.min' => 'Medida de producto debe contener mínimo 3 caracteres',
        'medida_prod.max' => 'Medida de producto debe contener máximo 10 caracteres',

        'color_prod.required' => 'Color es requerido',
        'color_prod.min' => 'Color de producto debe contener mínimo 3 caracteres',
        'color_prod.max' => 'Color de producto debe contener máximo 15 caracteres',

        'precio_prod.required' => 'Precio es requerido',
        'precio_prod.numeric' => 'Debe ser numérico',
        
    ];

    public function resetVar(){        
        $this->reset(['desc_prod', 'cant_prod', 'medida_prod', 'color_prod', 'um_prod', 'precio_prod', 'calidad_prod', 'foto_prod', 'nota_prod', 'ok_prod']);        
    }

    public function mount(){                                       
        $this->importaciones = Compra::orderBy('id', 'DESC')->get();
        $this->compra = Compra::latest()->first();//EL ULTIMO REGISTRO ALMACENADO
        $this->tipo_cambio = $this->compra->tipo_com;         
        
        //MUESTRA BOTON "NUEVO" SI ITEMS PRODUCTOS MENOR A ITEMS COMPRADOS
        $this->items_comprados = $this->compra->items_com; 
        $this->items_productos = $this->compra->productos()->count();   

        $this->compra_id = $this->compra->id;//EL ULTIMO REGISTRO ALMACENADO       
               
        $this->proveedores = Proveedor::all();
        $this->categorias = Categoria::all(); 
        $sisvar = Systemvar::first();

        $this->utilidad = $sisvar->utilidad_sys;
                       
        $this->codProdIni();

        //NECESITO DE UN INDICADOR SI EL LOTE DE PEDIDO PARA UNA DETERMINADA FECHA SE PUEDE INVENTARIAR
        if($this->compra->pagos_com AND $this->compra->giros_com){                 
            $this->ind_inv = 1;
        }


        $this->calculaGastoImportacionPorFecha();                 
    }    

    public function render()
    {                   
        $productos = $this->compra->productos()->paginate(8);             
       
        return view('livewire.productos.productos-componente',[
            'productos' => $productos
        ]);        
    }         

    public function store(){
        $this->validate();  
        if ($this->photo <> null){
            $nombreFotoProductoGenerado = $this->setImage($this->photo, $this->rutaFotosProductos);
            $this->photo = null; 
            $this->iteration++;//BORRA NOMBRE DE ARCHIVO ANTERIOR SELECCIONADO (TRUCO)  
        }
        else{
            $nombreFotoProductoGenerado = 'noimage.png'; 
        }           
        //SE PUEDE INVENTARIAR SOLO SI FINALIZO PAGOS Y GIROS    
        //ACTIVAR BOTON INVENTARIAR    
            
        Producto::create([
            'compra_id' => $this->compra_id,               
            'proveedor_id' => $this->proveedor_id,                      
            'categoria_id' => $this->categoria_id,  
            'cod_prod'  => $this->cod_prod,        
            'desc_prod' => $this->desc_prod,
            'cant_prod' => $this->cant_prod, 
            'medida_prod' => $this->medida_prod, 
            'color_prod' => $this->color_prod,          
            'um_prod' => $this->um_prod,
            'precio_prod' => $this->precio_prod,           
            'calidad_prod' => $this->calidad_prod,                   
            'foto_prod' => $nombreFotoProductoGenerado,              
            'nota_prod' => $this->nota_prod,
            'ok_prod' => $this->ok_prod            
        ]);
        $this->emit('alert',['type'=>'success','message'=>'Registro guardado']);
        $this->resetVar();  
        $this->emit('HideCreateProductoModal');  
        $this->filtrar(); 
          
    }    

    public function edit($id){         
        $this->resetValidation();             
        $producto = Producto::find($id); 
        $this->ids = $producto->id;  
        
        $this->compra_id = $producto->compra_id;                
        $this->proveedor_id = $producto->proveedor->id;                       
        $this->categoria_id = $producto->categoria->id;  

        $this->cod_prod = $producto->cod_prod;        
        $this->desc_prod = $producto->desc_prod;
        $this->cant_prod = $producto->cant_prod; 
        $this->medida_prod = $producto->medida_prod; 
        $this->color_prod = $producto->color_prod;          
        $this->um_prod = $producto->um_prod;
        $this->precio_prod = $producto->precio_prod;           
        $this->calidad_prod = $producto->calidad_prod;                                             
        $this->nota_prod = $producto->nota_prod;
        $this->ok_prod = $producto->ok_prod;
        $this->ok_inv = $producto->ok_inv;        
        
        $this->emit('ShowEditProductoModal');  
    }

    public function update(){            
        $this->validate();         
        if ($this->ids) {            
            $producto =Producto::find($this->ids); 
            if ($this->photo <> null){
                //SI EL REGISTRO TIENE FOTO SE ELIMINA LA IMAGEN
                if ($producto->foto_prod <> 'N.E.'){
                    Storage::disk('public')->delete($this->rutaFotosProductos.'/'.$producto->foto_prod); 
                } 

                $nombreFotoProductoGenerado = $this->setImage($this->photo, $this->rutaFotosProductos);
            }
            else{                
                $nombreFotoProductoGenerado = $producto->foto_prod;                                                           
            }  
            //SE PUEDE INVENTARIAR SOLO SI FINALIZO PAGOS Y GIROS    
            //ACTIVAR BOTON INVENTARIAR
                                    
            $producto->update([
                'compra_id' => $this->compra_id,               
                'proveedor_id' => $this->proveedor_id,                      
                'categoria_id' => $this->categoria_id,  
                'cod_prod'  => $this->cod_prod,        
                'desc_prod' => $this->desc_prod,
                'cant_prod' => $this->cant_prod, 
                'medida_prod' => $this->medida_prod, 
                'color_prod' => $this->color_prod,          
                'um_prod' => $this->um_prod,
                'precio_prod' => $this->precio_prod,           
                'calidad_prod' => $this->calidad_prod,                   
                'foto_prod' => $nombreFotoProductoGenerado,              
                'nota_prod' => $this->nota_prod,
                'ok_prod' => $this->ok_prod                
            ]);
            $this->photo = null; 
            $this->iteration++;//BORRA NOMBRE DE ARCHIVO ANTERIOR SELECCIONADO (TRUCO) 
            $this->emit('alert',['type'=>'success','message'=>'Registro actualizado']);                    
            $this->resetVar();
            $this->emit('HideEditProductoModal'); 
            $this->filtrar();             
        }           
    }
    
    public function destroy(Producto $registro){        
        $registro->delete();
        //SI EL REGISTRO TIENE FOTO SE ELIMINA LA IMAGEN
        if ($registro->foto_prod <> 'noimage.png'){
            Storage::disk('public')->delete($this->rutaFotosProductos.'/'.$registro->foto_prod); 
        }   
        $this->filtrar(); 
    }

    public function filtrar(){
        $this->compra = Compra::find($this->compra_id);              
        $this->tipo_cambio = $this->compra->tipo_com;            
        
        //MUESTRA BOTON "NUEVO" SI ITEMS PRODUCTOS MENOR A ITEMS COMPRADOS
        $this->items_comprados = $this->compra->items_com; 
        $this->items_productos = $this->compra->productos()->count();

        $this->calculaGastoImportacionPorFecha();       
        $this->render();         
    }

    public function codProdIni(){        
        $categoria = Categoria::find($this->categoria_id);
        $this->cod_prod = $categoria->cat_cod.'-';
    }

    public function inventariar($id){              
        $producto = Producto::find($id);          
        $this->idProdGlobal = $producto->id; //SE USA EN REGISTRA ENTRADA
        $this->cantidad_producto = $producto->cant_prod;        
        $stock = Stock::where('cod_prod', '=', $producto->cod_prod)->first();          
        if (empty($stock)){            
            $this->idProd = $producto->id; 
            $this->CalculaPrecioVenta();                        
            $this->emit('infoNewStock', $producto->cod_prod);  
        }
        else{
            $this->idStock = $stock->id;     
            $this->CalculaPrecioVenta();  
            //VERIFICAR PRECIO SI NO CAMBIO PRECIO DE PRODUCTO
            if ($this->precio_venta_dolar <= $stock->precio_prod) {
                $this->emit('infoAddStock', $stock->medida_prod, $stock->desc_prod, $stock->stock_prod, $stock->precio_prod, number_format($this->precio_venta_dolar, 2, ',', '.'), 'Se actualizara el stock y se mantiene precio anterior');    
            } else {
                $this->emit('infoAddStock', $stock->medida_prod, $stock->desc_prod, $stock->stock_prod, $stock->precio_prod, number_format($this->precio_venta_dolar, 2, ',', '.'), 'Se actualizara el stock y se aplicará el nuevo precio');    
            }                                
        }              
    }

    public function calculaGastoImportacionPorFecha(){//VARIABLE DE RETORNO EN % (totalAdicionalSus)
        $this->totalMercanciaOrigen = 0;
        $this->totalMercanciaSus = 0;
        $this->totalPagosSus = 0;
        $this->totalAdicionalSus = 0;
        $this->compra = Compra::find($this->compra_id); 
        $productos_comprados = $this->compra->productos;//TODOS LOS PRODUCTO PARA ESA FECHA    
        if ($productos_comprados->count()>0){//SI HAY REGISTROS                    
            foreach($productos_comprados as $reg)// SUMA TOTAL MERCANCIA PARA UNA FECHA DETERMINADA
            {            
                $this->totalMercanciaOrigen += ($reg->precio_prod*$reg->cant_prod);//MONEDA DE ORIGEN          
            }         
            $this->totalMercanciaSus = $this->totalMercanciaOrigen/$this->compra->tipo_com;//CON TIPO DE CAMBIO ORIGEN CONVERTIMOS A $US
            $this->totalPagosSus = $this->compra->pagos->sum('monto_pago'); //SUMAMOS TODOS LOS PAGOS PARA ESA FECHA YA EN DOLARES
            $this->totalAdicionalSus =  ($this->totalPagosSus*100)/$this->totalMercanciaSus; //CALCULAMOS GASTOS DE IMPORTACION        

        }                  
    }    

    public function CalculaPrecioVenta(){ //VARIABLE DE RETORNO EN $us (precio_venta_dolar)                           
        $precioCompraProductoSus = 0;
        $gastoImportacionProductoSus = 0;
        $precioRealProductoSus = 0;        
        $this->precio_venta_dolar = 0;
        $this->calculaGastoImportacionPorFecha();
        if($this->totalAdicionalSus>0){            
            $producto = Producto::find($this->idProdGlobal); 
            $precioCompraProductoSus = $producto->precio_prod/$this->compra->tipo_com;        
            $gastoImportacionProductoSus = ($this->totalAdicionalSus*$precioCompraProductoSus)/100;        
            $precioRealProductoSus = $precioCompraProductoSus + $gastoImportacionProductoSus;         
            $this->precio_venta_dolar = ($precioRealProductoSus+($precioRealProductoSus*$this->utilidad/100)); //UTILIDAD DEBE SER VARIABLE GLOBAL        
        }              
    }

    public function addstock(){                
        if ($this->idStock) { 
            $stock =Stock::find($this->idStock);             
            $nuevo_stock = $stock->stock_prod + $this->cantidad_producto;            
            /**********************************************************************
             ****** SER MANTIENE O SE ACTUALIZA EL PRECIO DE VENTA DE ACUERDO *****
             ****** AL TIPO DE CAMBIO DEL DOLAR ORIGEN Y POSIBLES CAMBIOS EN  *****
             ****** LOS GASTOS DE IMPORTACION                                 ***** 
             **********************************************************************/                     
            //VERIFICAR PRECIO SI NO CAMBIO PRECIO DE PRODUCTO
            if ($this->precio_venta_dolar <= $stock->precio_prod) {
                $stock->update([            
                    'stock_prod' => $nuevo_stock                     
                ]);       
            } else {
                $stock->update([            
                    'stock_prod' => $nuevo_stock,
                    'precio_prod' => $this->precio_venta_dolar, 
                ]);        
            }                           
            $this->okInv();
            $this->regEntrada();            
            $this->filtrar();
        }
    }

    public function newStock(){                  
        if ($this->idProd) {  
            $producto = Producto::find($this->idProd);            
            Stock::create([
                'deposito_id' => 1,//NO ASIGANDO POR DEFAULT                            
                'cod_prod'  => $producto->cod_prod,        
                'desc_prod' => $producto->desc_prod,
                'stock_prod' => $producto->cant_prod, 
                'medida_prod' => $producto->medida_prod, 
                'color_prod' => $producto->color_prod,          
                'um_prod' => $producto->um_prod,
                'precio_prod' => $this->precio_venta_dolar,         
                'calidad_prod' => $producto->calidad_prod,                   
                'foto_prod' => $producto->foto_prod            
            ]);                        
            $producto->update([                
                'ok_inv' => 1 //PRODUCTO INVENTARIADO                
            ]);            
            $this->okInv();
            $this->regEntrada();
            $this->filtrar();            
        }             
    }
    public function okInv(){
        if ($this->idProdGlobal) {     
            $producto = Producto::find($this->idProdGlobal);    
            $producto->update([            
                'ok_inv' => 1
            ]);
        }        
    }

    public function regEntrada(){    
        if ($this->idProdGlobal) {     
            $producto = Producto::find($this->idProdGlobal);    
            Entrada::create([
                'producto_id' => $producto->id,                            
                'fecha_ent' => Carbon::now(),
                'codprod_ent'  => $producto->cod_prod,        
                'cantprod_ent' => $producto->cant_prod,                          
                'precio_ent' => $this->precio_venta_dolar
            ]); 
        }                         
    }

    public function recuperaRegistro(){
        $producto = Producto::where('cod_prod', '=', $this->cod_prod)->first();
        if ($producto <> null) {     
            $this->cod_prod = $producto->cod_prod;        
            $this->desc_prod = $producto->desc_prod;
            $this->medida_prod = $producto->medida_prod; 
            $this->color_prod = $producto->color_prod;          
            $this->um_prod = $producto->um_prod;
            $this->precio_prod = $producto->precio_prod; 
            $this->calidad_prod = $producto->calidad_prod;           
        }         
    }
}
