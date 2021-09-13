<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('compra_id'); 
            
            $table->date('fecha_pago')->nullable();  
            $table->decimal('monto_pago', 8, 2);            
            $table->string('desc_pago', 150);
            $table->text('nota_pago', 128)->nullable(); //PUEDE TENER O NO NOTA DE PAGO
            
            $table->foreign('compra_id')//RESTRICION DE COLUMNA
                ->references('id')
                ->on('compras')
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
        Schema::dropIfExists('pagos');
    }
}
