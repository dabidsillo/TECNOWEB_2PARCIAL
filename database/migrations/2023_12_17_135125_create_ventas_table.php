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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->default(now());
            $table->time('hora')->default(now());
            $table->integer('total');
            $table->bigInteger('id_servicio')->nullable();
            $table->bigInteger('id_cliente');

            $table->foreign('id_servicio')->references('id')->on('servicios')->nullOnDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
