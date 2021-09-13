Livewire.on('borrarReg', regId => {
    Swal.fire({
    title: 'Estas seguro?',
    text: "No podrás revertir esto!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, borrar!',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      Livewire.emit('destroy', regId)
      Swal.fire(
        'Borrado!',
        'El registro ha sido borrado.',
        'success'
      )
    } 
  })
})    

Livewire.on('confirmarPagos', () => {
  Swal.fire({
  title: 'Estas seguro?',
  text: "No podrás revertir esto!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, finalizar!',
  cancelButtonText: 'Cancelar'
}).then((result) => {
  if (result.isConfirmed) {
    Livewire.emit('finalizaPagos')
    Swal.fire(
      'Finalizado!',
      'Todos los pagos han finalizado.',
      'success'
    )
  } else{        
    document.getElementById("pagos").options.item(0).selected = 'selected';    
  }
})
})  

Livewire.on('confirmarGiros', () => {
  Swal.fire({
  title: 'Estas seguro?',
  text: "No podrás revertir esto!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, finalizar!',
  cancelButtonText: 'Cancelar'
}).then((result) => {
  if (result.isConfirmed) {
    Livewire.emit('finalizaGiros')
    Swal.fire(
      'Finalizado!',
      'Todas las transferencias han finalizado.',
      'success'
    )
  } else{        
    document.getElementById("giros").options.item(0).selected = 'selected';    
  }
})
})  

Livewire.on('infoAddStock', (medida, producto, stock, precio, nuevo, msg) => {
  Swal.fire({
  title: 'Existencia actual?',  
  icon: 'info',
  html:
  '<table class="table table-bordered">' +
    '<thead class="thead-dark">'+
    '<tr>'+         
      '<th>PRODUCTO</th>'+
      '<th>STOCK</th>'+
      '<th>PRECIO</th>'+
      '<th>NUEVO</th>'+
    '</tr>'+
    '</thead>'+
    '<tbody>'+
      '<tr>'+        
        '<td>'+producto+' '+medida+'</td>'+
        '<td>'+stock+'</td>'+
        '<td>'+precio+'</td>'+
        '<td>'+nuevo+'</td>'+
      '</tr>'+
    '</tbody>'+
  '</table>'+
  '<p>'+msg+'</p>',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, actualizar',
  cancelButtonText: 'Cancelar'
}).then((result) => {
  if (result.isConfirmed) {
    Livewire.emit('addstock')
    Swal.fire(
      'Inventariado!',
      'El registro ha sido actualizado.',
      'success'
    )
  }
})
})  

Livewire.on('infoNewStock', codigo => {
  Swal.fire({
  title: 'CÓDIGO: '+codigo,  
  html:'<h3>Producto nuevo</h3>'+'<p>Se adicionara al inventario</p>',  
  icon: 'info',  
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, adicionar',
  cancelButtonText: 'Cancelar'
}).then((result) => {
  if (result.isConfirmed) {
    Livewire.emit('newStock')
    Swal.fire(
      'Inventariado!',
      'Nuevo producto se ha inventariado.',
      'success'
    )
  }
})
})  

Livewire.on('msgError', msg =>{
  Swal.fire({
    icon: 'error',
    title: 'Error...',
    text: msg       
  })  
})  

function verTexto(desc, texto){                          
  Swal.fire({        
    icon: 'info',
    title: desc,
    text: texto   
  })
} 

function verFoto(file, path){                          
  Swal.fire({        
      imageUrl: '/storage/'+path+'/'+file,                
      width: 400,              
      imageHeight: 300,
      imageAlt: 'Custom image',
  })
} 

function verFotoNoDisponible(){                          
  Swal.fire({        
      imageUrl: '/noimage.png',                
      width: 400,              
      imageHeight: 300,
      imageAlt: 'Custom image',
  })
} 