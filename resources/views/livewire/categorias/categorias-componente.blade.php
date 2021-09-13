<div class="container-fluid"> 
  <div class="card">
    <div class="card-header">
      <h6 class="card-title">CATEGORIA DE PRODUCTOS</h6>       
      <div class="card-tools">
        <button type="button" wire:click="resetVar" class="btn btn-success btn-xs" data-toggle="modal" data-target="#createCategoriaModal"><i class="fas fa-plus"></i> Nuevo</button>
      </div>                  
    </div>{{--CARD-HEADER--}}    
    <div class="card-body p-0">
      <table class="table table-sm" style="font-size: 12px;">
        <thead class="table-secondary">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">DESCRIPCION</th>
            <th scope="col">CODIGO</th>
            <th scope="col">ACCIONES</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categorias as $item)
            <tr>
              <th scope="row">{{$item->id}}</th>
              <td>{{$item->cat_desc}}</td>
              <td>{{$item->cat_cod}}</td>  
              <td>                         
                <button wire:click.prevent="edit('{{$item->id}}')" class="bnt btn-info btn-xs" title="Editar"><i class="fas fa-edit"></i></button>                          
                <button wire:click="$emit('borrarReg', {{$item->id}})" class="bnt btn-danger btn-xs" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
              </td>
            </tr>   
          @endforeach                                        
        </tbody>
      </table>    
    </div>{{--CARD-BODY--}}    
    <div class="card-footer clearfix">      
      {{ $categorias->links() }}
    </div>   
  </div>{{--CARD--}}

  @include('livewire.categorias.create') 
  @include('livewire.categorias.edit')
</div>{{--CONTAINER--}}  

@push('scripts'){
  <script src="js/alertas.js"></script> 
@endpush

