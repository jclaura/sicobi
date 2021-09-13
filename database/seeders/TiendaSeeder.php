<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tienda; 

class TiendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $registro = new Tienda;
        $registro->nom_tienda = 'TIENDA TABLADA';
        $registro->dir_tienda = 'Pasaje "La Tablada"';
        $registro->ciudad_tienda = 'La Paz';
        $registro->save();

        $registro = new Tienda;
        $registro->nom_tienda = 'TIENDA TUMUSLA';
        $registro->dir_tienda = 'Av. Tumusla';
        $registro->ciudad_tienda = 'La Paz';
        $registro->save();

        $registro = new Tienda;
        $registro->nom_tienda = 'TIENDA VILLAZÓN';
        $registro->dir_tienda = 'Av. Villazón';
        $registro->ciudad_tienda = 'La Paz';
        $registro->save();  
    }
}
