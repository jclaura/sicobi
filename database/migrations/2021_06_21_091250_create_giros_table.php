<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giros', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('compra_id');

            $table->date('fecha_giro')->nullable();  
            $table->decimal('monto_giro', 8, 2)->nullable(); 
            $table->decimal('comision_giro', 8, 2)->nullable();
            $table->decimal('docs_giro', 8, 2)->nullable();
            $table->decimal('itf_giro', 8, 2)->nullable();
            $table->decimal('extravio_giro', 8, 2)->nullable();

            $table->foreign('compra_id')//RESTRICION DE COLUMNA
                ->references('id')
                ->on('compras')
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
        Schema::dropIfExists('giros');
    }
}
