<div class="container-fluid"> 
    <div class="card">
      <div class="card-header">
        <h6 class="card-title">DATOS DE CONFIGURACION</h6>                               
      </div>{{--CARD-HEADER--}}    
      <div class="card-body p-0">
        <table class="table table-sm" style="font-size: 12px;">
          <thead class="table-secondary">
            <tr>
              <th>ID</th>             
              <th>NOMBRE DE EMPRESA</th>
              <th>TIPO DE CAMBIO $us</th>              
              <th>UTILIDAD</th>
              <th>IVA</th>              
              <th>IT</th>                
              <th>ACCIONES</th>                
            </tr>
          </thead>
          <tbody>
            @foreach ($empresa as $item)
              <tr>
                <th>{{$item->id}}</th>               
                <td>{{$item->nom_empresa_sys}}</td>  
                <td>{{$item->tipo_cambio_sys}}</td>
                <td>{{$item->utilidad_sys}}%</td>
                <td>{{$item->iva_sys}}%</td>
                <td>{{$item->it_sys}}%</td>
                <td>
                    <button wire:click="edit('{{$item->id}}')" class="bnt btn-primary btn-xs" title="Editar"><i class="fas fa-edit"></i></button>                          
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
    @include('livewire.empresa.edit')  
</div>{{--CONTAINER--}}  
  
@push('scripts'){
  <script src="js/alertas.js"></script> 
  
@endpush
