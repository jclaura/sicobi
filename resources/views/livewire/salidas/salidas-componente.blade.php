<div class="container-fluid"> 
    <div class="card">
      <div class="card-header">
        <h6 class="card-title">SALIDA DE PRODUCTOS</h6>                               
      </div>{{--CARD-HEADER--}}    
      <div class="card-body p-0">
        <table class="table table-sm" style="font-size: 12px;">
          <thead class="table-secondary">
            <tr>              
              <th>TIENDA</th>         
              <th>FECHA</th>
              <th>CÓDIGO</th>              
              <th>DESCRIPCIÓN</th>
              <th>CANTIDAD</th>              
              <th>PRECIO SALIDA</th>                
              <th>PRECIO VENTA</th> 
            </tr>
          </thead>
          <tbody>
            @foreach ($salida as $item)
              <tr>
                <td>{{$item->tienda->nom_tienda}}</td>                              
                <td>{{$item->fecha_sal}}</td>  
                <td>{{$item->codprod_sal}}</td>                                  
                <td>{{$item->stock->desc_prod}}</td>
                <td>{{$item->cantprod_sal}}</td>
                <td>{{$item->precio_sal}}</td>                
                <td>{{$item->precio_ven}}</td>                
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
