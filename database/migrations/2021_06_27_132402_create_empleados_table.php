<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->unique();//UN REGISTRO EN USERS Y UN REGISTRO EN EMPLEADOS
            $table->unsignedBigInteger('tienda_id');//UN REGISTRO EN USERS Y UN REGISTRO EN EMPLEADOS

            $table->string('ci_emp');
            $table->string('dir_emp', 100);
            $table->string('tel_emp',100);            
            $table->boolean('estado_emp')->defautl(false);//SI INGRESO AL SISTEMA O NO           
            $table->date('fecha_ing_emp')->nullable();//FECHA DE INGRESO A LA EMPRESA
            $table->decimal('sueldo_emp', 8, 2)->defautl(0); 
            $table->string('avatar')->default("default_avatar.png");     

            
            $table->foreign('user_id')//RESTRICION DE COLUMNA
                ->references('id')
                ->on('users')
                ->onDelete('cascade')//SE ELIMINA UN REGISTRO EN USER Y TAMBIEN SE ELIMINA UN REGISTRO EN EMPLEADO
                ->onUpdate('cascade');//LAS ACTUALIZACION SE REALIZAN TAMBIEN EN CASCADA

            $table->foreign('tienda_id')//RESTRICION DE COLUMNA
                ->references('id')
                ->on('tiendas')
                ->onDelete('cascade')//SE ELIMINA UN REGISTRO EN USER Y TAMBIEN SE ELIMINA UN REGISTRO EN EMPLEADO
                ->onUpdate('cascade');//LAS ACTUALIZACION SE REALIZAN TAMBIEN EN CASCADA    

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
        Schema::dropIfExists('empleados');
    }
}
