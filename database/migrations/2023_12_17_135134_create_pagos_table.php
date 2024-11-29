<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('detalle');
            $table->date('fecha')->default(now());
            $table->time('hora')->default(now());//hora
            $table->string('tipo');
            $table->string('estado')->default('pendiente');
            $table->bigInteger('id_venta');

            $table->foreign('id_venta')->references('id')->on('ventas')->onDelete('cascade')->onUpdate('cascade');

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
