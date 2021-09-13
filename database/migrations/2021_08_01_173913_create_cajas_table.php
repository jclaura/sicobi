<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->id();

            $table->string('tienda_id'); //QUE TIENDA ES
            $table->string('empleado_id'); //QUIEN ABRIO LA CAJA

            $table->date('fecha_apertura_caja'); //CUANDO SE ABRIO LA CAJA  
            $table->time('hora_apertura_caja'); //A QUE HORA SE ABRIO LA CAJA  
            $table->date('fecha_cierre_caja')->nullable(); //CUANDO SE ABRIO LA CAJA  
            $table->time('hora_cierre_caja')->nullable(); //A QUE HORA SE ABRIO LA CAJA 
            $table->decimal('saldo_caja', 8, 2)->default(0);   
            $table->decimal('venta_caja', 8, 2)->default(0);   
            $table->decimal('ingresos_caja', 8, 2)->default(0);   
            $table->decimal('egresos_caja', 8, 2)->default(0);               
            $table->decimal('efectivo_caja', 8, 2)->default(0);              
            $table->text('nota_caja')->nullable(); //ALGUNA NOTA SOBRE APERTURA Y CIERRE DE CAJA     
            $table->boolean('activo_caja')->default(0); //CAJA: 0->CERRADO,  1->ABIERTO             
            
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
        Schema::dropIfExists('cajas');
    }
}
