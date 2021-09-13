{{-- VENTANA MODAL CREATE DEPOSITO--}}
<div wire:ignore.self class="modal fade" id="createDepositoModal" tabindex="-1" role="dialog" aria-labelledby="createDepositoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createDepositoModalLabel">REGISTRAR NUEVO DEPÓSITO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>{{--MODAL-HEADER--}}  
        <div class="modal-body">
          <form>            
            <div class="form-row">
                <div class="col">
                  <label for="nom_dep">Nombre</label>
                  <input type="text" wire:model="nom_dep" class="form-control" placeholder="Nombre">
                  @error('nom_dep') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="col">
                  <label for="dir_dep">Dirección</label>
                  <input type="text" wire:model="dir_dep" class="form-control" placeholder="Dirección">
                  @error('dir_dep') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="supervisor_dep">Supervisor</label>
                <input type="text" wire:model="supervisor_dep" class="form-control" placeholder="Supervisor">
                @error('supervisor_dep') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>              
            </div>                                    
          </form>  
        </div>{{--MODAL-BODY--}}  
        <div class="modal-footer">                           
          <button type="button" wire:click="store" class="btn btn-primary">Guardar</button>
        </div>{{--MODAL-FOOTER--}}  
      </div>{{--MODAL-CONTENT--}}   
    </div>{{--MODAL-DIALOG--}}  
</div>{{--MODAL CREATE--}} 