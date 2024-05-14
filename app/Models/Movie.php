<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title', 'release_date', 'tmdb_id', 'cover', 'poster', 'overview'
    ];

    public function trendingPositions(): HasMany
    {
        return $this->hasMany(TrendingPosition::class);
    }
}
