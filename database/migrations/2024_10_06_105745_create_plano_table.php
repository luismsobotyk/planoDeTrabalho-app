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
        Schema::create('plano', function (Blueprint $table) {
            $table->id();
            $table->string('situacao');
            $table->unsignedBigInteger('periodo_id');
            $table->unsignedBigInteger('revisado_por');
            $table->foreign('periodo_id')->references('id')->on('periodo');
            $table->foreign('revisado_por')->references('id')->on('usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plano');
    }
};
