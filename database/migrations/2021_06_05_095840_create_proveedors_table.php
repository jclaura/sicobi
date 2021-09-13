<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();

            $table->string('emp_prov')->unique();//NOMBRE DE LA EMPRESA           
            $table->string('tel_prov');
            $table->string('dir_prov')->nullable();//DIRECCION DEL PROVEEDOR              
            $table->string('web_prov')->nullable();
            $table->string('email_prov')->nullable();
            $table->string('pais_prov', 15);//PAIS DONDE RESIDE             
            $table->text('prod_prov')->nullable(); //LISTA DE PRODUCTOS QUE OFRECE LA EMPRESA            
            $table->string('contacto_prov')->nullable(); //FOTO DE TARJETA DE CONTACTO            

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
        Schema::dropIfExists('proveedors');
    }
}
