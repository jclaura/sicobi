<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();

            $table->date('fecha_com');           
            $table->decimal('tipo_com', 8,2);            
            $table->integer('items_com')->default(0)->unsigned(); //NO PERMITE VALORES NEGATIVOS;  
            $table->string('moneda_com', 10)->default('Yuan');             
            $table->string('pais_com', 10)->default('China'); ;
            $table->string('comprador_com', 50)->nullable();      
            
            $table->boolean('pagos_com')->default(0); //SI FINALIZO O NO LOS PAGOS            
            $table->boolean('giros_com')->default(0); //SI FINALIZO O NO LOS GIROS                                  

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
        Schema::dropIfExists('compras');
    }
}
