{{-- VENTANA MODAL CREATE CATEGORIA --}}
<div wire:ignore.self class="modal fade" id="createCategoriaModal" tabindex="-1" role="dialog" aria-labelledby="createCategoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createCategoriaModalLabel">REGISTRAR NUEVA CATEGORIA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>{{--MODAL-HEADER--}}  
        <div class="modal-body">
          <form>
            <div class="card-body">
              <div class="form-row">
                  <div class="col">
                    <label for="cat_desc">Descripción</label>
                    <input type="text" wire:model="cat_desc" class="form-control" id="cat_desc" placeholder="Descripción">
                    @error('cat_desc') <span class="text-danger error">{{ $message }}</span>@enderror
                  </div>
                  <div class="col">
                    <label for="cat_cod">Código</label>
                    <input type="text" wire:model="cat_cod" class="form-control" id="cat_cod" placeholder="Código">
                    @error('cat_cod') <span class="text-danger error">{{ $message }}</span>@enderror
                  </div>
              </div>
            </div>
            <!-- /.card-body -->            
          </form>  
        </div>{{--MODAL-BODY--}}  
        <div class="modal-footer">                           
          <button type="button" wire:click="store" class="btn btn-primary">Guardar</button>
        </div>{{--MODAL-FOOTER--}}  
      </div>{{--MODAL-CONTENT--}}   
    </div>{{--MODAL-DIALOG--}}  
</div>{{--MODAL CREATE--}} 