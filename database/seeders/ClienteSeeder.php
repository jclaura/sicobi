<?php

namespace Database\Seeders;
use App\Models\Cliente; 

use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
            'nom_cli' => 'Cliente ocasional',               
            'doc_cli' => 'Sin datos',                      
            'tel_cli' => 'Sin datos',  
            'ciudad_cli'  => 'La Paz',        
            'pref_cli' => 'Todo'            
        ]);           
    }
}
