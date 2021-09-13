{{-- VENTANA MODAL edit STOCK--}}
<div wire:ignore.self class="modal fade" id="editStockModal" tabindex="-1" role="dialog" aria-labelledby="editStockModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editStockModalLabel">ASIGNAR DEPOSITO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>{{--MODAL-HEADER--}}  
        <div class="modal-body">  
          <form>{{--FORMULARIO DE REGISTRO DE NUEVO STOCK--}}   
            <div class="row">  
                <div class="col-sm text-left">                     
                    <div class="form-group">
                      <label for="deposito_id">Depósito:</label>
                      <select wire:model="deposito_id" class="form-control">                 
                        @foreach ($depositos as $item)        
                          <option value="{{$item->id}}">{{$item->nom_dep}}</option>  
                        @endforeach 
                      </select>                                           
                    </div>
                </div>                                                              
            </div>{{--ROW 1--}}                                                                      
          </form> 
        </div>{{--MODAL-BODY--}}   
        <div class="modal-footer">                           
          <button type="button" wire:click="update" class="btn btn-primary">Asignar</button>
        </div>{{--MODAL-FOOTER--}}  
      </div>{{--MODAL-CONTENT--}}   
    </div>{{--MODAL-DIALOG--}}  
</div>{{--MODAL edit--}} 