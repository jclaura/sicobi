<div class="container-fluid"> 
    <div class="card">
      <div class="card-header">
        <h6 class="card-title">GIRO BANCARIO - $US</h6>       
        <div class="card-tools">
          @if (!$compra->giros_com)  
            <button type="button" wire:click="resetVar" class="btn btn-success btn-xs" data-toggle="modal" data-target="#createGiroModal"><i class="fas fa-plus"></i> Nuevo</button>
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
              <th class="text-center">TRANSFERENCIAS FINALIZADO</th>                                   
            </tr>
          </thead>
          <tbody class="table-info">            
              <tr>                
                <td>{{$compra->comprador_com}}</td>                                
                <td>{{$compra->items_com}}</td>
                <td>{{$compra->moneda_com}}</td>                                
                <td>{{$compra->tipo_com}}</td>
                <td>{{$compra->pais_com}}</td>                
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
              @if (!$compra->giros_com)
                <label for="pagos">Transferencias:</label>
                <select wire:model="giros_com" wire:change="$emit('confirmarGiros')" id="giros">
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
              <th>FECHA</th>              
              <th>MONTO</th>
              <th>COMISION</th>
              <th>DOCS.</th>              
              <th>ITF</th>
              <th>EXTRAVIO</th>              
              <th>SUBTOTAL</th>   
              <th>ACCIONES</th>
            </tr>
          </thead>
          <tbody> 
            @php                                 
              $totalGiro=0;                
              $totalComision=0;
              $totalDocs=0;
              $totalItf=0;
              $totalExtravio=0;
              $subTotal=0;
              $totalSubTotal=0;
            @endphp 
            @foreach ($giros as $item)             
                <tr>
                    <td>{{$item->id}}</td>                    
                    <td>{{ date('d-m-Y', strtotime($item->fecha_giro)) }}</td>    
                                                  
                    <td>{{number_format($item->monto_giro, 2, ',', '.')}}</td>
                    @php                      
                      $totalGiro=$totalGiro+$item->monto_giro;                  
                    @endphp                       
                    <td>{{number_format($item->comision_giro, 2, ',', '.')}}</td> 
                    @php                      
                        $totalComision=$totalComision+$item->comision_giro;                  
                    @endphp                     
                    <td>{{number_format($item->docs_giro, 2, ',', '.')}}</td>
                    @php                      
                        $totalDocs=$totalDocs+$item->docs_giro;                  
                    @endphp                      
                    <td>{{number_format($item->itf_giro, 2, ',', '.')}}</td> 
                    @php                      
                        $totalItf=$totalItf+$item->itf_giro;                  
                    @endphp                     
                    <td>{{number_format($item->extravio_giro, 2, ',', '.')}}</td>  
                    @php                      
                        $totalExtravio=$totalExtravio+$item->extravio_giro;                  
                    @endphp  

                    @php    
                        $totalComision = (($item->monto_giro*$item->comision_giro)/100)+$item->docs_giro;
                        $totalItf = (($item->monto_giro+$totalComision)*$item->itf_giro)/100;    

                        $subTotal = $item->monto_giro+$totalComision+$totalItf+$item->extravio_giro;                  
                        $totalSubTotal = $totalSubTotal + $subTotal;
                    @endphp  
                    <td>{{number_format($subTotal, 2, ',', '.')}}</td> 
                    @if ($compra->giros_com)
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
                <td><strong>TOTALES:</strong></td>              
                <td><strong>{{number_format($totalGiro, 2, ',', '.')}}</strong></td>
                <td><strong>{{number_format($totalComision, 2, ',', '.')}}</strong></td>
                <td><strong>{{number_format($totalDocs, 2, ',', '.')}}</strong></td>               
                <td><strong>{{number_format($totalItf, 2, ',', '.')}}</strong></td> 
                <td><strong>{{number_format($totalExtravio, 2, ',', '.')}}</strong></td> 
                <td><strong>{{number_format($totalSubTotal, 2, ',', '.')}}</strong></td> 
                <td></td> 
              </tr>                                            
          </tbody>
        </table>    
      </div>{{--CARD-BODY--}}    
      <div class="card-footer clearfix">      
        {{--$productos->links() --}}
      </div>   
    </div>{{--CARD--}}
  
    @include('livewire.giros.create') 
    @include('livewire.giros.edit')
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
