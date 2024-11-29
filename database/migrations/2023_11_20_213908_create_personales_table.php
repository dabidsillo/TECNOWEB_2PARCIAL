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
        Schema::create('personales', function (Blueprint $table) {
            $table->id();
            $table->string("profesion");
            $table->foreign('id')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personales');
    }
};
