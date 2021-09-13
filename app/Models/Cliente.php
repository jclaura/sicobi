<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_cli',
        'doc_cli',
        'tel_cli',
        'ciudad_cli'
    ]; 

    //RELACION DE UNO A MUCHOS CLIENTE/VENTAS
    public function compras(){
        return $this->hasMany('App\Models\Venta');
    }
}
