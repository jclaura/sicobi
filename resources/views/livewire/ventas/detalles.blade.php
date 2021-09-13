{{--VENTANA MODAL PARA MOSTAR DETALLE DE LAS VENTAS--}}
<div wire:ignore.self class="modal fade" id="VentanaDetalleModal" tabindex="-1" role="dialog" aria-labelledby="VentanaDetalleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="VentanaDetalleModalLabel">CLIENTE: {{$cliente_nombre}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <table class="table table-bordered table-sm" style="font-size: 12px;">
        <thead class="table-active">
            <tr>                
            <th>CANTIDAD</th>
            <th>UNIDAD</th>
            <th>PRODUCTO</th>
            <th>PRECIO</th>
            <th>SUBTOTAL</th>                                              
            
            </tr>
        </thead>
        <tbody>
            <?php 
            $totalVenta=0;
            ?>
            @foreach($detalles as $item)                  
            <tr>                                                  
                <td scope="row">{{$item->cant_det}}</td>   
                <td scope="row">{{$item->um_det}}</td>  
                <td scope="row">{{$item->desc_det}}</td> 
                <td scope="row">{{$item->precio_det}}</td>
                @php
                $subtotal = $item->cant_det*$item->precio_det;  
                $totalVenta+=$subtotal;
                $subtotal = number_format($subtotal, 2, '.', '');                                
                $totalVenta = number_format($totalVenta, 2, '.', ''); 
                @endphp 
                <td scope="row">{{$subtotal}}</td>                                                                    
            </tr> 
            @endforeach
            <tr class="table-active">
            <td></td>
            <td></td>        
            <td></td> 
            <td><strong>TOTAL</strong></td>
            <td><strong>{{$totalVenta}}</strong></td>                          
            </tr>                           
        </tbody>
        </table>
    </div>
    <div class="modal-footer">
        @if ($totalVenta > 0)        
            <button type="button" wire:click="imprimeRecibo('{{$item->venta_id}}')" class="btn btn-primary">Imprimir</button>      
        @endif        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>          
    </div>
    </div>
</div>
</div>