<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_prov',
        'tel_prov',                       
        'dir_prov',
        'web_prov',   
        'email_prov',
        'pais_prov',    
        'prod_prov',
        'contacto_prov'        
    ];    

    //RELACION DE UNO A MUCHOS PRODUCTOS/PRODUCTOS
    public function productos(){
        return $this->hasMany('App\Models\Producto');
    }
}
