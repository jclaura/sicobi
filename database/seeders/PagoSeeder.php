<?php

namespace Database\Seeders;
use App\Models\Pago;

use Illuminate\Database\Seeder;

class PagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pago::create([
            'compra_id' => '1',               
            'monto_pago' => 101.22,                      
            'desc_pago' => 'Comision Pepe',  
            'nota_pago'  => 'N.E.'                   
        ]);

        Pago::create([
            'compra_id' => '1',               
            'monto_pago' => 1260,                      
            'desc_pago' => 'Pago transporte avion',  
            'nota_pago'  => 'N.E.'                   
        ]);

        Pago::create([
            'compra_id' => '1',               
            'monto_pago' => 270,                      
            'desc_pago' => 'Impuestos aduana',  
            'nota_pago'  => 'N.E.'                   
        ]);

        Pago::create([
            'compra_id' => '1',               
            'monto_pago' => 270,                      
            'desc_pago' => 'Arancel aduana',  
            'nota_pago'  => 'N.E.'                   
        ]);

        Pago::create([
            'compra_id' => '1',               
            'monto_pago' => 200,                      
            'desc_pago' => 'Otros gastos',  
            'nota_pago'  => 'N.E.'                   
        ]);

        
    }
}
