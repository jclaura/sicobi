<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\Empleado; 

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {        
        /*$empleado = Empleado::where('user_id', '=', auth()->user()->id)->first();        
        if ($empleado->estado_emp===1){                            
            dd('ANTES DE SALIR DEBES CERRAR CAJA'); 
            
        } */ 
    }
}
