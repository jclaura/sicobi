<div class="container-fluid"> 
    <div class="card">
      <div class="card-header">
        <h6 class="card-title">CLASIFICACIÓN DE PRODUCTOS</h6>       
        <div class="card-tools">
          <button type="button" wire:click="resetVar" class="btn btn-success btn-xs" data-toggle="modal" data-target="#createGrupoModal"><i class="fas fa-plus"></i> Nuevo</button>
        </div>                  
      </div>{{--CARD-HEADER--}}    
      <div class="card-body p-0">    
        <table class="table table-sm" style="font-size: 12px;">
          <thead class="table-secondary">
            <tr>
              <th>ID</th>
              <th>DEPOSITO</th>
              <th>ESTANTE</th>
              <th>FILA</th>
              <th>GRUPO</th>              
              <th>CODIGO</th>
              <th>INVENTARIADO</th>
              <th>ETIQUETA</th>              
              <th>NOTA</th>              
              <th>ACCIONES</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($grupos as $item)
              <tr>
                <td>{{$item->id}}</td>                
                {{--<td>{{$item->find($item->deposito_id)->deposito->nom_dep}}</td>--}}                  
                <td>{{$item->deposito_id}}</td>
                <td>{{$item->estante_gru}}</td>
                <td>{{$item->fila_estante_gru}}</td>  
                <td>{{$item->tipo_prod_gru}}</td>                  
                <td>{{$item->codprod_gru}}</td> 
                <td>{{$item->rotulo_gru}}</td> 
                <td>{{$item->etiqueta_gru}}</td> 
                <td>{{$item->nota_gru}}</td> 
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
        {{$grupos->links()}} 
      </div>   
    </div>{{--CARD--}}
  
    @include('livewire.grupos.create') 
    @include('livewire.grupos.edit')
  </div>{{--CONTAINER--}}  
  
  @push('scripts'){
    <script src="js/alertas.js"></script> 
    
  @endpush