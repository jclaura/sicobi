<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto; 

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create([
            'compra_id' => '1',               
            'proveedor_id' => '1',                      
            'categoria_id' => '1',  
            'cod_prod'  => 'PR-CU-08-003',        
            'desc_prod' => 'Onix Negro',
            'cant_prod' => 100, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Negro',          
            'um_prod' => 'Tira',
            'precio_prod' => 4.8,           
            'calidad_prod' => 'M',                                            
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',            
            'proveedor_id' => '1',   
            'categoria_id' => '1',                       
            'cod_prod'  => 'PR-CU-08-017',        
            'desc_prod' => 'Roca Volcanica',
            'cant_prod' => 100, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Negro',          
            'um_prod' => 'Tira',
            'precio_prod' => 2,           
            'calidad_prod' => 'M',                                         
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',             
            'proveedor_id' => '1',   
            'categoria_id' => '1',                       
            'cod_prod'  => 'PR-CU-08-018',        
            'desc_prod' => 'Agata Musgo',
            'cant_prod' => 100, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Blanco y verde',          
            'um_prod' => 'Tira',
            'precio_prod' => 6.8,           
            'calidad_prod' => 'M',                                          
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',              
            'proveedor_id' => '1',  
            'categoria_id' => '1',                       
            'cod_prod'  => 'PR-CU-08-019',        
            'desc_prod' => 'Cornalina',
            'cant_prod' => 100, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Verde, guindo, negro',          
            'um_prod' => 'Tira',
            'precio_prod' => 5.8,           
            'calidad_prod' => 'M',                                         
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',             
            'proveedor_id' => '1',  
            'categoria_id' => '1',                       
            'cod_prod'  => 'PR-CU-08-020',        
            'desc_prod' => 'Cornalina naranja',
            'cant_prod' => 100, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Naranja',          
            'um_prod' => 'Tira',
            'precio_prod' => 8,           
            'calidad_prod' => 'M',                                             
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',              
            'proveedor_id' => '1',  
            'categoria_id' => '1',                      
            'cod_prod'  => 'PR-CU-08-050',        
            'desc_prod' => 'Ojo de gato',
            'cant_prod' => 100, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Lila',          
            'um_prod' => 'Tira',
            'precio_prod' => 5.8,           
            'calidad_prod' => 'M',                                              
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',                                    
            'proveedor_id' => '1',
            'categoria_id' => '1',  
            'cod_prod'  => 'PR-CU-08-001',        
            'desc_prod' => 'Amatista',
            'cant_prod' => 100, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Lila',          
            'um_prod' => 'Tira',
            'precio_prod' => 5.8,           
            'calidad_prod' => 'M',                                              
            'nota_prod' => 'N.E.'
        ]);


        //DESDE AQUI PENDULOS
        Producto::create([
            'compra_id' => '1',                                    
            'proveedor_id' => '1',
            'categoria_id' => '1',  
            'cod_prod'  => 'PR-DJ-08-001',        
            'desc_prod' => 'Amatista',
            'cant_prod' => 1000, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Lila',          
            'um_prod' => 'Unidad',
            'precio_prod' => 1.9,           
            'calidad_prod' => 'M',                                              
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',                                    
            'proveedor_id' => '1',
            'categoria_id' => '1',  
            'cod_prod'  => 'PR-DJ-08-005',        
            'desc_prod' => 'Ojo de Tigre',
            'cant_prod' => 600, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Cafe',          
            'um_prod' => 'Unidad',
            'precio_prod' => 1.2,           
            'calidad_prod' => 'M',                                              
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',                                    
            'proveedor_id' => '1',
            'categoria_id' => '1',  
            'cod_prod'  => 'PR-DJ-08-004',        
            'desc_prod' => 'Cuarzo rosado',
            'cant_prod' => 1000, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Rosado',          
            'um_prod' => 'Unidad',
            'precio_prod' => 1.2,           
            'calidad_prod' => 'M',                                              
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',                                    
            'proveedor_id' => '1',
            'categoria_id' => '1',  
            'cod_prod'  => 'PR-DJ-08-009',        
            'desc_prod' => 'Aventurina Azul',
            'cant_prod' => 1000, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Azul marino',          
            'um_prod' => 'Unidad',
            'precio_prod' => 1.2,           
            'calidad_prod' => 'M',                                              
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',                                    
            'proveedor_id' => '1',
            'categoria_id' => '1',  
            'cod_prod'  => 'PR-DJ-08-013',        
            'desc_prod' => 'Unakite',
            'cant_prod' => 200, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Verde y naranja',          
            'um_prod' => 'Unidad',
            'precio_prod' => 1.2,           
            'calidad_prod' => 'M',                                              
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',                                    
            'proveedor_id' => '1',
            'categoria_id' => '1',  
            'cod_prod'  => 'PR-DJ-08-003',        
            'desc_prod' => 'Onix negro',
            'cant_prod' => 1000, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Negro',          
            'um_prod' => 'Unidad',
            'precio_prod' => 0.95,           
            'calidad_prod' => 'M',                                              
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',                                    
            'proveedor_id' => '1',
            'categoria_id' => '1',  
            'cod_prod'  => 'PR-DJ-08-002',        
            'desc_prod' => 'Piedra luna',
            'cant_prod' => 1000, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Blanquecino',          
            'um_prod' => 'Unidad',
            'precio_prod' => 0.95,           
            'calidad_prod' => 'M',                                              
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',                                    
            'proveedor_id' => '1',
            'categoria_id' => '1',  
            'cod_prod'  => 'PR-DJ-08-022',        
            'desc_prod' => 'Howlita turquesa',
            'cant_prod' => 600, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Blanquecino',          
            'um_prod' => 'Unidad',
            'precio_prod' => 0.95,           
            'calidad_prod' => 'M',                                              
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',                                    
            'proveedor_id' => '1',
            'categoria_id' => '1',  
            'cod_prod'  => 'PR-DJ-08-015',        
            'desc_prod' => 'Cuarzo blanco transparente',
            'cant_prod' => 600, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Blanco cristal',          
            'um_prod' => 'Unidad',
            'precio_prod' => 0.95,           
            'calidad_prod' => 'M',                                              
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',                                    
            'proveedor_id' => '1',
            'categoria_id' => '1',  
            'cod_prod'  => 'PR-DJ-08-030',        
            'desc_prod' => 'Luminoso amarillo',
            'cant_prod' => 600, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Amarillo',          
            'um_prod' => 'Unidad',
            'precio_prod' => 1.1,           
            'calidad_prod' => 'M',                                              
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',                                    
            'proveedor_id' => '1',
            'categoria_id' => '1',  
            'cod_prod'  => 'PR-DJ-08-040',        
            'desc_prod' => 'Agata negro',
            'cant_prod' => 200, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Negro con rayas',          
            'um_prod' => 'Unidad',
            'precio_prod' => 1.7,           
            'calidad_prod' => 'M',                                              
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',                                    
            'proveedor_id' => '1',
            'categoria_id' => '1',  
            'cod_prod'  => 'PR-DJ-08-041',        
            'desc_prod' => 'Agata azul',
            'cant_prod' => 200, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Azul con rayas',          
            'um_prod' => 'Unidad',
            'precio_prod' => 1.7,           
            'calidad_prod' => 'M',                                              
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',                                    
            'proveedor_id' => '1',
            'categoria_id' => '1',  
            'cod_prod'  => 'PR-DJ-08-042',        
            'desc_prod' => 'Agata rojo',
            'cant_prod' => 200, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Rojo',          
            'um_prod' => 'Unidad',
            'precio_prod' => 1.2,           
            'calidad_prod' => 'M',                                              
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',                                    
            'proveedor_id' => '1',
            'categoria_id' => '1',  
            'cod_prod'  => 'PR-DJ-08-060',        
            'desc_prod' => 'Dijes luminosos',
            'cant_prod' => 1200, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Luminoso',          
            'um_prod' => 'Unidad',
            'precio_prod' => 1.65,           
            'calidad_prod' => 'M',                                              
            'nota_prod' => 'N.E.'
        ]);

        Producto::create([
            'compra_id' => '1',                                    
            'proveedor_id' => '1',
            'categoria_id' => '1',  
            'cod_prod'  => 'SIN CODIGO',        
            'desc_prod' => 'Muestra de cuentas de piedras',
            'cant_prod' => 1, 
            'medida_prod' => '8mm', 
            'color_prod' => 'Varios',          
            'um_prod' => 'Unidad',
            'precio_prod' => 308,           
            'calidad_prod' => 'M',                                              
            'nota_prod' => 'N.E.'
        ]);
    }
}
