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
    Schema::create('estoques', function (Blueprint $table) {
        $table->id();

        // A qual instituição pertence este item de estoque?
        $table->foreignId('instituicao_id')->constrained('instituicaos')->onDelete('cascade');

        // Item
        $table->string('nome_item');
        $table->integer('quantidade');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoques');
    }
};
