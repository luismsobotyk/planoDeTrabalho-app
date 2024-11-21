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
        Schema::create('comentario', function (Blueprint $table) {
            $table->id();
            $table->text('texto');
            $table->boolean('resolvido')->default(false);
            $table->string('cadastrado_por');
            $table->unsignedBigInteger('plano_id');
            $table->foreign('cadastrado_por')->references('login')->on('usuario');
            $table->foreign('plano_id')->references('id')->on('plano');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentario');
    }
};
