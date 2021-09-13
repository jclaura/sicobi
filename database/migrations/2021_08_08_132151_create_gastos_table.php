<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('caja_id'); //VENTA PARA UNA DETERMINADA CAJA              
            $table->decimal('monto_gas', 8, 2)->default(0);  //GASTOS, ALMUERZO, TE, ETC, DEL DIA  
            $table->string('desc_gas')->default('Sin datos');   

            $table->foreign('caja_id')//RESTRICION DE COLUMNA
                ->references('id')
                ->on('cajas')
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
        Schema::dropIfExists('gastos');
    }
}
