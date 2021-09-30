<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {        
        $this->call(CategoriaSeeder::class);
        $this->call(TiendaSeeder::class);       
        $this->call(ProveedorSeeder::class);
        $this->call(CompraSeeder::class);
        $this->call(DepositoSeeder::class);
        //$this->call(ProductoSeeder::class);
        //$this->call(PagoSeeder::class);
        //$this->call(GiroSeeder::class);
        $this->call(SystemvarSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);       
    }
}
