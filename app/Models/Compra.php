<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_com',
        'tipo_com',                       
        'items_com',  
        'moneda_com',
        'pais_com',   
        'comprador_com',       
        'pagos_com',  
        'giros_com'  
    ]; 

    //RELACION DE UNO A MUCHOS TIENDA/PRODUCTOS
    public function productos(){
        return $this->hasMany('App\Models\Producto');
    }

    public function pagos(){
        return $this->hasMany('App\Models\Pago');
    }

    public function giros(){
        return $this->hasMany('App\Models\Giro');
    }
}
