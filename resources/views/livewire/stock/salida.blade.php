{{-- VENTANA MODAL SALIDA DE PRODUCTO--}}
<div wire:ignore.self class="modal fade" id="salidaStockModal" tabindex="-1" role="dialog" aria-labelledby="salidaStockModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="salidaStockModalLabel">SALIDA DE PRODUCTO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>{{--MODAL-HEADER--}}  
        <div class="modal-body">  
          <form>{{--FORMULARIO DE REGISTRO DE NUEVO STOCK--}}   
            <div class="row">  
              <div class="col-sm text-left">                     
                <div class="form-group">
                  <label for="deposito_id">Salida:</label>
                  <select wire:model="tienda_id" class="form-control">                 
                    @foreach ($tiendas as $item)        
                      <option value="{{$item->id}}">{{$item->nom_tienda}}</option>  
                    @endforeach 
                  </select>                                                                                                                                                                                                            
                </div>                     
              </div>                                                              
            </div>{{--ROW 1--}} 
            <div class="row">
              <div class="col">
                <label for="stock_disponible">Stock disponible:</label>                    
                <input type="number" wire:model="stock_disponible" min="0" value="0" placeholder="0" step="1" class="form-control" disabled>                  
              </div>
              <div class="col">
                <label for="cantidad_salida">Cantidad de salida:</label>                    
                <input type="number" wire:model="cantidad_salida" min="0" value="0" placeholder="0" step="1" class="form-control">  
              </div>
            </div>{{--ROW--}}                                                                     
            <div class="row">
              <div class="col">
                <label for="precio_deposito">Precio depósito:</label>                    
                <input type="number" wire:model="precio_deposito" min="0" value="0" placeholder="0" step="1" class="form-control" disabled>    
              </div>
              <div class="col">
                <label for="impuestos">Impuestos: IVA:({{$iva}}%) IT:({{$it}}%):</label>                    
                <input type="number" wire:model="impuestos" min="0" value="0" placeholder="0" step="1" class="form-control" disabled>    
              </div>
            </div>{{--ROW--}}  
            <div class="row">              
              <div class="col">
                <label for="precio_tienda">Precio de salida:</label>                    
                <input type="number" wire:model="precio_tienda" min="0" value="0" placeholder="0" step="1" class="form-control floatNumberField">    
              </div>
            </div>{{--ROW--}} 
          </form> 
        </div>{{--MODAL-BODY--}}   
        <div class="modal-footer">                           
          <button type="button" wire:click="salidaConfirmada" class="btn btn-primary">Guardar</button>
        </div>{{--MODAL-FOOTER--}}  
      </div>{{--MODAL-CONTENT--}}   
    </div>{{--MODAL-DIALOG--}}  
</div>{{--MODAL SALIDA--}} 