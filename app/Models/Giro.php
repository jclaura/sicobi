<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giro extends Model
{
    use HasFactory;

    protected $fillable = [
        'compra_id',
        'fecha_giro',
        'monto_giro',                       
        'comision_giro',
        'docs_giro',        
        'itf_giro',
        'extravio_giro',
        'tipo_giro'  
    ]; 

    public function compra()
    {
        return $this->belongsTo('App\Models\Compra');
    }
}
