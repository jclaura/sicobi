<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('producto_id');

            $table->date('fecha_ent');                       
            $table->string('codprod_ent', 12);  
            $table->integer('cantprod_ent')->unsigned(); //NO PERMITE VALORES NEGATIVOS; 
            $table->decimal('precio_ent', 8, 2)->unsigned();                          
            
            $table->foreign('producto_id')//RESTRICION DE COLUMNA
                ->references('id')
                ->on('productos')
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
        Schema::dropIfExists('entradas');
    }
}
