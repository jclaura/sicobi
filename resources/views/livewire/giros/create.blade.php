{{-- VENTANA MODAL CREATE Giro --}}
<div wire:ignore.self class="modal fade" id="createGiroModal" tabindex="-1" role="dialog" aria-labelledby="createGiroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createGiroModalLabel">REGISTRAR NUEVO GIRO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>{{--MODAL-HEADER--}}  
        <div class="modal-body">                   
          <form>           
            <div class="form-row">    
              <div class="col">
                <label for="fecha_giro">Fecha</label>
                <input type="date" wire:model="fecha_giro" class="form-control">               
              </div>           
              <div class="col">
                <label for="monto_giro">Monto</label>                
                <input type="number" wire:model="monto_giro" min="0" value="0.00" placeholder="0.00" step="0.01" class="form-control floatNumberField">
                @error('monto_giro') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>              
              <div class="col">
                <label for="tipo_giro">Tipo</label>                
                <select wire:model="tipo_giro" class="form-control">
                  <option value="0">% (porciento)</option>
                  <option value="1">$ (fijo)</option>              
                </select>    
              </div>              
            </div>{{--FORM-ROW--}}            
            <div class="form-row"> 
              <div class="col">
                <label for="comision_giro">Comision</label>                
                <input type="number" wire:model="comision_giro" min="0" value="2.05" placeholder="2.05" step="0.01" class="form-control floatNumberField">
                @error('comision_giro') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>  
              <div class="col">
                <label for="docs_giro">Papeleo</label>                
                <input type="number" wire:model="docs_giro" min="0" value="0.00" placeholder="0.00" step="0.01" class="form-control floatNumberField">
                @error('docs_giro') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>        
              <div class="col">
                <label for="itf_giro">ITF</label>                
                <input type="number" wire:model="itf_giro" min="0" value="0.30" placeholder="0.30" step="0.01" class="form-control floatNumberField">
                @error('itf_giro') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>
              <div class="col">
                <label for="extravio_giro">Extravio</label>                
                <input type="number" wire:model="extravio_giro" min="0" value="0.00" placeholder="0.00" step="0.01" class="form-control floatNumberField">
                @error('extravio_giro') <span class="text-danger error">{{ $message }}</span>@enderror
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