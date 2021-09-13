<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proveedor; 

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proveedor::create([ 
            'emp_prov' => 'Sin datos',
            'tel_prov'  => 'N.E.',                       
            'dir_prov' => 'N.E.',
            'web_prov'  => 'N.E.',   
            'email_prov' => 'N.E.',
            'pais_prov'  => 'China',    
            'prod_prov' => 'N.E.',
            'contacto_prov'  => 'noimage.png'    
        ]);
        Proveedor::create([
            'emp_prov' => 'Danfeng Alloy Ornament Fittings',
            'tel_prov'  => 'O579-85310805',                       
            'dir_prov' => '140 Shangcheng Avenue, Yiwu City(behind KFC)',
            'web_prov'  => 'N.E.',   
            'email_prov' => 'N.E.',
            'pais_prov'  => 'China',    
            'prod_prov' => 'Metal fundición de calidad media',
            'contacto_prov'  => 'noimage.png'    
        ]);
        Proveedor::create([
            'emp_prov' => 'ORDERLY TOOL',
            'tel_prov'  => '0579-85372669',                       
            'dir_prov' => 'G2-14665 Shop 2 Period',
            'web_prov'  => 'N.E.',   
            'email_prov' => '2508771092@qq.com',
            'pais_prov'  => 'China',    
            'prod_prov' => 'Juego de Alicates, Alicate con goma, Alicate 4 utilidades',
            'contacto_prov'  => 'noimage.png'    
        ]);
        Proveedor::create([
            'emp_prov' => 'Lou Gou Liang Li Bin',
            'tel_prov'  => '85565655',                       
            'dir_prov' => 'N.E.',
            'web_prov'  => 'yiwuquianxi.cn.alibaba.com',   
            'email_prov' => 'N.E.',
            'pais_prov'  => 'China',    
            'prod_prov' => 'Cola de Rata plateado y dorado, orejera ONIK, Argolla de llavero grande, Alfiler Checo 1.8 y 2.5, Cadena delagado de 200 mts.',
            'contacto_prov'  => 'noimage.png'    
        ]);
    }
}
