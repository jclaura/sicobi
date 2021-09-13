<div class="container-fluid"> 
    <div class="card">
      <div class="card-header">
        <h6 class="card-title">GASTOS DE IMPORTACIÓN - $US</h6>       
        <div class="card-tools">
          @if (!$compra->pagos_com)            
            <button type="button" wire:click="resetVar" class="btn btn-success btn-xs" data-toggle="modal" data-target="#createPagoModal"><i class="fas fa-plus"></i> Nuevo</button>                            
          @endif           
        </div>                          
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
              <th class="text-center">PAGO FINALIZADO</th>                                   
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
              @if (!$compra->pagos_com)
                <label for="pagos">Pagos:</label>
                <select wire:model="pagos_com" wire:change="$emit('confirmarPagos')" id="pagos">
                  <option value="volvo">En proceso</option>
                  <option value="saab">Finalizado</option>              
                </select>                                                                                                            
              @endif                                                                                   
          </div>                                         
        </div>                   

        <table class="table table-sm" style="font-size: 12px;">
          <thead class="table-secondary">
            <tr>
              {{--<th scope="col">COMPRA</th>--}}
              <th>ID</th>
              <th>FECHA DE PAGO</th>              
              <th>MONTO $US</th>
              <th>DESCRIPCION</th>
              <th>NOTA</th>              
              <th>ACCIONES</th>
            </tr>
          </thead>
          <tbody> 
            @php                                 
              $totalSus=0;                
            @endphp 
            @foreach ($pagos as $item)             
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->fecha_pago}}</td>                                     
                    <td>{{number_format($item->monto_pago, 2, ',', '.')}}</td>
                    @php                      
                      $totalSus=$totalSus+$item->monto_pago;                  
                    @endphp 
                    <td>{{$item->desc_pago}}</td>  
                    <td>{{$item->nota_pago}}</td> 
                    @if ($compra->pagos_com)
                      <td>                         
                        <button wire:click="edit('{{$item->id}}')" class="bnt btn-secondary btn-xs" title="Editar" disabled><i class="fas fa-edit"></i></button>                          
                        <button wire:click="$emit('borrarReg', {{$item->id}})" class="bnt btn-secondary btn-xs" title="Eliminar" disabled><i class="fas fa-trash-alt"></i></button>
                      </td>  
                    @else   
                      <td>                         
                        <button wire:click="edit('{{$item->id}}')" class="bnt btn-info btn-xs" title="Editar"><i class="fas fa-edit"></i></button>                          
                        <button wire:click="$emit('borrarReg', {{$item->id}})" class="bnt btn-danger btn-xs" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                      </td>                    
                    @endif    
                        
                </tr>   
            @endforeach  
            <tr class="table-primary">
              <td></td>              
              <td><strong>TOTAL:</strong></td>              
              <td><strong>{{number_format($totalSus, 2, ',', '.')}}</strong></td>
              <td></td> 
              <td></td> 
              <td></td> 
            </tr>                                
          </tbody>
        </table>    
      </div>{{--CARD-BODY--}}    
      <div class="card-footer clearfix">      
        {{--$productos->links() --}}
      </div>   
    </div>{{--CARD--}}
  
    @include('livewire.pagos.create') 
    @include('livewire.pagos.edit')
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

