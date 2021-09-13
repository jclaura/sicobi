{{-- VENTANA MODAL CREATE Pago --}}
<div wire:ignore.self class="modal fade" id="createPagoModal" tabindex="-1" role="dialog" aria-labelledby="createPagoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createPagoModalLabel">REGISTRAR NUEVO PAGO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>{{--MODAL-HEADER--}}  
        <div class="modal-body">                   
          <form>           
            <div class="form-row">
              <div class="col">
                <label for="fecha_pago">Fecha</label>
                <input type="date" wire:model="fecha_pago" class="form-control">               
              </div>
              <div class="col">
                <label for="monto_pago">Monto</label>                
                <input type="number" wire:model="monto_pago" min="0" value="0.00" placeholder="0.00" step="0.01" class="form-control floatNumberField">
                @error('monto_pago') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>
            </div>{{--FORM-ROW--}}
            <div class="form-row">
              <div class="col">
                <label for="desc_pago">Descripción</label>
                <input type="text" wire:model="desc_pago" class="form-control" placeholder="Descripción">
                @error('desc_pago') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>
              <div class="col">
                <label for="nota_pago">Nota</label>                                
                <textarea wire:model="nota_pago" class="form-control" rows="1"></textarea>
                @error('nota_pago') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>
            </div>{{--FORM-ROW--}}           
          </form>          
        </div>{{--MODAL-BODY--}}  
        <div class="modal-footer">                           
          <button type="button" wire:click="store" class="btn btn-primary">Guardar</button>
        </div>{{--MODAL-FOOTER--}}  
      </div>{{--MODAL-CONTENT--}}   
    </div>{{--MODAL-DIALOG--}}  
</div>{{--MODAL CREATE--}} 