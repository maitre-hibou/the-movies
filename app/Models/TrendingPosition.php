<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrendingPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id', 'period_type', 'period', 'position',
    ];

    public $timestamps = false;
}
