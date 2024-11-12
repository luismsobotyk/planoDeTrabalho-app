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
            $table->id()->autoIncrement();
            $table->string('situacao');
            $table->unsignedBigInteger('periodo_id');
            $table->string('docente_id');
            $table->string('revisado_por')->nullable()->default(null);
            $table->foreign('periodo_id')->references('id')->on('periodo');
            $table->foreign('docente_id')->references('login')->on('usuario');
            $table->foreign('revisado_por')->references('login')->on('usuario');
            $table->timestamps();
            $table->softDeletes();
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
