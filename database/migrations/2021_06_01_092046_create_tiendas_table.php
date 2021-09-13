<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiendas', function (Blueprint $table) {
            $table->id();

            $table->string('nom_tienda', 20);
            $table->string('dir_tienda', 150);
            $table->string('ciudad_tienda', 10)->default('La Paz');

            $table->date('fecha_ini_tienda')->nullable();//PUEDE ESTAR VACIO O NO ;                           

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
        Schema::dropIfExists('tiendas');
    }
}
