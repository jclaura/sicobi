<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [        

        'deposito_id', 
        'cod_prod', 
        'desc_prod', 
        'medida_prod', 
        'color_prod', 
        'um_prod',             
        'precio_prod',         
        'calidad_prod',         
        'stock_prod',         
        'foto_prod'
    ]; 

    public function deposito()
    {
        return $this->belongsTo('App\Models\Deposito');
    }    
    //UN STOCK TIENE MUCHAS ENTRADAS Y MUCHAS SALIDAS
    public function entrada(){
        return $this->hasMany('App\Models\Entrada');
    }
   
    public function salida(){
        return $this->hasMany('App\Models\Salida');
    }
}
