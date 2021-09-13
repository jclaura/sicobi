<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Deposito; 

class DepositoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $registro = new Deposito;
        $registro->nom_dep = 'No asignado';
        $registro->dir_dep = '';
        $registro->supervisor_dep = '';
        $registro->save();

        $registro = new Deposito;
        $registro->nom_dep = 'Villazon';
        $registro->dir_dep = 'Av. Villazon"';
        $registro->supervisor_dep = 'Juan Carlos Laura';
        $registro->save();

        $registro = new Deposito;
        $registro->nom_dep = 'Tumusla';
        $registro->dir_dep = 'Av. Tumusla"';
        $registro->supervisor_dep = 'Juan Carlos Laura';
        $registro->save();

        $registro = new Deposito;
        $registro->nom_dep = 'San Antonio';
        $registro->dir_dep = 'Av. Oscar Alfaro"';
        $registro->supervisor_dep = 'Juan Carlos Laura';
        $registro->save();
    }
}
