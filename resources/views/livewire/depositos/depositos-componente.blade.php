<div class="container-fluid"> 
    <div class="card">
      <div class="card-header">
        <h6 class="card-title">DEPOSITOS</h6>       
        <div class="card-tools">
          <button type="button" wire:click="resetVar" class="btn btn-success btn-xs" data-toggle="modal" data-target="#createDepositoModal"><i class="fas fa-plus"></i> Nuevo</button>
        </div>                  
      </div>{{--CARD-HEADER--}}    
      <div class="card-body p-0">
        <table class="table table-sm" style="font-size: 12px;">
          <thead class="table-secondary">
            <tr>
              <th>ID</th>
              <th>NOMBRE</th>
              <th>DIRECCION</th>
              <th>SUPERVISOR</th>              
              <th>ACCIONES</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($depositos as $item)
              <tr>
                <th>{{$item->id}}</th>
                <td>{{$item->nom_dep}}</td>
                <td>{{$item->dir_dep}}</td>  
                <td>{{$item->supervisor_dep}}</td>                  
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
        {{--$proveedor->links()--}} 
      </div>   
    </div>{{--CARD--}}
  
    @include('livewire.depositos.create') 
    @include('livewire.depositos.edit')
  </div>{{--CONTAINER--}}  
  
  @push('scripts'){
    <script src="js/alertas.js"></script> 
    
  @endpush
