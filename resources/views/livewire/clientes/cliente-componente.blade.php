<div class="container-fluid"> 
    <div class="card">
      <div class="card-header">
        <h6 class="card-title">LISTADO DE CLIENTES</h6>       
        <div class="card-tools">
          <button type="button" wire:click="resetVar" class="btn btn-success btn-xs" data-toggle="modal" data-target="#createClienteModal"><i class="fas fa-plus"></i> Nuevo</button>
        </div>                  
      </div>{{--CARD-HEADER--}}    
      <div class="card-body p-0">
        <table class="table table-sm" style="font-size: 12px;">
          <thead class="table-secondary">
            <tr>
              <th>ID</th>
              <th>NOMBRE</th>
              <th>DOCUMENTO</th>
              <th>TELEFONO</th>              
              <th>CIUDAD</th>
              <th>PREFERENCIAS</th>              
              <th>ACCIONES</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($clientes as $item)
              <tr>
                <th>{{$item->id}}</th>
                <th>{{$item->nom_cli}}</th>
                <td>{{$item->doc_cli}}</td>
                <td>{{$item->tel_cli}}</td>  
                <td>{{$item->ciudad_cli}}</td>                  
                <th>{{$item->pref_cli}}</th>
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
        {{$clientes->links()}} 
      </div>   
    </div>{{--CARD--}}
  
    @include('livewire.clientes.create') 
    @include('livewire.clientes.edit')
  </div>{{--CONTAINER--}}  
  
  @push('scripts'){
    <script src="js/alertas.js"></script> 
    
  @endpush

