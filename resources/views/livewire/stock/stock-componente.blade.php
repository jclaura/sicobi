<div class="container-fluid"> 
    <div class="card">
      <div class="card-header">
        <h6 class="card-title">STOCK EN DEPÓSITOS - TIPO DE CAMBIO: {{$tipo_cambio_local}}</h6>                                
      </div>{{--CARD-HEADER--}}    
      <div class="card-body p-0">               
        <table class="table table-sm" style="font-size: 12px;">
          <thead class="table-secondary">
            <tr>
                <th>ID</th>
                <th>DEPÓSITO</th>
                <th>CODIGO</th>
                <th>DESCRIPCION</th>           
                <th>MEDIDA</th>  
                <th>COLOR</th>  
                <th>UM</th>
                <th>$us</th>                                         
                <th>Bs.</th>   
                <th class="text-center">STOCK</th>                                        
                <th class="text-center">CALIDAD</th>                                        
                <th>FOTO</th>
                <th>ACCIONES</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($stock as $item)
              <tr>                              
                <td>{{$item->id}}</td>                                
                <td>{{$item->deposito->nom_dep}}</td>                
                <td>{{$item->cod_prod}}</td> 
                <td>{{$item->desc_prod}}</td>
                <td>{{$item->medida_prod}}</td>
                <td>{{$item->color_prod}}</td>
                <td>{{$item->um_prod}}</td>
                <td>{{$item->precio_prod}}</td>                                                 
                <td>{{number_format($item->precio_prod*$tipo_cambio_local, 2, '.', '')}}</td>                 
                @if ($item->stock_prod <= 5)                   
                  <td class="text-center"><span class="blink_me text-danger"><strong>{{$item->stock_prod}}</strong></span></td>
                @else                  
                  <td>{{$item->stock_prod}}</td>
                @endif                               
                <td class="text-center">{{$item->calidad_prod}}</td>  
                @if ($item->foto_prod <> "noimage.png") 
                  <td>                    
                    <a href="#" onclick="verFoto('{{$item->foto_prod}}','{{$rutaFotosProductos}}')"><img src="{{ Storage::url('FotosProductos/'.$item->foto_prod)}}" alt="Zoom Foto" height="38" width="51">  
                  </td>  
                @else                  
                  <td>
                    <a href="#" onclick="verFotoNoDisponible()"><img src="{{asset('noimage.png')}}" alt="Zoom Foto" height="38" width="51">  
                  </td>
                @endif                    
                <td>                                           
                  <button wire:click="edit('{{$item->id}}')" class="bnt btn-info btn-xs" title="Editar"><i class="fas fa-edit"></i></button>                                            
                  <button wire:click="salida('{{$item->id}}')" class="bnt btn-success btn-xs" title="Salida"><i class="fas fa-arrow-right"></i></button>
                </td>
              </tr>   
            @endforeach                                       
          </tbody>
        </table>    
      </div>{{--CARD-BODY--}}     
      <div class="card-footer clearfix">      
        {{--$proveedor->links()--}} 
      </div>   
    </div>{{--CARD--}}
  
    @include('livewire.stock.create') 
    @include('livewire.stock.edit')
    @include('livewire.stock.salida')
  </div>{{--CONTAINER--}}  
  
  @push('scripts'){
    <script src="js/alertas.js"></script> 

    <script>
      $(function () {
        $(".floatNumberField").change(function() {         
            $(this).val(parseFloat($(this).val()).toFixed(2));            
        });
      });   
    </script>
    
  @endpush