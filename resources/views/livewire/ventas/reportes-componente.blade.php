<div class="container-fluid"> 
    @if ($activo_caja)  
    {{--********************************************************************
    *********           FILA VENTA DE PRODUCTOS         ********************
    *********************************************************************--}}
        <div class="row">
            <div class="col-12">
                <div class="card">        
                <div class="card-header">                   
                    <h6 class="card-title"><strong>REPORTE VENTAS: {{$tienda_nombre}} - APERTURA CAJA FECHA: {{$fecha_apertura_caja}} - HORA: {{$hora_apertura_caja}}</strong></h6>                                                
                </div>{{--CARD-HEADER--}}  
                <div class="card-body">                     
                    <div class="row">{{--ROW TABLA VENTA DE PRODUCTOS--}}
                    <div class="col-12">
                        <table id="productos" class="table table-bordered table-sm" style="font-size: 12px;">  
                            <thead class="thead-dark">
                            <tr>                                  
                                <th scope="col">CLIENTE</th>
                                <th scope="col">FECHA</th>
                                <th scope="col">DOCUMENTO</th>
                                <th scope="col">TOTAL</th>
                                <th scope="col">DESCUENTO</th>
                                <th scope="col">HORA</th>
                                <th scope="col">PAGO</th>                                    
                                <th scope="col">ACCIONES</th> 
                            </tr>
                            </thead>              
                            <tbody>
                                @foreach ($ventas as $item)         
                                <tr>                                            
                                    <td>{{$item->cliente->nom_cli}}</td>               
                                    <td>{{$item->fecha_ven}}</td>  
                                    <td>{{$item->doc_ven}}</td>               
                                    <td>{{$item->total_ven}}</td>  
                                    <td>{{$item->rebaja_ven}}</td>  
                                    <td>{{$item->hora_ven}}</td> 
                                    @if ($item->tipo_pago_ven==1)
                                    <td>Efectivo</td>  
                                    @elseif ($item->tipo_pago_ven==2)
                                    <td>Trasferencia bancaria</td> 
                                    @elseif ($item->tipo_pago_ven==3)
                                    <td>Tarjeta</td>  
                                    @endif                                                                 
                                    <td>
                                    <button wire:click="verDetalle('{{$item->id}}')" class="bnt btn-info btn-sm" data-toggle="modal" data-target="#VentanaDetalleModal" title="Ver detalle"><i class="far fa-plus-square"></i> Ver detalle</button>                                                                                                 
                                    </td>
                                </tr>                                                             
                                @endforeach               
                            </tbody>
                        </table>    
                    </div>{{--FIN COL TABLA VENTA DE PRODUCTOS--}}
                    </div>{{-- FIN ROW TABLA VENTA DE PRODUCTOS--}} 
                </div>{{--CARD-BODY--}}  
                <div class="card-footer">
                    {{--$stock->links()--}}
                </div>{{--CARD-BODY--}}  
                </div>{{--CARD--}}  
            </div>{{--COL-12--}}
        </div>{{--FIN FILA VENTA DE PRODUCTOS--}}    
    @else
        <div class="row bg-black text-center">
        <div class="col-12 mt-2 mb-2">                     
            <strong>CAJA CERRADA</strong>       
        </div>
        </div>  
    @endif
    @include('livewire.ventas.detalles') 
</div>{{--CONTAINER--}}  