{{-- VENTANA MODAL CREATE Producto --}}
<div wire:ignore.self class="modal fade" id="createProductoModal" tabindex="-1" role="dialog" aria-labelledby="createProductoModalLabel" aria-hidden="true">
    {{--modal_lg VENTANA MODAL MAS ANCHO--}}
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createProductoModalLabel">REGISTRAR NUEVO PRODUCTO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>{{--MODAL-HEADER--}}  
        <div class="modal-body">
          <form>
            <div class="card-body">
              <div class="form-row">
                  <div class="col">
                    <label for="categoria_id">Categorías</label>

                    {{--ME QUEDE AQUI, ARREGLAR--}}                    
                    <select wire:model="categoria_id" wire:change="codProdIni" class="form-control">                 
                      @foreach ($categorias as $item)        
                        <option value="{{$item->id}}">{{$item->cat_desc}}</option>  
                      @endforeach 
                    </select> 
                  </div> 
                  <div class="col">
                    <label for="cod_prod">Código</label>
                    <input type="text" wire:model="cod_prod" wire:keydown.enter="recuperaRegistro" class="form-control" placeholder="Código">
                    @error('cod_prod') <span class="text-danger error">{{ $message }}</span>@enderror
                  </div>
                  <div class="col">
                    <label for="desc_prod">Descripción</label>
                    <input type="text" wire:model="desc_prod" class="form-control" id="desc_prod" placeholder="Descripción">
                    @error('desc_prod') <span class="text-danger error">{{ $message }}</span>@enderror
                  </div>
                  <div class="col">
                    <label for="cant_prod">Cantidad</label>                    
                    <input type="number" wire:model="cant_prod" min="0" value="0" placeholder="0" step="1" class="form-control">                                                                 
                    @error('cant_prod') <span class="text-danger error">{{ $message }}</span>@enderror
                  </div>                  
              </div>
              <div class="form-row">
                <div class="col">
                  <label for="medida_prod">Medida</label>
                  <input type="text" wire:model="medida_prod" class="form-control" placeholder="Medida">
                  @error('medida_prod') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="col">
                  <label for="color_prod">Color</label>
                  <input type="text" wire:model="color_prod" class="form-control" placeholder="Color">
                  @error('color_prod') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="col">
                  <label for="um_prod">Unidad de Manejo</label>
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
                <div class="col">
                  <label for="precio_prod">Precio</label>                  
                  <input type="number" wire:model="precio_prod" min="0" value="0.00" placeholder="0.00" step="0.01" class="form-control floatNumberField">                     
                  @error('precio_prod') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>                
              </div>
              <div class="form-row">                               
                <div class="col">
                  <label for="calidad_prod">Calidad</label>
                  <select name="select" wire:model="calidad_prod" class="form-control">
                    <option value="B">Baja</option>
                    <option value="M">Media</option>
                    <option value="A">Alta</option>
                  </select>
                </div>
                <div class="col">
                  <label for="">Proveedor</label>
                  <select wire:model="proveedor_id" class="form-control">                 
                    @foreach ($proveedores as $item)        
                      <option value="{{$item->id}}">{{$item->emp_prov}}</option>  
                    @endforeach 
                  </select> 
                </div>  
                <div class="col">
                  <label for="nota_prod">Nota</label>                  
                  <textarea wire:model="nota_prod" class="form-control" rows="1"></textarea>
                  @error('nota_prod') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>                
              </div>
              <div class="form-row">{{--FOTO CONTACTO--}}   
                <div class="col">                                          
                  <label for="photo">Foto de producto</label>
                  <input type="file"  wire:model="photo" name="photo"  id="upload{{ $iteration }}" class="form-control" accept="image/x-png,image/jpeg">                                        
                </div>                                                 
              </div>{{--FOTO CONTACTO--}}
              <div class="form-row">{{--VERIFICADO--}}   
                <div class="col mt-2">                                          
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" wire:model="ok_prod" value="">
                    <label class="form-check-label" for="ok_prod">
                      Verificado
                    </label>
                  </div>                  
                </div>                                                 
              </div>{{--VERIFICADO--}}
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