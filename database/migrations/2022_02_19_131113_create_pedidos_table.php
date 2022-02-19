<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->dateTime("fecha_pedido");
            $table->string("cod_factura", 20)->nullable();
            $table->integer("estado")->default(1); // 1: preceso, 2: completado, 3: cancelado, 4: pendiente
            // N:1
            $table->bigInteger("persona_id")->unsigned();
            $table->bigInteger("cliente_id")->unsigned();
            $table->foreign("persona_id")->references("id")->on("personas");
            $table->foreign("cliente_id")->references("id")->on("clientes");

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
        Schema::dropIfExists('pedidos');
    }
}
