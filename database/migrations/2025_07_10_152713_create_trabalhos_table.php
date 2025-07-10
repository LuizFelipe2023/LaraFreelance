<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabalhosTable extends Migration
{
    public function up()
    {
        Schema::create('trabalhos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->foreignId('user_id')->constrained('users'); 
            $table->enum('status', ['aberto', 'em_negociacao', 'fechado'])->default('aberto');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trabalhos');
    }
}
