<!-- Modal -->
<div wire:ignore.self  class="modal fade" id="createUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="createUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createUsuarioModalLabel">CREAR NUEVO USUARIO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">   
          <div class="row">
            <div class="col">
              <label for="name">Nombre:</label>             
              <input type="text" wire:model="name" placeholder="Nombre" class="form-control">
              @error('name') <span class="text-danger error">{{ $message }}</span>@enderror 
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="email">Email:</label>             
              <input type="email" wire:model="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Email"  class="form-control">   
              @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="password">Password:</label>             
              <input type="password" wire:model="password" placeholder="Password"  class="form-control">
              @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="name">Rol:</label>                                
              <select wire:model="rol" class="form-control">                 
                  @foreach ($roles as $item)        
                    <option value="{{$item->name}}">{{$item->name}}</option>  
                  @endforeach 
              </select> 
            </div>
          </div>                                        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" wire:click="registrar" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>




  