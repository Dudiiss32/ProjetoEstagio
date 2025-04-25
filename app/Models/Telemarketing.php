<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Telemarketing extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['data', 'cliente', 'telefone', 'agendamento', 'hora', 'id_user','id_lead'];
    protected $dates = ['deleted_at', 'data', 'agendamento'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
    
}
