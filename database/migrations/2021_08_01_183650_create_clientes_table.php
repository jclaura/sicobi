<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();

            $table->string('nom_cli', 150);
            $table->string('doc_cli', 20)->nullable();//PUEDE ESTAR VACIO O NO ; 
            $table->string('tel_cli', 50)->nullable();//PUEDE ESTAR VACIO O NO ;              
            $table->string('ciudad_cli', 50)->default('La Paz');
            $table->text('pref_cli')->nullable();//TEXTO
            
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
        Schema::dropIfExists('clientes');
    }
}
