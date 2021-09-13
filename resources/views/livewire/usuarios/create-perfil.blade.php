<!-- MODAL CREATE createPerfil DEL USUARIO -->
<div wire:ignore.self class="modal fade" id="createPerfilModal" tabindex="-1" role="dialog" aria-labelledby="createPerfilModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createPerfilModalLabel">CREAR PERFIL DEL USUARIO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col">
                    <label for="ci_emp">C.I:</label>
                    <input type="text" wire:model="ci_emp" class="form-control" placeholder="C.I.">
                    @error('ci_emp') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="col">
                    <label for="dir_emp">Dirección:</label>
                    <input type="text" wire:model="dir_emp" class="form-control" placeholder="Dirección">
                    @error('dir_emp') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>{{--ROW1--}}        
            <div class="row">
                <div class="col">
                    <label for="tel_emp">Teléfono:</label>
                    <input type="text" wire:model="tel_emp" class="form-control" placeholder="Teléfono">
                    @error('tel_emp') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="col">
                    <label for="fecha_ing_emp">Fecha de ingreso:</label>                    
                    <input type="date" wire:model="fecha_ing_emp" class="form-control">                    
                </div>
            </div>{{--ROW2--}}  
            <div class="row">
                <div class="col">
                    <label for="sueldo_emp">Haber básico:</label>                    
                    <input type="number" wire:model="sueldo_emp" class="form-control" min="0" max="3000" step="1" placeholder="0">
                    @error('sueldo_emp') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>                
                <div class="col">
                    <label for="tienda_id">Personal de:</label>
                    <select wire:model="tienda_id" class="form-control">                 
                        @foreach ($tiendas as $item)        
                        <option value="{{$item->id}}">{{$item->nom_tienda}}</option>  
                        @endforeach 
                    </select>   
                </div> 
            </div>{{--ROW3--}} 
            <div class="row">
                <div class="col">
                    <label for="photo">Avatar</label>
                    <input type="file"  wire:model="photo" name="photo"  id="upload{{ $iteration }}" class="form-control" accept="image/x-png,image/jpeg">    
                </div>                
            </div>{{--ROW4--}} 
        </div>        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" wire:click="guardarPerfil" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
</div>