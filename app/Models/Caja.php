<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $fillable = [
        'tienda_id',
        'empleado_id',
        'fecha_apertura_caja',      
        'hora_apertura_caja', 
        'fecha_cierre_caja', 
        'hora_cierre_caja', 
        'saldo_caja', 
        'venta_caja',
        'ingresos_caja',
        'egresos_caja',
        'efectivo_caja',
        'nota_caja',
        'activo_caja'
    ];  

    //RELACION DE UNO A MUCHOS CAJA/VENTAS
    public function ventas(){
        return $this->hasMany('App\Models\Venta');
    }

    //RELACION DE UNO A MUCHOS CAJA/GASTOS
    public function gastos(){
        return $this->hasMany('App\Models\Gasto');
    }
}
