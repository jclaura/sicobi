<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'deposito_id',
        'estante_gru',
        'fila_estante_gru',
        'tipo_prod_gru',
        'codprod_gru',
        'etiqueta_gru',
        'rotulo_gru',
        'nota_gru'     
    ]; 

    public function deposito()
    {
        return $this->belongsTo('App\Models\Deposito');
    }
}
