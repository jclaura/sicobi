<?php
use App\Models\Empleado;
use App\Models\Arqueo;

use Carbon\Carbon;

if (! function_exists('usuario_actual')) {
    function usuario_actual()
    {
        //OBTIENE EL REGISTRO DEL USUARIO ACTUAL
        $user = auth()->user();
        return $user->empleado;//REGISTRO EMPLEADO RELACION UNO A UNO         
         
    }
}   