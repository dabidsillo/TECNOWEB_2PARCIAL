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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->integer('precio');
            $table->string('imagen')->nullable();;
            $table->integer('stock')->nullable();;
            $table->bigInteger('id_categoria');
            $table->bigInteger('id_promocion')->nullable();

            $table->foreign('id_categoria')->references('id')->on('categoria')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_promocion')->references('id')->on('promociones')->nullOnDelete('cascade')->onUpdate('cascade');
            
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
