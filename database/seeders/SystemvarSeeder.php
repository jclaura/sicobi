<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Systemvar; 

class SystemvarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Systemvar::create([
            'nom_empresa_sys' => 'TIENDA COMERCIAL "OJO DE GATO"',                                    
            'desc_empresa_sys' => 'SICOBI- SISTEMA DE CONTROL DE BISUTERIA', 
            'tipo_cambio_sys' => 6.97,
            'utilidad_sys' => 100,  
            'iva_sys'  => 13,        
            'it_sys' => 3            
        ]);
    }
}
