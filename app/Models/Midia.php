<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Midia extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nome'];
    protected $dates = ['deleted_at'];
}
