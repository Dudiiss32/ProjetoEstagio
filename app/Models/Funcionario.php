<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    //Indicar o nome da tabela
    // protected $table = 'funcionario';

    protected $fillable = ['id_user', 'metaTele', 'metaMatricula', 'comissao'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
