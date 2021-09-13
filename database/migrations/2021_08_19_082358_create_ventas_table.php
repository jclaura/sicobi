<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('caja_id'); //VENTA PARA UNA DETERMINADA CAJA   
            $table->unsignedBigInteger('cliente_id'); //0 PARA CLIENTE EVENTUAL  

            $table->date('fecha_ven');//FECHA DE VENTA
            $table->time('hora_ven'); //HORA DE VENTA
            $table->string('doc_ven', 15)->default('Sin datos')->nullable();//NIT/CI/RECIBO/SIN DATOS            
            $table->decimal('total_ven', 8, 2)->default(0);  //TOTAL PAGADO                    
            $table->decimal('rebaja_ven', 8, 2)->default(0); //REBAJA SI HUBO            
            $table->integer('tipo_pago_ven')->default(1); //FORMA DE PAGO 1=EFECTIVO. 2=TRANSFERENCIA. 3=TARJETA. 4=CREDITO                        
            
            $table->foreign('caja_id')//RESTRICION DE COLUMNA
                ->references('id')
                ->on('cajas')
                ->onDelete('cascade')
                ->onUpdate('cascade');

                $table->foreign('cliente_id')//RESTRICION DE COLUMNA
                ->references('id')
                ->on('clientes')
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
        Schema::dropIfExists('ventas');
    }
}
