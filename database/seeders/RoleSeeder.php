<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//MODELO PARA SPATIE ROLES Y PERMISOS
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Supervisor']);
        $role3 = Role::create(['name' => 'Vendedor']); 

        //OPCIONES DE IMPORTACION
        $permission = Permission::create(['name' => 'proveedores'])->assignRole($role1);
        $permission = Permission::create(['name' => 'compras'])->assignRole($role1);
        $permission = Permission::create(['name' => 'productos'])->assignRole($role1);
        $permission = Permission::create(['name' => 'pagos'])->assignRole($role1);
        $permission = Permission::create(['name' => 'giros'])->assignRole($role1);

        //OPCIONES DE INVENTARIO
        $permission = Permission::create(['name' => 'depositos'])->assignRole([$role1, $role2]);
        $permission = Permission::create(['name' => 'grupos'])->assignRole([$role1, $role2]);
        $permission = Permission::create(['name' => 'tiendas'])->assignRole([$role1, $role2]);
        $permission = Permission::create(['name' => 'categorias'])->assignRole([$role1, $role2]);
        $permission = Permission::create(['name' => 'stock'])->assignRole([$role1, $role2]);
        $permission = Permission::create(['name' => 'entradas'])->assignRole([$role1, $role2]);
        $permission = Permission::create(['name' => 'salidas'])->assignRole([$role1, $role2]);
        
        //OPCIONES DE VENTAS        
        $permission = Permission::create(['name' => 'ventas'])->assignRole([$role1, $role3]);
        $permission = Permission::create(['name' => 'reportes'])->assignRole([$role1, $role3]);
        $permission = Permission::create(['name' => 'clientes'])->assignRole([$role1, $role3]);               

        //OPCIONES DE CONFIGURACIONB        
        $permission = Permission::create(['name' => 'usuarios'])->assignRole($role1);
        $permission = Permission::create(['name' => 'empresa'])->assignRole($role1);        

        //METODO DE ASIGNACION DE UN PERMISO CON VARIOS ROLES
        //$permission = Permission::create(['name' => 'productos'])->syncRoles([$role1, $role2]);
    }
}
