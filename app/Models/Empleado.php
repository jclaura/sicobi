<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tienda_id',
        'ci_emp',
        'dir_emp',
        'tel_emp',               
        'estado_emp',
        'fecha_ing_emp',  
        'sueldo_emp',
        'avatar'        
    ]; 
    
    //RELACION DE UNO A UNO
    public function usuario(){
        return $this->belongsTo('App\Models\User');
    }

    public function tienda(){
        return $this->belongsTo('App\Models\Tienda');
    }
}
