<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'cat_desc',
        'cat_cod'        
    ]; 

    //RELACION DE UNO A MUCHOS CATEGORIA/PRODUCTOS
    public function productos(){
        return $this->hasMany('App\Models\Producto');
    }
}
