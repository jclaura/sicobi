<div wire:ignore.self class="modal fade" id="editEmpresaModal" tabindex="-1" role="dialog" aria-labelledby="editEmpresaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editEmpresaModalLabel">EDITAR DATOS DE SISTEMA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <label for="nom_empresa_sys">Nombre:</label>             
              <input type="text" wire:model="nom_empresa_sys" class="form-control">
              @error('nom_empresa_sys') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="desc_empresa_sys">Descripción:</label>             
              <input type="text" wire:model="desc_empresa_sys" class="form-control">
              @error('desc_empresa_sys') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="tipo_cambio_sys">Tipo:</label>             
              <input type="number" wire:model="tipo_cambio_sys" class="form-control">
              @error('tipo_cambio_sys') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="col">
              <label for="utilidad_sys">Utilidad:</label>             
              <input type="number" wire:model="utilidad_sys" class="form-control">
              @error('utilidad_sys') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="col">
              <label for="iva_sys">IVA:</label>             
              <input type="number" wire:model="iva_sys" class="form-control">
              @error('iva_sys') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="col">
              <label for="it_sys">IT:</label>             
              <input type="number" wire:model="it_sys" class="form-control">
              @error('it_sys') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" wire:click="update" class="btn btn-primary">Guardar cambios</button>
        </div>
      </div>
    </div>
</div>