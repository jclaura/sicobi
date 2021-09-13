<!-- Modal -->
<div wire:ignore.self class="modal fade" id="cajaModal" tabindex="-1" role="dialog" aria-labelledby="cajaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cajaModalLabel">{{$titulo_caja}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> 
        </div>
        <div class="modal-body">
            <div class="card text-center">                
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-sm text-left">                        
                                <div class="form-group">
                                    <label for="saldo_caja">Saldo inicial</label>
                                    <input type="number" id="saldo_caja" wire:model="saldo_caja" min="0" max="300" value="0.00" placeholder="0.00" step="0.01" class="form-control floatNumberField">                                                                                                
                                    @error('saldo_caja') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-sm text-left">                        
                                <div class="form-group">
                                    <label for="venta_caja">Venta</label>
                                    <input type="number" id="venta_caja" wire:model="venta_caja" min="0" value="0.00" placeholder="0.00" step="0.01" class="form-control floatNumberField" disabled>                                    
                                </div>
                            </div>
                            <div class="col-sm text-left">                        
                                <div class="form-group">
                                    <label for="ingresos_caja">Ingresos</label>
                                    <input type="number" id="ingresos_caja" wire:model="ingresos_caja" min="0" value="0.00" placeholder="0.00" step="0.01" class="form-control floatNumberField">                                    
                                </div>
                            </div>
                            <div class="col-sm text-left">                        
                                <div class="form-group">
                                    <label for="egresos_caja">Gastos</label>
                                    <input type="number" id="egresos_caja" wire:model="egresos_caja" min="0" value="0.00" placeholder="0.00" step="0.01" class="form-control floatNumberField" disabled>                                    
                                </div>
                            </div>
                        </div>{{--ROW 1--}}   
                        <div class="row">
                            <div class="col-sm text-left">                        
                                <div class="form-group">
                                    <label for="total_caja">Total caja</label>
                                    <input type="number" id="total_caja" wire:model="total_caja" min="0" max="300" value="0.00" placeholder="0.00" step="0.01" class="form-control floatNumberField" disabled>                                    
                                </div>
                            </div>
                            <div class="col-sm text-left">                        
                                <div class="form-group">
                                    <label for="efectivo_caja">Efectivo</label>
                                    <input type="number" id="efectivo_caja" wire:model="efectivo_caja" min="0" value="0.00" placeholder="0.00" step="0.01" class="form-control floatNumberField" {{$input_efectivo_caja}}>                                    
                                    @error('efectivo_caja') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-sm text-left">                        
                                <div class="form-group">
                                    <label for="diferencia_caja">Diferencia</label>
                                    <input type="number" wire:model="diferencia_caja" min="0" value="0.00" placeholder="0.00" step="0.01" class="form-control floatNumberField" disabled>                                    
                                </div>
                            </div>                                               
                        </div>{{--ROW 2--}} 
                        <div class="row">                            
                            <div class="col-sm text-left">                        
                                <div class="form-group">                                                        
                                    <label for="TextareaNota">Nota</label>
                                    <textarea wire:model="nota_caja" class="form-control" id="TextareaNota" rows="1"></textarea>                                    
                                </div>
                            </div>                    
                        </div>{{--ROW 3--}}   
                    </form>       
                </div>                
            </div> 
        </div>
        <div class="modal-footer">  
          @if ($activo_caja)                  
            <button type="button" wire:click="modificaDatosCaja" class="btn btn-primary">Guardar cambios</button>
          @endif
          <button type="button" wire:click="{{$funcion_caja}}" class="btn btn-danger">{{$texto_boton_caja}}</button>  
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>                                       
        </div>
      </div>
    </div>
</div>