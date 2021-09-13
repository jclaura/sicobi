<div class="container-fluid"> 
    <div class="card">
      <div class="card-header">
        <h6 class="card-title">USUARIOS</h6>       
        <div class="card-tools">
          <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#createUsuarioModal"><i class="fas fa-plus"></i> Nuevo</button>          
        </div>                      
      </div>{{--CARD-HEADER--}}    
      <div class="card-body p-0">
        <table class="table table-sm" style="font-size: 12px;">
          <thead class="table-secondary">
            <tr>
              <th>ID</th>
              <th>NOMBRE</th>
              <th>EMAIL</th>
              <th>ROL</th>              
              <th>ACCIONES</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($usuarios as $item)
              <tr>
                <th>{{$item->id}}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>  
                <td>{{$item->rol}}</td>                                
                <td>
                  @if ($item->id == 1)
                    <button class="bnt btn-secondary btn-xs" disabled><i class="fas fa-trash-alt"></i></button>  
                  @else
                    <button wire:click="$emit('borrarReg', {{$item->id}})" class="bnt btn-danger btn-xs" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                  @endif                                                                               
                  @if (\App\Models\Empleado::where(['user_id' => $item->id])->get()->first())
                    <button wire:click="verPerfil('{{$item->id}}')" class="bnt btn-success btn-xs">Ver perfil</button>                  
                  @else
                    <button wire:click="crearPerfil('{{$item->id}}')" class="bnt btn-success btn-xs">Crear perfil</button>                  
                  @endif                  
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
   
    @include('livewire.usuarios.create')
    @include('livewire.usuarios.create-perfil')
    @include('livewire.usuarios.show-perfil')
  </div>{{--CONTAINER--}}  
  
  @push('scripts'){
    <script src="js/alertas.js"></script> 
    
  @endpush