<div class="container-fluid">   
    <div class="card">
      <div class="card-header">
        <h6 class="card-title">PRODUCTOS</h6>  
        @if ($this->items_productos<$this->items_comprados)
          <div class="card-tools">
            <button type="button" wire:click="resetVar" class="btn btn-success btn-xs" data-toggle="modal" data-target="#createProductoModal"><i class="fas fa-plus"></i> Nuevo</button>
          </div>            
        @endif         
      </div>{{--CARD-HEADER--}}          
      <div class="card-body p-0"> 
        <table class="table table-sm" style="font-size: 12px;">
          <thead class="table-dark">
            <tr>
              <th>IMPORTADOR</th>
              <th>ITEMS</th>
              <th>MONEDA</th>
              <th>TIPO DE CAMBIO</th>
              <th>PAIS</th>
              <th class="text-center">PAGOS</th>
              <th class="text-center">GIROS</th>                          
            </tr>
          </thead>
          <tbody class="table-info">            
              <tr>                
                <td>{{$compra->comprador_com}}</td>                                
                <td>{{$compra->items_com}}</td>
                <td>{{$compra->moneda_com}}</td>                                
                <td>{{$compra->tipo_com}}</td>
                <td>{{$compra->pais_com}}</td>                
                @if ($compra->pagos_com)
                  <td class="text-center text-success"><i class="fas fa-check"></i></td>  
                @else
                  <td class="text-center text-danger"><i class="fas fa-times"></i></td>  
                @endif                  
                @if ($compra->giros_com)
                  <td class="text-center text-success"><i class="fas fa-check"></i></td>  
                @else
                  <td class="text-center text-danger"><i class="fas fa-times"></i></td>  
                @endif                
              </tr>                             
          </tbody>
        </table>                                   
        <div class="form-row ml-0 mt-2" style="font-size: 12px;">
          <div class="col"> 
            <label>Fecha: </label>        
            <select wire:model="compra_id" wire:change="filtrar">                   
              @foreach ($importaciones as $fecha)        
                <option value="{{$fecha->id}}">{{$fecha->fecha_com}}</option>  
              @endforeach 
            </select>             
          </div>       
          <div class="col"> 
            <label>Total {{$compra->moneda_com}}: </label>
            {{number_format($totalMercanciaOrigen, 2, ',', '.')}}             
          </div>             
          <div class="col"> 
            <label>Total $us: </label>
            {{number_format($totalMercanciaSus, 2, ',', '.')}}             
          </div> 
          <div class="col"> 
            <label>Gastos: </label>
            {{number_format($totalPagosSus, 2, ',', '.')}}            
          </div> 
          <div class="col"> 
            <label>Incremento(%): </label>
            {{number_format($totalAdicionalSus, 2, ',', '.')}}             
          </div> 
        </div>         
        <table class="table table-sm" style="font-size: 12px;">
          <thead class="table-secondary">
            <tr>
              <th>ITEM</th>
              <th>CATEGORIA</th>              
              <th>CÓDIGO</th>
              <th>DESCRIPCIÓN</th>
              <th>CANT.</th>
              <th>MEDIDA</th>
              <th>COLOR</th>
              <th>UM</th>
              <th>PRECIO</th>
              <th>TOTAL</th>
              <th>$us</th>
              <th>CALIDAD</th>
              <th>PROVEEDOR</th>
              <th>FOTO</th>
              <th>NOTA</th>
              <th>OK</th>
              <th>INV.</th>              
              <th>ACCIONES</th>
            </tr>
          </thead>
          <tbody>
            @php                  
              $totalCompra=0;   
              $totalSus=0;                         
            @endphp 
            <?php $count = 1; ?> 
            @foreach ($productos as $item)
              <tr>                                                                                          
                <td>{{$productos->perPage()*($productos->currentPage()-1)+$count}}</td>              
                <?php $count++; ?>
                <td>{{$item->categoria->cat_desc}}</td>
                <td>{{$item->cod_prod}}</td>
                <td>{{$item->desc_prod}}</td>
                <td>{{$item->cant_prod}}</td>  
                <td>{{$item->medida_prod}}</td>
                <td>{{$item->color_prod}}</td>  
                <td>{{$item->um_prod}}</td>  
                
                <td>{{number_format($item->precio_prod, 2, ',', '.')}}</td>
                <td>{{number_format($item->precio_prod*$item->cant_prod, 2, ',', '.')}}</td>                 
                @php
                  $sus= $item->precio_prod/$tipo_cambio;                   
                  $totalCompra=$totalCompra+($item->precio_prod*$item->cant_prod);
                  $totalSus=$totalSus+($sus*$item->cant_prod);                  
                @endphp 

                <td>{{number_format($sus, 2, ',', '.')}}</td>
                <td class="text-center"><strong>{{$item->calidad_prod}}</strong></td>  
                <td>{{$item->proveedor->emp_prov}}</td>  

                @if ($item->foto_prod <> "noimage.png") 
                  <td>                    
                    <a href="#" onclick="verFoto('{{$item->foto_prod}}','{{$rutaFotosProductos}}')"><img src="{{ Storage::url('FotosProductos/'.$item->foto_prod)}}" alt="Zoom Foto" height="38" width="51">  
                  </td>  
                @else                  
                  <td>
                    <a href="#" onclick="verFotoNoDisponible()"><img src="{{asset('noimage.png')}}" alt="Zoom Foto" height="38" width="51">  
                  </td>
                @endif                               
                
                @if ($item->nota_prod == 'N.E.')                  
                  <td>Vacio</td>
                @else
                  <td><a href="#" onclick="verTexto('{{$item->desc_prod}}', '{{$item->nota_prod}}' )">Ver</a></td>                  
                @endif                  

                @if ($item->ok_prod)
                  <td class="text-center text-success"><i class="fas fa-check"></i></td>  
                @else
                  <td class="text-center text-danger"><i class="fas fa-times"></i></td>  
                @endif  
                @if ($item->ok_inv)
                  <td class="text-center text-success"><i class="fas fa-check"></i></td>  
                @else
                  <td class="text-center text-danger"><i class="fas fa-times"></i></td>  
                @endif                                                                    
                <td>
                  @if ($item->ok_prod AND $ind_inv)                  
                    @if (!$item->ok_inv)                                                       
                      <button wire:click="inventariar('{{$item->id}}')" class="bnt btn-success btn-xs" title="Inventariar"><i class="fas fa-poll"></i></button>                     
                    @endif                                      
                  @endif  
                  @if ($item->ok_inv AND $item->ok_prod)
                    <button wire:click="edit('{{$item->id}}')" class="bnt btn-secondary btn-xs" title="Editar" disabled><i class="fas fa-edit"></i></button>                          
                    <button wire:click="$emit('borrarReg', {{$item->id}})" class="bnt btn-secondary btn-xs" title="Eliminar" disabled><i class="fas fa-trash-alt"></i></button>  
                  @else
                    <button wire:click="edit('{{$item->id}}')" class="bnt btn-info btn-xs" title="Editar"><i class="fas fa-edit"></i></button>                          
                    <button wire:click="$emit('borrarReg', {{$item->id}})" class="bnt btn-danger btn-xs" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                  @endif                        
                </td>
              </tr>   
            @endforeach                 
          </tbody>
        </table>    
      </div>{{--CARD-BODY--}}    
      <div class="card-footer clearfix">      
        {{$productos->links()}}
      </div>   
    </div>{{--CARD--}}
  
    @include('livewire.productos.create') 
    @include('livewire.productos.edit')
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
