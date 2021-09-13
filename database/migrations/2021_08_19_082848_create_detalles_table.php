<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('venta_id');////A QUE VENTA CORRESPONDE     
                    
            $table->string('cod_prod_det', 20); // QUE PRODUCTO SE VENDIO            
            $table->integer('cant_det');//CUANTO SE VENDIO 
            $table->string('um_det', 50);
            $table->string('desc_det');//DESCRIPCION DEL PRODUCTO                          
            $table->decimal('precio_det', 8, 2);  //PRECIO PRODUCTO      

            
            
            $table->foreign('venta_id')//RESTRICION DE COLUMNA
                ->references('id')
                ->on('ventas')
                ->onDelete('cascade')//SE ELIMINA UN REGISTRO EN USER Y TAMBIEN SE ELIMINA UN REGISTRO EN EMPLEADO
                ->onUpdate('cascade');//LAS ACTUALIZACION SE REALIZAN TAMBIEN EN CASCADA

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
        Schema::dropIfExists('detalles');
    }
}
