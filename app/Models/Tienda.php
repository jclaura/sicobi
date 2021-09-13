<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    use HasFactory;  

    protected $fillable = [
        'nom_tienda',
        'dir_tienda',
        'ciudad_tienda',
        'fecha_ini_tienda'        
    ]; 

    //RELACION DE UNO A MUCHOS TIENDA/PRODUCTOS
    public function productos(){
        return $this->hasMany('App\Models\Stocktienda');
    }

    public function empleados(){
        return $this->hasMany('App\Models\Empleado');
    }
}
