<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    //Indicar o nome da tabela
    // protected $table = 'funcionario';

    protected $fillable = ['nome', 'metaTele', 'metaMatricula', 'comissao', 'valorComissao'];
}
