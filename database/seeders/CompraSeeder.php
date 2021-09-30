<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Compra; 


class CompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Compra::create([
            'fecha_com' => '2021/09/30',
            'tipo_com' => 6.35,                       
            'items_com' => 21, 
            'moneda_com' => 'Yuan',
            'pais_com' => 'China',   
            'comprador_com' => 'Juan Carlos Laura',  
            'pagos_com' => 0,
            'giros_com' => 0            
        ]);        
    }
}
