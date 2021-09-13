{{-- VENTANA MODAL EDIT Compra --}}
<div wire:ignore.self class="modal fade" id="editCompraModal" tabindex="-1" role="dialog" aria-labelledby="editCompraModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editCompraModalLabel">ACTUALIZAR REGISTRO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>{{--MODAL-HEADER--}}  
        <div class="modal-body">                   
          <form>           
            <div class="form-row">
              <div class="col">
                <label for="fecha_com">Fecha</label>
                <input type="date" wire:model="fecha_com" class="form-control">               
              </div>
              <div class="col">
                <label for="items_com">Items</label>                
                <input type="number" wire:model="items_com" min="0" value="0" placeholder="0" step="1" class="form-control">
                @error('items_com') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>
              <div class="col">
                <label for="tipo_com">Tipo de cambio</label>                
                <input type="number" wire:model="tipo_com" min="0" value="0.00" placeholder="0.00" step="0.01" class="form-control floatNumberField">
                @error('tipo_com') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>
            </div>{{--FORM-ROW--}}
            <div class="form-row">
              <div class="col">
                <label for="moneda_com">Moneda</label>
                <input type="text" wire:model="moneda_com" class="form-control" placeholder="Moneda">
                @error('moneda_com') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>
              <div class="col">
                <label for="pais_com">País</label>   
                <input type="text" wire:model="pais_com" class="form-control" placeholder="País">                                             
                @error('pais_com') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>
            </div>{{--FORM-ROW--}}           
            <div class="form-row">                
                <div class="col">
                  <label for="comprador_com">Comprador</label>   
                  <input type="text" wire:model="comprador_com" class="form-control" placeholder="Comprador">                                             
                  @error('comprador_com') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
              </div>{{--FORM-ROW--}} 
          </form>          
        </div>{{--MODAL-BODY--}}  
        <div class="modal-footer">                           
          <button type="button" wire:click="update" class="btn btn-primary">Actualizar</button>
        </div>{{--MODAL-FOOTER--}}  
      </div>{{--MODAL-CONTENT--}}   
    </div>{{--MODAL-DIALOG--}}  
</div>{{--MODAL edit--}} 