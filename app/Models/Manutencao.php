<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manutencao extends Model
{
    use HasFactory;

    // Força o nome da tabela caso o Laravel tente pluralizar para o inglês
    protected $table = 'manutencoes'; 

    protected $fillable = [
        'equipamento_id',
        'tecnico',
        'data_entrada',
        'observacoes'
    ];

    // Relacionamento: Uma manutenção pertence a um equipamento
    public function equipamento()
    {
        // Se o seu model de equipamentos se chamar Equipament, use Equipament::class
        return $this->belongsTo(Equipament::class, 'equipamento_id'); 
    }
}