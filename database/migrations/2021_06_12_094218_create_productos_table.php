<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('compra_id'); //VENTA PARA UNA DETERMINADA CAJA                                      
            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedBigInteger('categoria_id');

            $table->string('cod_prod', 20)->nullable();//SE PUEDE REPETIR CODIGO DE ORIGEN           
            $table->string('desc_prod', 150);
            $table->integer('cant_prod')->unsigned(); //NO PERMITE VALORES NEGATIVOS;  
            $table->string('medida_prod', 50)->nullable();//PUEDE ESTAR VACIO O NO ;  
            $table->string('color_prod', 50);            
            $table->string('um_prod', 50);
            $table->decimal('precio_prod', 8, 2)->unsigned();                        
            $table->string('calidad_prod', 1);//B, M, A                     
            $table->string('foto_prod', 128)->default('noimage.png'); //SIN IMAGEN POR DEFECTO              
            $table->text('nota_prod', 128)->nullable(); //PUEDE TENER O NO NOTA DEL PRODUCTO   
            $table->boolean('ok_prod')->default(0); //SI PRODUCTO ESTA VERIFICADO Y COMPLETO            
            $table->boolean('ok_inv')->default(0); //SI PRODUCTO ESTA INVENTARIADO O NO            
            
            $table->foreign('compra_id')//RESTRICION DE COLUMNA
                ->references('id')
                ->on('compras')
                ->onDelete('cascade')
                ->onUpdate('cascade');            

            $table->foreign('proveedor_id')//RESTRICION DE COLUMNA
                ->references('id')
                ->on('proveedors')
                ->onDelete('cascade')
                ->onUpdate('cascade');  
                
            $table->foreign('categoria_id')//RESTRICION DE COLUMNA
                ->references('id')
                ->on('categorias')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
