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
        Schema::create('equipaments', function (Blueprint $table) {
            $table->id();
            $table->string("cliente");
            $table->string("tipo");
            $table->string("marca");
            $table->text("defeito");
            $table->string("status")->default('Em Análise');
            $table->string("imagem")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipaments');
    }
};
