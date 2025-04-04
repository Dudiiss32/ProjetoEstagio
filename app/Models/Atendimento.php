<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atendimento extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['data','id_funcionario', 'cliente', 'telefone', 'matricula', 'observacao', 'id_midia', 'id_curso'];
    protected $dates = ['deleted_at'];

    public function funcionario()
    {
        return $this->belongsTo(User::class, 'id_funcionario');
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
