<div class="container-fluid">  
  @if ($activo_caja)  
    {{--********************************************************************
    *********           FILA STOCK DE PRODUCTOS         ********************
    *********************************************************************--}}
    <div class="row">
      <div class="col-12">
        <div class="card">        
          <div class="card-header">       
            <h6 class="card-title"><strong>STOCK - {{$tienda_nombre}} - {{ $activo_caja ? 'CAJA ABIERTA' : 'CAJA CERRADA' }}</strong></h6> 
            {{--DATOS DE CABECERA Y TABLA DE PRODUCTOS--}}
            @if ($activo_caja)
              <div class="card-tools">                           
                <button type="button" wire:click="racuperaDatosCaja" class="btn btn-primary btn-sm">Caja</button>                          
                <button type="button" wire:click="gastos" class="btn btn-primary btn-sm">Gastos</button>                
              </div>                   
            @endif                               
          </div>{{--CARD-HEADER--}}    
          <div class="card-body">         
            <div class="row">{{--ROW CATEGORIA Y BUSCAR--}} 
              <div wire:ignore class="col-6 mb-2">                
                <select id="select2-dropdown" class="form-control">    
                  <option value="">Filtrar por categoría</option>            
                  @foreach ($categoria as $item)        
                    <option value="{{$item->id}}">{{$item->cat_desc}}</option>  
                  @endforeach 
                </select>  
              </div>{{--FIN COL CATEGORIA--}}          
              <div class="col-6 mb-2">
                <input type="text" wire:model="search" class="form-control" placeholder="Buscar producto...">                              
              </div>{{--FIN COL BUSCAR--}}          
            </div>{{--FIN ROW CATEGORIA Y BUSCAR--}} 
            <div class="row">{{--ROW TABLA STOCK PRODUCTOS--}}
              <div class="col-12">
                <table class="table table-sm" style="font-size: 12px;">
                  <thead class="table-secondary">
                    <tr>
                        <th scope="col">ID</th>                            
                        <th scope="col">CODIGO</th>
                        <th scope="col">DESCRIPCION</th>           
                        <th scope="col">MEDIDA</th>  
                        <th scope="col">COLOR</th>  
                        <th scope="col">UM</th>                
                        <th scope="col">PRECIO</th>   
                        <th scope="col">STOCK</th>                                                        
                        <th scope="col">FOTO</th>                
                        <th scope="col">ACCIONES</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($stock as $item)
                      <tr>                              
                        <td>{{$item->id}}</td>  
                        <td>{{$item->cod_prod}}</td>                                
                        <td>{{$item->desc_prod}}</td>                                                                                
                        <td>{{$item->medida_prod}}</td> 
                        <td>{{$item->color_prod}}</td> 
                        <td>{{$item->um_prod}}</td> 
                        <td>{{number_format($item->precio_prod, 2, '.', '')}}</td>                 
                        <td>{{$item->stock_prod}}</td> 
                        @if ($item->foto_prod <> "noimage.png") 
                        <td>                    
                          <a href="#" onclick="verFoto('{{$item->foto_prod}}','{{$rutaFotosProductos}}')"><img src="{{ Storage::url('FotosProductos/'.$item->foto_prod)}}" alt="Zoom Foto" height="38" width="51">  
                        </td>  
                        @else                  
                          <td>
                            <a href="#" onclick="verFotoNoDisponible()"><img src="{{asset('noimage.png')}}" alt="Zoom Foto" height="38" width="51">  
                          </td>
                        @endif   
                        @if ($item->stock_prod>0)
                          <td>              
                            <button id="boton{{$item->id}}" wire:click="factura('{{$item->id}}', '{{$item->um_prod }}', '{{$item->desc_prod}}', '{{$item->precio_prod}}')" class="bnt btn-success btn-sm"><i class="fas fa-shopping-cart"></i></button>                                                       
                          </td>  
                        @else
                          <td>              
                            <button class="bnt btn-info btn-sm" disabled><i class="fas fa-shopping-cart"></i></button>                                                       
                          </td>  
                        @endif                                                             
                      </tr>   
                    @endforeach                                   
                  </tbody>
                </table>     
              </div>{{--FIN COL TABLA STOCK PRODUCTOS--}}
            </div>{{-- FIN ROW TABLA STOCK PRODUCTOS--}} 
          </div>{{--CARD-BODY--}}  
          <div class="card-footer">
            {{$stock->links()}}
          </div>{{--CARD-BODY--}}  
        </div>{{--CARD--}}  
      </div>{{--COL-12--}}
    </div>{{--FIN FILA STOCK DE PRODUCTOS--}}
    

    {{--********************************************************************
    *********          FILA VENTA Y RESUMEN DE VENTAS          *************
    *********************************************************************--}}
    <div class="row">
      <div class="col-9">{{--COL FACTURA--}}
        <div class="card">        
          <div class="card-header">       
            <h6 class="card-title"><strong>VENTA</strong></h6>                                                                       
          </div>{{--CARD-HEADER--}}  
          <div class="card-body">                     
            <div class="row mb-1">{{--ROW CABECERA FACTURA--}}
              <div class="col-4">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#clienteModal"><span class="fas fa-plus"></span> Nuevo</button>                   
                  </div>
                  <div wire:ignore>
                    <select id="select2-cliente" class="form-control">            
                      @foreach ($clientes as $cliente)                  
                        <option value="{{$cliente->id}}">{{$cliente->nom_cli}}</option>                            
                      @endforeach 
                    </select>  
                  </div>                                   
                </div>
              </div>{{--FIN COL CLIENTES--}}
              <div class="col-4">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Fecha:</span>
                  </div>                  
                  <input wire:model="fecha_venta" type="date" class="form-control">
                </div> 
              </div>{{--FIN COL FECHA--}}
              <div class="col-4">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">NIT/CI/SD:</span>
                  </div>                                    
                  <input wire:model="cab_doc_cli" type="text" class="form-control" placeholder="Sin Datos"> 
                </div>     
              </div>{{--FIN COL DOCUMENTO--}}              
            </div>
            <div class="row">{{--ROW TABLA FACTURA--}}
              <div class="col-12">
                <table class="table table-bordered table-sm" style="font-size: 12px;">
                  <thead class="thead-dark">
                    <tr>         
                      <th scope="col">ID</th> 
                      <th scope="col">CANTIDAD</th>        
                      <th scope="col">UNIDAD</th>
                      <th scope="col">CONCEPTO</th>
                      <th scope="col">PRECIO</th>
                      <th scope="col">SUBTOTAL</th>
                      <th scope="col">ACCIONES</th>
                    </tr>
                  </thead>
                  <tbody>        
                    @foreach (Cart::session($userId)->getContent() as $item)
                      <tr>                        
                        <td>{{$item->id}}</td>                                                                                           
                        <td>
                          <input type="number" wire:change="actCant('{{$item['id']}}',  $('#'+{{$item['id']}}).val())" id="{{$item['id']}}" value="{{$item->quantity}}" min="1" max="10000">
                        </td>
                        <td>{{$item->attributes->um}}</td>               
                        <td>{{$item->name}}</td>                                                             
                        <td>{{$item->price}}</td>                                                                           
                        <td>{{$item->quantity*$item->price}}</td>  
                        <td>              
                          <button wire:click="decCant('{{$item['id']}}')" class="bnt btn-primary btn-sm"><i class="fas fa-minus"></i></button>                                                                     
                          <button wire:click="incCant('{{$item['id']}}')" class="bnt btn-primary btn-sm"><i class="fas fa-plus"></i></button>
                          <button wire:click="anulaFila('{{$item['id']}}')" class="bnt btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>   
                      </tr>                             
                    @endforeach 
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$this->subTotal}}</td>                              
                  </tbody>     
                </table>    
              </div>  
            </div>
          </div>{{--CARD-BODY--}}  
          <div class="card-footer">
            <p class="card-text">...</p>
          </div>{{--CARD-BODY--}}  
        </div>{{--CARD--}}  
      </div>
      <div class="col-3">{{--COL RESUMEN VENTAS--}}
        <div class="card bg-black">        
          <div class="card-header">       
            <h6 class="card-title"><strong>RESUMEN DE VENTA - TOTAL A PAGAR</strong></h6>                                                            
          </div>{{--CARD-HEADER--}}  
          <div class="card-body">         
            <div class="row">
              <div class="col-12">
                <h3 class="text-success text-center">{{number_format($total, 2, ',', '.')}}</h3>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-6">
                <label for="descuento">Descuento:</label>  
                <input type="number" wire:model="descuento" wire:change="restaDescuento" class="form-control floatNumberField" value="0.00" placeholder="0.00" step="0.01" />
              </div>
              <div class="col-6">
                <label for="totalVenta">Total:</label>  
                <input type="number" wire:model="totalVenta" class="form-control floatNumberField" value="" placeholder="0.00" step="0.01" disabled/>   
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-6">
                <label for="efectivo">Efectivo:</label>  
                <input type="number" wire:model="efectivo" wire:change="calculaCambio" class="form-control floatNumberField"  value="0.00" placeholder="0.00" step="0.01" />                    
              </div>
              <div class="col-6">
                <label for="cambio">Cambio:</label>  
                <input type="number" wire:model="cambio" class="form-control floatNumberField"  value="0.00" placeholder="0.00" step="0.01" disabled/>                      
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="form-group">   
                  <label for="forma_pago">Forma de pago:</label>           
                  <select wire:model="forma_pago" value="1" class="form-control">                
                    <option value="1">Efectivo</option>
                    <option value="2">Transferencia bancaria</option>
                    <option value="3">Tarjeta</option>
                    <option value="4">Crédito</option>
                  </select>  
                </div>  
              </div>              
            </div>
          </div>{{--CARD-BODY--}}  
          <div class="card-footer text-center">
            <button type="button" wire:click="finVenta" class="btn btn-success">Finalizar venta</button>            
          </div>{{--CARD-BODY--}}  
        </div>{{--CARD--}}  
      </div>
    </div>{{--FIN ROW FACTURA Y RESUMEN DE VENTAS--}}
  @else
    <div class="row bg-black text-center">
      <div class="col-12 mt-2 mb-2">             
        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#cajaModal">
          <strong>APERTURA DE CAJA</strong>
        </button>      
      </div>
    </div>  
  @endif   
  @include('livewire.ventas.caja')     
  @include('livewire.ventas.gastos') 
  @include('livewire.ventas.clientes') 
</div>{{--CONTAINER--}}  
  
@push('scripts'){
  <script src="js/alertas.js"></script> 

  <script>     
    $(function () {
      $(".floatNumberField").change(function() {         
          $(this).val(parseFloat($(this).val()).toFixed(2));            
      });
    });  
    
    document.addEventListener('DOMContentLoaded', function(){         
      $("#efectivo_caja").keyup(function(e){
        var valorInicial = 0;  
        if(e.which == 13) { //ENTER           
          Livewire.emit('calcula_diferencia');
        }          
        if(e.which == 8) { //BACKSPACE                                                 
          @this.set('diferencia_caja', valorInicial.toFixed(2));
        }    
        if(e.which == 46) { //DELETE                                        
          @this.set('diferencia_caja', valorInicial.toFixed(2));
        }
      });    

      $("#saldo_caja").keyup(function(e){
        var valorInicial = 0;
        if(e.which == 13) { //ENTER           
            Livewire.emit('saldo_inicial');
        }          
        if(e.which == 8) { //BACKSPACE    
          var tc = totalCaja();            
          @this.set('total_caja', tc.toFixed(2));                                                
          @this.set('efectivo_caja', valorInicial.toFixed(2));                                                
          @this.set('diferencia_caja', valorInicial.toFixed(2));
        }    
        if(e.which == 46) { //DELETE   
          var tc = totalCaja();        
          @this.set('total_caja', tc.toFixed(2));                                                
          @this.set('efectivo_caja', valorInicial.toFixed(2));                                                
          @this.set('diferencia_caja', valorInicial.toFixed(2));  
        }
      });  

      $("#ingresos_caja").keyup(function(e){
        var valorInicial = 0;       
        if(e.which == 13) { //ENTER                        
          var tc = totalCaja();                             
          @this.set('total_caja', tc.toFixed(2)); 
          @this.set('efectivo_caja', valorInicial.toFixed(2));                                                
          @this.set('diferencia_caja', valorInicial.toFixed(2));               
        }          
        if(e.which == 8) { //BACKSPACE               
          var tc = totalCaja();          -
          @this.set('total_caja', tc.toFixed(2));                                                
          @this.set('efectivo_caja', valorInicial.toFixed(2));                                                
          @this.set('diferencia_caja', valorInicial.toFixed(2));  
        }    
        if(e.which == 46) { //DELETE           
          var tc = totalCaja();        
          @this.set('total_caja', tc.toFixed(2));                                                
          @this.set('efectivo_caja', valorInicial.toFixed(2));                                                
          @this.set('diferencia_caja', valorInicial.toFixed(2));    
        }
      });  

      function totalCaja(){
        var sc = parseFloat($("#saldo_caja").val()) || 0; 
        var vc = parseFloat($("#venta_caja").val()) || 0; 
        var ic = parseFloat($("#ingresos_caja").val()) || 0;                  
        var ec = parseFloat($("#egresos_caja").val()) || 0;                   
        var td = (sc+vc+ic)-ec;    
        return td;
      }  

    }) //****    
    
    document.addEventListener('DOMContentLoaded', function(){
      $('#select2-dropdown').select2();//Inicializar
      $('#select2-dropdown').on('change', function(e){
        var cId = $('#select2-dropdown').select2('val');
        var cName = $('#select2-dropdown option:selected').text();
        @this.set('categoriaSelectedId', cId);
        @this.set('categoriaSelectedName', cName);
        Livewire.emit('filtraCategoria')
      });
    }) 

    document.addEventListener('DOMContentLoaded', function(){
      $('#select2-cliente').select2();//Inicializar
      $('#select2-cliente').on('change', function(e){
        var clienteId = $('#select2-cliente').select2('val');        
        @this.set('clienteSelectedId', clienteId);        
        Livewire.emit('obtieneDatosCliente')
      });
    })     
  
    Livewire.on('clienteOcacional', msg =>{         
        $("#select2-cliente").select2("val", "1");    
    }) 
      
    Livewire.on('confirmarCierreCaja', () => {
        Swal.fire({
        title: 'Estas seguro?',
        text: "No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, cerrar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          Livewire.emit('cerrarCaja')
          Swal.fire(
            'Cerrado!',
            'La caja ha sido cerrado.',
            'success'
          )
        } 
      })
    })    

    window.onload = function(){ 
      Livewire.on('imprimirRecibo',() => {
        Swal.fire({        
        text: "Deseas imprimir comprabante de compra?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Si',
        cancelButtonText: "No", 
        }).then((result) => {
          if (result.value) {                              
            @this.imprimeRecibo() 
          }
        })  
      })          
    }     
  </script>       
@endpush