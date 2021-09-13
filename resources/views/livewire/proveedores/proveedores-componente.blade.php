<div class="container-fluid"> 
    <div class="card">
      <div class="card-header">
        <h6 class="card-title">PROVEEDORES</h6>       
        <div class="card-tools">
          <button type="button" wire:click="resetVar" class="btn btn-success btn-xs" data-toggle="modal" data-target="#createProveedorModal"><i class="fas fa-plus"></i> Nuevo</button>
        </div>                  
      </div>{{--CARD-HEADER--}}    
      <div class="card-body p-0">
        <table class="table table-sm" style="font-size: 12px;">
          <thead class="table-secondary">
            <tr>
              <th>ID</th>
              <th>EMPRESA</th>
              <th>TELEFONO</th>
              <th>DIRECCION</th>
              <th>WEB</th>
              <th>EMAIL</th>
              <th>PAIS</th>
              <th>PRODUCTOS</th>
              <th>CONTACTO</th>
              <th>ACCIONES</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($proveedor as $item)
              <tr>
                <th>{{$item->id}}</th>
                <td>{{$item->emp_prov}}</td>
                <td>{{$item->tel_prov}}</td>  
                <td>{{$item->dir_prov}}</td>
                <td>{{$item->web_prov}}</td>  
                <td>{{$item->email_prov}}</td>
                <td>{{$item->pais_prov}}</td>  
                <td>{{$item->prod_prov}}</td>                                       
                @if ($item->contacto_prov <> "noimage.png") 
                  <td>                    
                    <a href="#" onclick="verFoto('{{$item->contacto_prov}}','{{$rutaFotosContactos}}')"><img src="{{ Storage::url('FotosContactos/'.$item->contacto_prov)}}" alt="Zoom Foto" height="38" width="51">  
                  </td>  
                @else                  
                  <td>
                    <a href="#" onclick="verFotoNoDisponible()"><img src="{{asset('noimage.png')}}" alt="Zoom Foto" height="38" width="51">  
                  </td>
                @endif  
                <td>                                           
                  <button wire:click.prevent="edit('{{$item->id}}')" class="bnt btn-info btn-xs" title="Editar"><i class="fas fa-edit"></i></button>                          
                  <button wire:click="$emit('borrarReg', {{$item->id}})" class="bnt btn-danger btn-xs" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                </td>
              </tr>   
            @endforeach                                        
          </tbody>
        </table>    
      </div>{{--CARD-BODY--}}     
      <div class="card-footer clearfix">      
        {{$proveedor->links()}} 
      </div>   
    </div>{{--CARD--}}
  
    @include('livewire.proveedores.create') 
    @include('livewire.proveedores.edit')
  </div>{{--CONTAINER--}}  
  
  @push('scripts'){
    <script src="js/alertas.js"></script> 
    
  @endpush
