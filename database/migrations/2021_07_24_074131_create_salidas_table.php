<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas', function (Blueprint $table) {
            $table->id();   
            
            $table->unsignedBigInteger('stock_id');
            $table->unsignedBigInteger('tienda_id');

            $table->date('fecha_sal');                       
            $table->string('codprod_sal', 12);  
            $table->integer('cantprod_sal')->unsigned(); //NO PERMITE VALORES NEGATIVOS; 
            $table->decimal('precio_sal', 8, 2)->unsigned(); 
            $table->decimal('precio_ven', 8, 2)->unsigned(); 

            $table->foreign('stock_id')//RESTRICION DE COLUMNA
                ->references('id')
                ->on('stocks')
                ->onDelete('cascade')
                ->onUpdate('cascade');  
            
            $table->foreign('tienda_id')//RESTRICION DE COLUMNA
                ->references('id')
                ->on('tiendas')
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
        Schema::dropIfExists('salidas');
    }
}
