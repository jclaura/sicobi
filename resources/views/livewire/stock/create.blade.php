{{-- VENTANA MODAL CREATE STOCK--}}
<div wire:ignore.self class="modal fade" id="createStockModal" tabindex="-1" role="dialog" aria-labelledby="createStockModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createStockModalLabel">REGISTRAR NUEVO ITEM</h5>
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
                <div class="col-sm text-left">                        
                    <div class="form-group">
                        <label for="cod_prod">Codigo:</label>
                        <input type="text" wire:model="cod_prod" class="form-control"> 
                        @error('cod_prod') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>        
                <div class="col-sm text-left">                        
                  <div class="form-group">
                      <label for="desc_prod">Descripcion:</label>
                      <input type="text" wire:model="desc_prod" class="form-control">  
                      @error('desc_prod') <span class="text-danger error">{{ $message }}</span>@enderror                     
                  </div>
                </div>                        
            </div>{{--ROW 1--}}                                         
            <div class="row">{{--MEDIDA, COLOR Y UM--}} 
              <div class="col-sm text-left">                        
                <div class="form-group">
                    <label for="medida_prod">Medida:</label>
                    <input type="text" wire:model="medida_prod" class="form-control">  
                    @error('medida_prod') <span class="text-danger error">{{ $message }}</span>@enderror                      
                </div>
              </div>   
              <div class="col-sm text-left">                        
                  <div class="form-group">
                    <label for="color_prod">Color:</label>
                    <input type="text" wire:model="color_prod" class="form-control">  
                    @error('color_prod') <span class="text-danger error">{{ $message }}</span>@enderror 
                  </div>
              </div>
              <div class="col-sm text-left">                        
                  <div class="form-group">
                      <label for="um_prod">Unidad de Manejo:</label>
                      <select name="select"  wire:model="um_prod" class="form-control">
                        <option value="Tira">Tira</option>
                        <option value="Kilo">Kilo</option>
                        <option value="Gramo">Gramo</option>
                        <option value="Bolsa">Bolsa</option>
                        <option value="Metro">Metro</option>
                        <option value="Rollo">Rollo</option>
                        <option value="Carrete">Carrete</option>
                        <option value="Ciento">Ciento</option>
                        <option value="Unidad">Unidad</option>
                        <option value="Docena">Docena</option> 
                        <option value="Millar">Millar</option> 
                        <option value="Juego">Juego</option>                     
                      </select>                          
                  </div>
              </div>                           
            </div>{{--ROW 2--}}
            <div class="row">{{--PRECIO, ENTRADA Y NOTA--}}  
              <div class="col-sm text-left">                        
                <div class="form-group">
                    <label for="precio_prod">Precio:</label>                   
                    <input type="number" wire:model="precio_prod" min="0" value="0.00" placeholder="0.00" step="0.01" class="form-control floatNumberField" id="InputPrecio">                     
                    @error('precio_prod') <span class="text-danger error">{{ $message }}</span>@enderror 
                </div>
              </div> 
              <div class="col-sm text-left">                        
                  <div class="form-group">
                    <label for="entrada_prod">Entrada:</label>
                    <input type="number" wire:model="entrada_prod" min="0" value="0" placeholder="0" step="1" class="form-control" id="InputEntrada">                     
                    @error('entrada_prod') <span class="text-danger error">{{ $message }}</span>@enderror 
                  </div>
              </div>
              <div class="col-sm text-left">                        
                <div class="form-group">
                  <label for="nota_prod">Nota</label>
                  <textarea wire:model="nota_prod" class="form-control" id="TextareaNota" rows="1"></textarea>
                </div>           
              </div> 
            </div>{{--ROW 3--}}       
            <div class="row">{{--FOTO PRODUCTO--}}   
              <div class="col-sm text-left">                        
                  <div class="form-group">
                    <label for="photo">Foto producto</label>
                    <input type="file"  wire:model="photo" name="photo"  id="upload{{ $iteration }}" class="form-control" accept="image/x-png,image/jpeg">                    
                  </div>
              </div>                                                 
            </div>{{--ROW 4--}}   
          </form> 
        </div>{{--MODAL-BODY--}}  
        <div class="modal-footer">                           
          <button type="button" wire:click="store" class="btn btn-primary">Guardar</button>
        </div>{{--MODAL-FOOTER--}}  
      </div>{{--MODAL-CONTENT--}}   
    </div>{{--MODAL-DIALOG--}}  
</div>{{--MODAL CREATE--}} 