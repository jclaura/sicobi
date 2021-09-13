<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_dep',
        'dir_dep',
        'supervisor_dep'        
    ]; 
    

    //RELACION DE UNO A MUCHOS DEPOSITO/CLASIFICACION
    public function grupos(){
        return $this->hasMany('App\Models\Grupo');
    }  

    //RELACION DE UNO A MUCHOS DEPOSITO/STOCK(EXISTENCIAS)
    public function existencias(){
        return $this->hasMany('App\Models\Stock');
    }  
}
