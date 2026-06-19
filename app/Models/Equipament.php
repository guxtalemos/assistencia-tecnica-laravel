<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipament extends Model
{
    use HasFactory;

    protected $casts = [
       
        'date' => 'datetime:d/m/Y'
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function manutencoes()
    {
        return $this->hasMany(Manutencao::class, 'equipamento_id');
    }
}
