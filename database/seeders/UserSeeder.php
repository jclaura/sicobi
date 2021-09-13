<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 
use App\Models\Empleado;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Juan Carlos Laura',
            'email' => 'jclauraa@gmail.com',            
            'password' => bcrypt('442905jclaura'), 
            'rol' => 'Administrador'           
        ])->assignRole('Administrador');
        

        Empleado::create([
            'user_id' => '1',                                          
            'tienda_id' => '3',  
            'ci_emp' => '442905',   
            'dir_emp'  => 'Av. Oscar Alfaro',
            'tel_emp' => '76257494',                                  
            'estado_emp' => 0,               
            'fecha_ing_emp' => '2021/08/25',   
            'sueldo_emp' => 3000,
            'avatar' => 'jcl.jpg', 
        ]);   
       
    }
}
