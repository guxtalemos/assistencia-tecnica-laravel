<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manutencoes', function (Blueprint $table) {
            $table->id();
            // A referenciada tabela é 'equipaments' de acordo com seu print
            $table->foreignId('equipamento_id')->constrained('equipaments')->onDelete('cascade');
            $table->string('tecnico');
            $table->date('data_entrada');
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manutencoes');
    }
};
