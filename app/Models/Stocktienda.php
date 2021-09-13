<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocktienda extends Model
{
    use HasFactory;

    protected $fillable = [
        'tienda_id',              
        'categoria_id',    
        'cod_prod',
        'desc_prod',        
        'medida_prod',   
        'color_prod',
        'um_prod',
        'precio_prod',
        'stock_prod',        
        'foto_prod'        
    ];    

    public function tienda()
    {
        return $this->belongsTo('App\Models\Tienda');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }
}
