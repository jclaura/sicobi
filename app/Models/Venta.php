<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'caja_id',              
        'cliente_id',    
        'fecha_ven',
        'hora_ven',        
        'doc_ven',   
        'total_ven',
        'rebaja_ven',
        'tipo_pago_ven'             
    ];    
    
    //RELACION DE UNO A MUCHOS VENTA/DETALLES
    public function detalles(){
        return $this->hasMany('App\Models\Detalle');
    }

    //RELACION DE PERTENECIA VENTA/CAJA
    public function caja()
    {
        return $this->belongsTo('App\Models\Caja');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }
}
