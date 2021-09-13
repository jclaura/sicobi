<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;  

    protected $fillable = [
        'compra_id',
        'fecha_pago',
        'monto_pago',                       
        'desc_pago',
        'nota_pago'        
    ]; 

    public function compra()
    {
        return $this->belongsTo('App\Models\Compra');
    }
}
