<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('deposito_id');                                                  

            $table->integer('estante_gru')->unsigned();          
            $table->integer('fila_estante_gru')->unsigned();
            $table->char('tipo_prod_gru')->default('A');//A-B-C   
            $table->string('codprod_gru', 20);  
            $table->string('etiqueta_gru', 50)->nullable();//FOTO DE LA ETIQUETA            
            $table->boolean('rotulo_gru')->default(0);//SI ESTA O NO INVENTARIADO
            $table->text('nota_gru')->nullable();                                    
            
            $table->foreign('deposito_id')//RESTRICION DE COLUMNA
                ->references('id')
                ->on('depositos')
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
        Schema::dropIfExists('grupos');
    }
}
