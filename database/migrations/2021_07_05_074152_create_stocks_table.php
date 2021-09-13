<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();            
            
            $table->unsignedBigInteger('deposito_id');

            $table->string('cod_prod', 20)->unique();           
            $table->string('desc_prod', 150);
            $table->string('medida_prod', 50)->nullable();//PUEDE ESTAR VACIO O NO ;              
            $table->string('color_prod', 50);
            $table->string('um_prod', 50);
            $table->decimal('precio_prod', 8, 2);  
            $table->string('calidad_prod', 1);//B, M, A                         
            $table->integer('stock_prod')->unsigned(); //NO PERMITE VALORES NEGATIVOS;
            $table->string('foto_prod', 128)->nullable(); //PUEDE TENER O NO IMAGEN                           

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
        Schema::dropIfExists('stocks');
    }
}
