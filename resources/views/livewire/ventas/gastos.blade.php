<!-- Modal -->
<div wire:ignore.self class="modal fade" id="gastosModal" tabindex="-1" role="dialog" aria-labelledby="gastosModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gastosModalLabel">Gastos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-1">
                    <div class="col-4">                                                
                        <input type="number" wire:model="monto_gas" min="0" value="0.00" placeholder="Monto" step="0.01" class="form-control floatNumberField">                                                                         
                        @error('monto_gas') <span class="text-danger error">{{ $message }}</span>@enderror                       
                    </div>
                    <div class="col-4">                       
                        <input type="text" wire:model="desc_gas" placeholder="Descripción" class="form-control">
                        @error('desc_gas') <span class="text-danger error">{{ $message }}</span>@enderror                       
                    </div>
                    <div class="col-4">
                        <button type="button" wire:click="guardaGastos" class="btn btn-primary">Adicionar</button>
                    </div>
                </div>   
                <div class="row">
                    <div class="col-12">
                    {{--TABLA EGRESOS--}}        
                    <table id="productos" class="table table-bordered table-sm" style="font-size: 12px;">  
                        <thead>
                        <tr>                            
                            <th>GASTO</th>
                            <th>DESCRIPCION</th>              
                            <th>ACCION</th>  
                        </tr>
                        </thead>              
                        <tbody>
                            @if ($activo_caja) 
                                @foreach ($gastos as $item)         
                                    <tr>              
                                        <td>{{$item->monto_gas}}</td>  
                                        <td>{{$item->desc_gas}}</td> 
                                        <td>                                                   
                                            <button wire:click="borrarGastos('{{$item->id}}')" class="bnt btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                        </td>                                      
                                    </tr>                                                             
                                @endforeach  
                            @endif           
                        </tbody>
                    </table> 
                    </div>
                </div>             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
      </div>
    </div>
</div>