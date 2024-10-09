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
        Schema::create('info_pessoais', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('categoria');
            $table->string('regime');
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
        Schema::dropIfExists('info_pessoais');
    }
};
