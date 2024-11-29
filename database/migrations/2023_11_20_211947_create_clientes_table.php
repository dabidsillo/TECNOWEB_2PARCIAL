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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string("ci");
            $table->foreign('id')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');
            // $table->unsignedBigInteger('id_persona');
            // $table->foreign('id_persona')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
