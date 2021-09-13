<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=M<, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>      
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
      hr {
        height: 1px;
        background-color: black;
        margin-bottom: 0px;
        margin-top: 0px;
      }

      #contenedor {
        text-align: left;
        width: 100%;        
        }

        #lateral {
          width: 50%;  /* Este será el ancho que tendrá tu columna */
          background-color: #CCCCCC;  /* Aquí pon el color del fondo que quieras para este lateral */
          float:right; /* Aquí determinas de lado quieres quede esta "columna" */
          padding: 5px;
          font-size: 11px;
        }

        #principal {
          width: 48%;
          float: left;
          background-color: #FFFFFF;
          /*border:#000000 1px solid; /* ponemos un donde para que se vea bonito */
          padding: 5px;
          font-size: 12px;
       }
        /* Para limpiar los floats */
        .clearfix:after {
          content: "";
          display: table;
          clear: both;
      }
    </style>
    @livewireStyles
</head>
<body> 
  @php 
    function obtenerFechaEnLetra($fecha){
    $dia= conocerDiaSemanaFecha($fecha);
    $num = date("j", strtotime($fecha));
    $anno = date("Y", strtotime($fecha));
    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
    $mes = $mes[(date('m', strtotime($fecha))*1)-1];
    return $dia.', '.$num.' de '.$mes.' del '.$anno;
    }
    
    function conocerDiaSemanaFecha($fecha) {
        $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        $dia = $dias[date('w', strtotime($fecha))];
        return $dia;
    }
  @endphp
  <div class="text-center">
    <h5>BISUTERIA "OJO DE GATO"</h5>
    <hr/>     
  </div>  
  <div id="contenedor" class="clearfix">

    <div id="principal">
      <b>DIRECCION:</b> @php echo $tienda; @endphp<br>
      <b>VENDEROR(A):</b> @php echo $nombre; @endphp <br>
      <b>CELULAR:</b> 76257494 - 76255634<br>        
      <b>WEB:</b> www.bisuteriaojodegato.com<br> 
    </div>
    
    <div id="principal">
      <b>CLIENTE:</b> @php echo $cliente; @endphp<br>
      <b>NIT/CI:</b> @php echo $nit; @endphp<br>
      <b>FECHA:</b> @php $fecha = date("F j, Y, g:i a"); echo obtenerFechaEnLetra($fecha); @endphp<br>      
      <b>HORA:</b> @php echo date('h:i:s A'); @endphp<br> 
    </div>
    
  </div>
  <div class="text-center">    
    <hr/>     
  </div>  

  <div class="container-fluid">         
    <h6 style="text-align: center; margin-top: 5px;">DETALLE DE LA VENTA</h6>
    <table class="table table-sm table-bordered" style="font-size: 11px;">
        <thead>
          <tr>
            <th>CANTIDAD</th>
            <th>UNIDAD</th>
            <th>CONCEPTO</th>
            <th>PRECIO</th>
            <th>SUBTOTAL</th>
          </tr>
        </thead>
        <tbody>
            @php
             $totalFactura=0;
            @endphp
           @foreach ($recibo as $detalle )
            <tr>
                <td>{{$detalle->cant_det}}</td>
                <td>{{$detalle->um_det}}</td>
                <td>{{$detalle->desc_det}}</td>
                <td>{{$detalle->precio_det}}</td>
                @php                   
                    $subtotalFilaFactura=$detalle->cant_det*$detalle->precio_det;
                    $totalFactura+=$subtotalFilaFactura;
                    $totalFactura=number_format($totalFactura, 2, '.', '');
                    $subtotalFilaFactura=number_format($subtotalFilaFactura, 2, '.', '');              
                @endphp 
                <td>{{$subtotalFilaFactura}}</td>                  
            </tr> 
           @endforeach  
           <td></td>                  
           <td></td>
           <td>TOTAL</td>
           <td>{{$totalFactura}}</td>
        </tbody>
      </table>
  </div>

  @livewireScripts
</body>
</html>   
