<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Telemarketing extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['data', 'cliente', 'telefone', 'agendamento', 'hora', 'teles', 'id_user'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
}
