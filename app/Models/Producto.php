<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'compra_id',
        'proveedor_id',       
        'categoria_id',    
        'cod_prod',
        'desc_prod',
        'cant_prod',
        'medida_prod',   
        'color_prod',
        'um_prod',
        'precio_prod',
        'calidad_prod',   
        'foto_prod',
        'nota_prod',
        'ok_prod',           
        'ok_inv'
    ];             

    public function proveedor()
    {
        return $this->belongsTo('App\Models\Proveedor');
    }

    public function compra()
    {
        return $this->belongsTo('App\Models\Compra');
    }    

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }   
}
