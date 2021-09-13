<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocktiendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocktiendas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('tienda_id'); //SOTKC DE UNA DETERMINADA TIENDA    
            $table->unsignedBigInteger('categoria_id');                                              

            $table->string('cod_prod', 20);//SE PUEDE REPETIR CODIGO DE PRODUCTO           
            $table->string('desc_prod', 150);             
            $table->string('medida_prod', 50)->nullable();//PUEDE ESTAR VACIO O NO ;  
            $table->string('color_prod', 50);            
            $table->string('um_prod', 50);
            $table->decimal('precio_prod', 8, 2)->unsigned(); //NO PERMITE VALORES NEGATIVOS;                         
            $table->integer('stock_prod')->unsigned(); //NO PERMITE VALORES NEGATIVOS;             
            $table->string('foto_prod', 128)->default('noimage.png'); //SIN IMAGEN POR DEFECTO      
            
            $table->foreign('tienda_id')//RESTRICION DE COLUMNA
            ->references('id')
            ->on('tiendas')
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
        Schema::dropIfExists('stocktiendas');
    }
}
