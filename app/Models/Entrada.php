<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entrada extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',                            
        'fecha_ent',
        'codprod_ent',        
        'cantprod_ent',
        'precio_ent'         
    ]; 

    //RELACION DE UNO A UNO
    public function producto(){
        return $this->belongsTo('App\Models\Producto');
    }    
}
