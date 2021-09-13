{{-- VENTANA MODAL EDIT TIENDA--}}
<div wire:ignore.self class="modal fade" id="editTiendaModal" tabindex="-1" role="dialog" aria-labelledby="editTiendaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editTiendaModalLabel">MODIFICAR DATOS DE TIENDA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>{{--MODAL-HEADER--}}  
        <div class="modal-body">
          <form>            
            <div class="form-row">
                <div class="col">
                  <label for="nom_tienda">Nombre</label>
                  <input type="text" wire:model="nom_tienda" class="form-control" placeholder="Nombre">
                  @error('nom_tienda') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="col">
                  <label for="dir_tienda">Dirección</label>
                  <input type="text" wire:model="dir_tienda" class="form-control" placeholder="Dirección">
                  @error('dir_tienda') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="fecha_ini_tienda">Fecha de apertura</label>
                    <input type="date" wire:model="fecha_ini_tienda" class="form-control">               
                </div>                              
            </div>                                    
          </form>  
        </div>{{--MODAL-BODY--}}  
        <div class="modal-footer">                           
          <button type="button" wire:click="update" class="btn btn-primary">Actualizar</button>
        </div>{{--MODAL-FOOTER--}}  
      </div>{{--MODAL-CONTENT--}}   
    </div>{{--MODAL-DIALOG--}}  
</div>{{--MODAL edit--}} 