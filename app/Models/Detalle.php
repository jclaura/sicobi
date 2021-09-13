<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'venta_id',              
        'cod_prod_det',    
        'cant_det',
        'um_det',        
        'desc_det',   
        'precio_det'        
    ];         

    public function venta()
    {
        return $this->belongsTo('App\Models\Venta');
    }
}
