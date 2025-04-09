<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicacao extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nome',
        'telefone',
        'atendimento_id', // opcional, mas bom incluir se for setado manualmente
    ];

    public function atendimento()
    {
        return $this->belongsTo(Atendimento::class);
    }
}
