<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemvarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systemvars', function (Blueprint $table) {
            $table->id();

            $table->string('nom_empresa_sys', 50)->nullable();              
            $table->string('desc_empresa_sys', 50)->nullable();   
            $table->decimal('tipo_cambio_sys', 8, 2)->unsigned(); 
            $table->integer('utilidad_sys')->unsigned(); 
            $table->decimal('iva_sys', 8, 2)->unsigned();  
            $table->decimal('it_sys', 8, 2)->unsigned();             
            $table->string('logo_empresa_sys', 128)->default('noimage.png'); //SIN IMAGEN POR DEFECTO 
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
        Schema::dropIfExists('systemvars');
    }
}
