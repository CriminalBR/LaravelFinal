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
    Schema::create('instituicaos', function (Blueprint $table) {
        $table->id();

        // Cria a "ponte" para a tabela de usuários
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        // Informações específicas da instituição
        $table->string('cnpj')->unique()->nullable(); // unique = nenhum cnpj pode ser igual
        $table->string('telefone')->nullable();
        $table->text('endereco')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instituicaos');
    }
};
