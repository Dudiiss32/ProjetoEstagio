<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtendimentoModel extends Model
{
    use HasFactory;

    protected $fillable = ['data','id_funcionario', 'midia', 'cliente', 'telefone', 'curso', 'matricula', 'observacao', 'id_midia', 'id_curso'];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'id_funcionario');
    }
    public function midia()
    {
        return $this->belongsTo(Midia::class, 'id_midia');
    }
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_curso');
    }
}
