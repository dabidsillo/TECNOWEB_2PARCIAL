<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nota_ingresos', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->integer('total');
            $table->dateTime('fecha')->default(now());
            $table->integer('costo');
            $table->bigInteger('id_inventario');
            $table->bigInteger('id_proveedor');
            $table->bigInteger('id_personal');

            $table->foreign('id_inventario')->references('id')->on('inventarios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_proveedor')->references('id')->on('proveedores')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_personal')->references('id')->on('personales')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_ingresos');
    }
};
