<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('candidaturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('trabalho_id')->constrained()->onDelete('cascade');

            $table->string('nome');
            $table->string('email');
            $table->string('telefone')->nullable();
            $table->string('endereco')->nullable();
            $table->string('escolaridade')->nullable();

            $table->text('experiencia')->nullable();
            $table->text('formacoes')->nullable();
            $table->text('mensagem')->nullable();

            $table->string('anexo')->nullable(); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidaturas');
    }
};
