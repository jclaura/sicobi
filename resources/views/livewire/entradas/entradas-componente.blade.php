
<div class="container-fluid"> 
    <div class="card">
      <div class="card-header">
        <h6 class="card-title">ENTRADAS A STOCK</h6>                               
      </div>{{--CARD-HEADER--}}    
      <div class="card-body p-0">
        <table class="table table-sm" style="font-size: 12px;">
          <thead class="table-secondary">
            <tr>
              <th>ID</th>             
              <th>FECHA</th>
              <th>CÓDIGO</th>              
              <th>DESCRIPCIÓN</th>
              <th>CANTIDAD</th>              
              <th>PRECIO</th>                
            </tr>
          </thead>
          <tbody>
            @foreach ($entradas as $item)
              <tr>
                <th>{{$item->id}}</th>               
                <td>{{$item->fecha_ent}}</td>  
                <td>{{$item->codprod_ent}}</td>                                  
                <td>{{$item->producto->desc_prod}}</td>
                <td>{{$item->cantprod_ent}}</td>
                <td>{{$item->precio_ent}}</td>                
              </tr>   
            @endforeach                                       
          </tbody>
        </table>    
      </div>{{--CARD-BODY--}}     
      <div class="card-footer clearfix">      
        {{--$proveedor->links()--}} 
      </div>   
    </div>{{--CARD--}}    
</div>{{--CONTAINER--}}  
  
@push('scripts'){
  <script src="js/alertas.js"></script> 
  
@endpush