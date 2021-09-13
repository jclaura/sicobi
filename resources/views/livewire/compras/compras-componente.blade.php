<div class="container-fluid"> 
  <div class="card">
    <div class="card-header">
      <h6 class="card-title">COMPRA DE PRODUCTOS</h6>       
      <div class="card-tools">
        <button type="button" wire:click="resetVar" class="btn btn-success btn-xs" data-toggle="modal" data-target="#createCompraModal"><i class="fas fa-plus"></i> Nuevo</button>
      </div>                  
    </div>{{--CARD-HEADER--}}    
    <div class="card-body p-0">
      <table class="table table-sm" style="font-size: 12px;">
        <thead class="table-secondary">
          <tr>
            <th>ID</th>
            <th>FECHA</th>
            <th>ITEMS</th>
            <th>TIPO</th>
            <th>MONEDA</th>
            <th>PAIS</th>
            <th>COMPRADOR</th>
            <th>PAGOS</th>
            <th>GIROS</th>
            <th>ACCIONES</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($compras as $item)
            <tr>
              <th>{{$item->id}}</th>
              <td>{{$item->fecha_com}}</td>
              <td>{{$item->items_com}}</td>  
              <td>{{$item->tipo_com}}</td>  
              <td>{{$item->moneda_com}}</td>
              <td>{{$item->pais_com}}</td>  
              <td>{{$item->comprador_com}}</td>
              @if ($item->pagos_com)
                <td class="text-center text-success"><i class="fas fa-check"></i></td>  
              @else
                <td class="text-center text-danger"><i class="fas fa-times"></i></td>  
              @endif               
              @if ($item->giros_com)
                <td class="text-center text-success"><i class="fas fa-check"></i></td>  
              @else
                <td class="text-center text-danger"><i class="fas fa-times"></i></td>  
              @endif              
              @if ($item->pagos_com AND $item->giros_com)
                <td>                         
                  <button wire:click.prevent="edit('{{$item->id}}')" class="bnt btn-secondary btn-xs" title="Editar" disabled><i class="fas fa-edit"></i></button>                          
                  <button wire:click="$emit('borrarReg', {{$item->id}})" class="bnt btn-secondary btn-xs" title="Eliminar" disabled><i class="fas fa-trash-alt"></i></button>
                </td>
              @else
                <td>                         
                  <button wire:click.prevent="edit('{{$item->id}}')" class="bnt btn-info btn-xs" title="Editar"><i class="fas fa-edit"></i></button>                          
                  <button wire:click="$emit('borrarReg', {{$item->id}})" class="bnt btn-danger btn-xs" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                </td>
              @endif  
            </tr>   
          @endforeach                                        
        </tbody>
      </table>    
    </div>{{--CARD-BODY--}}    
    <div class="card-footer clearfix">      
      {{ $compras->links() }}
    </div>   
  </div>{{--CARD--}}

  @include('livewire.compras.create') 
  @include('livewire.compras.edit')
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

