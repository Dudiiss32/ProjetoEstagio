<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funcionario extends Model
{
    use HasFactory, SoftDeletes;

    //Indicar o nome da tabela
    // protected $table = 'funcionario';

    protected $fillable = ['data', 'id_user', 'metaTele', 'metaMatricula', 'metaIndicacoes', 'tempoTele', 'tempoLead'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
