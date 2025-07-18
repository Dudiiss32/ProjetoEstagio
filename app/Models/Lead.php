<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['data','id_user', 'cliente', 'telefone', 'matricula', 'observacao', 'indicacao_nome', 'indicacao_telefone', 'id_midia', 'id_curso'];
    protected $dates = ['deleted_at', 'data'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function midia()
    {
        return $this->belongsTo(Midia::class, 'id_midia');
    }
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_curso');
    }
    public function indicacoes()
    {
        return $this->hasMany(Indicacao::class);
    }
    public function telemarketing()
    {
        return $this->hasOne(Telemarketing::class, 'id_lead');
    }

    public function scopeDeUsuarios($query, $userInput){
        return $query->whereHas('user', function ($q) use ($userInput){
            $q->where('name', 'LIKE', '%'. $userInput . '%' );
        });
    }

    public function scopeDeMidias($query, $midiaId){
        return $query->where('id_midia', $midiaId);
    }
}
