<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;

    protected $fillable = [
        'caja_id',                      
        'monto_gas',        
        'desc_gas'                  
    ];  
    
    public function caja()
    {
        return $this->belongsTo('App\Models\Caja');
    }
}
