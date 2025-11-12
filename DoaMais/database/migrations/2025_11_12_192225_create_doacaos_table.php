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
    Schema::create('doacaos', function (Blueprint $table) {
        $table->id();

        // Quem doou?
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

        // Para qual instituição?
        // nullable() e constrained() separados para poder apontar para a tabela 'instituicaos'
        $table->unsignedBigInteger('instituicao_id');
        $table->foreign('instituicao_id')->references('id')->on('instituicaos')->onDelete('cascade');

        // O que foi doado?
        $table->string('descricao_item');
        $table->integer('quantidade');
        $table->string('status')->default('pendente'); // ex: pendente, aprovado, recolhido, cancelado

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doacaos');
    }
};
