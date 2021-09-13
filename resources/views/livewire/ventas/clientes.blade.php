<!-- Modal -->
<div wire:ignore.self class="modal fade" id="clienteModal" tabindex="-1" role="dialog" aria-labelledby="clienteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="clienteModalLabel">REGISTRAR NUEVO CLIENTE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row mb-1">
            <div class="col"> 
              <label for="nom_cli">Nombre:</label>             
              <input type="text" wire:model="nom_cli" class="form-control" placeholder="Nombre">
              @error('nom_cli') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="col">
              <label for="doc_cli">NIT/CI:</label>  
              <input type="text"  wire:model="doc_cli" class="form-control">
              @error('doc_cli') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="tel_cli">No. Celular:</label>  
              <input type="text"  wire:model="tel_cli" class="form-control" placeholder="Celular">
              @error('tel_cli') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="col">
              <label for="ciudad_cli">Ciudad:</label>  
              <input type="text"  wire:model="ciudad_cli" class="form-control">
              @error('ciudad_cli') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" wire:click='guardaCliente' class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
</div>