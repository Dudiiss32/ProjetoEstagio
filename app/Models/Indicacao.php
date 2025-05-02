<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicacao extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'data',
        'nome',
        'telefone',
        'lead_id', 
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
