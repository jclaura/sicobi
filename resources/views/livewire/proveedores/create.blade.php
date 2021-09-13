{{-- VENTANA MODAL CREATE PROVEEDOR --}}
<div wire:ignore.self class="modal fade" id="createProveedorModal" tabindex="-1" role="dialog" aria-labelledby="createProveedorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createProveedorModalLabel">REGISTRAR NUEVO PROVEEDOR</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>{{--MODAL-HEADER--}}  
        <div class="modal-body">
          <form>            
            <div class="form-row">
                <div class="col">
                  <label for="emp_prov">Empresa</label>
                  <input type="text" wire:model="emp_prov" class="form-control" id="emp_prov" placeholder="Empresa">
                  @error('emp_prov') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="col">
                  <label for="tel_prov">Teléfono</label>
                  <input type="text" wire:model="tel_prov" class="form-control" id="tel_prov" placeholder="Teléfono">
                  @error('tel_prov') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="dir_prov">Dirección</label>
                <input type="text" wire:model="dir_prov" class="form-control" id="dir_prov" placeholder="Dirección">
                @error('dir_prov') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>
              <div class="col">
                <label for="web_prov">Web</label>
                <input type="text" wire:model="web_prov" class="form-control" id="web_prov" placeholder="Web">
                @error('web_prov') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="email_prov">Email</label>
                <input type="text" wire:model="email_prov" class="form-control" id="email_prov" placeholder="Email">
                @error('email_prov') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>
              <div class="col">
                <label for="pais_prov">País</label>
                <input type="text" wire:model="pais_prov" class="form-control" id="pais_prov" placeholder="País">
                @error('pais_prov') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>                
            </div>
            <div class="form-row">                
              <div class="col">
                <label for="prod_prov">Productos</label>                
                <textarea wire:model="prod_prov" class="form-control" id="prod_prov" rows="3" placeholder="Productos"></textarea>
                @error('prod_prov') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="form-row">{{--FOTO CONTACTO--}}   
              <div class="col">                                          
                <label for="photo">Tarjeta contacto</label>
                <input type="file"  wire:model="photo" name="photo"  id="upload{{ $iteration }}" class="form-control" accept="image/x-png,image/jpeg">                                        
                @error('photo') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>                                                 
            </div>{{--FOTO CONTACTO--}}                       
          </form>  
        </div>{{--MODAL-BODY--}}  
        <div class="modal-footer">                           
          <button type="button" wire:click="store" class="btn btn-primary">Guardar</button>
        </div>{{--MODAL-FOOTER--}}  
      </div>{{--MODAL-CONTENT--}}   
    </div>{{--MODAL-DIALOG--}}  
</div>{{--MODAL CREATE--}} 