{{-- VENTANA MODAL CREATE GRUPO--}}
<div wire:ignore.self class="modal fade" id="createGrupoModal" tabindex="-1" role="dialog" aria-labelledby="createGrupoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createGrupoModalLabel">REGISTRAR CLASIFICACIÓN DE PRODUCTOS</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>{{--MODAL-HEADER--}}  
        <div class="modal-body">
          <form>            
            <div class="form-row">
                <div class="col">
                    <label for="deposito_id">Depositos: </label>        
                    <select wire:model="deposito_id">                 
                      @foreach ($depositos as $item)        
                        <option value="{{$item->id}}">{{$item->nom_dep}}</option>  
                      @endforeach 
                    </select>
                </div>
                <div class="col">
                    <label for="estante_gru">Estante</label>                    
                    <input type="number" wire:model="estante_gru" min="0" value="0" placeholder="0" step="1" class="form-control">                                                                 
                    @error('estante_gru') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="col">
                    <label for="fila_estante_gru">Fila</label>                    
                    <input type="number" wire:model="fila_estante_gru" min="0" value="0" placeholder="0" step="1" class="form-control">                                                                 
                    @error('fila_estante_gru') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>                               
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="tipo_prod_gru">Clase</label>
                    <select name="select"  wire:model="tipo_prod_gru" class="form-control">
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C">C</option>                      
                    </select>
                </div>   
              <div class="col">
                <label for="codprod_gru">Código producto</label>
                <input type="text" wire:model="codprod_gru" class="form-control" placeholder="Código">
                @error('codprod_gru') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>              
              <div class="col">
                <label for="etiqueta_gru">Etiqueta</label>
                <input type="text" wire:model="etiqueta_gru" class="form-control" placeholder="Etiqueta">
                @error('etiqueta_gru') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>               
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="nota_gru">Nota</label>
                    <input type="text" wire:model="nota_gru" class="form-control" placeholder="Nota">
                    @error('nota_gru') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>              
            </div>   
            <div class="form-row">{{--INVENTARIADO--}}   
                <div class="col mt-2">                                          
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" wire:model="rotulo_gru">
                    <label class="form-check-label" for="rotulo_gru">
                      Inventariado
                    </label>
                  </div>
                </div>                                                 
            </div>{{--INVENTARIADO--}}                                  
          </form>  
        </div>{{--MODAL-BODY--}}  
        <div class="modal-footer">                           
          <button type="button" wire:click="store" class="btn btn-primary">Guardar</button>
        </div>{{--MODAL-FOOTER--}}  
      </div>{{--MODAL-CONTENT--}}   
    </div>{{--MODAL-DIALOG--}}  
</div>{{--MODAL CREATE--}} 