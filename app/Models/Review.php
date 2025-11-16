<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating_id',
        'comment',
    ];

    public function rating(): BelongsTo
    {
        return $this->belongsTo(Rating::class);
    }
}
