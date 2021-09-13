<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Categoria; 

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'cat_desc' => 'Piedras Naturales',
            'cat_cod'  => 'PR'                       
        ]);
        Categoria::create([
            'cat_desc' => 'Perlas Cultivadas',
            'cat_cod'  => 'PC'                       
        ]);
        Categoria::create([
            'cat_desc' => 'Cuentas de Nacar',
            'cat_cod'  => 'CN'                       
        ]);
        Categoria::create([
            'cat_desc' => 'Cuentas de Cristal',
            'cat_cod'  => 'CC'                       
        ]);
        Categoria::create([
            'cat_desc' => 'Cuentas Engomadas',
            'cat_cod'  => 'CE'                       
        ]);
        Categoria::create([
            'cat_desc' => 'Cuentas Arenadas',
            'cat_cod'  => 'CA'                       
        ]);
    }
}
