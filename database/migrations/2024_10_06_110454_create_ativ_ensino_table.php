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
        Schema::create('ativ_ensino', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('descricao');
            $table->float('carga_horaria');
            $table->unsignedBigInteger('plano_id');
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
        Schema::dropIfExists('ativ_ensino');
    }
};
