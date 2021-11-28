<?php

namespace Database\Seeders;
use App\Models\Giro;

use Illuminate\Database\Seeder;

class GiroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Giro::create([
            'compra_id' => '1',                                          
            'monto_giro' => 3891.45,  
            'comision_giro' => 2.25,   
            'docs_giro'  => 25,
            'itf_giro' => 0,                      
            'extravio_giro' => 10,   
            'tipo_giro' => 0,
        ]);        
    }     
}
