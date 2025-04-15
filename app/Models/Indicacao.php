<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicacao extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nome',
        'telefone',
        'lead_id', 
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
