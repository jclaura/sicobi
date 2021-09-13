<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    use HasFactory;    

    protected $fillable = [
        'stock_id', 
        'tienda_id', 
        'fecha_sal',                       
        'codprod_sal',  
        'cantprod_sal', 
        'precio_sal', 
        'precio_ven' 
                        
    ];    

    //RELACION DE UNO A UNO
    public function stock(){
        return $this->belongsTo('App\Models\Stock');
    }

    public function tienda(){
        return $this->belongsTo('App\Models\Tienda');
    }
}
