<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telemarketing extends Model
{
    use HasFactory;
    protected $fillable = ['data', 'cliente', 'telefone', 'agendamento', 'hora', 'teles', 'id_curso', 'id_user', 'id_funcionario'];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_curso');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'id_funcionario');
    }
}
