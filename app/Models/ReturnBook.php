<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReturnBook extends Model
{
    use HasFactory;

    protected $table = 'return_books';

    protected $fillable = [
        'loan_id',
        'librarian_id',
        'return_date',
    ];

    protected function casts(): array
    {
        return [
            'return_date' => 'datetime',
        ];
    }

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

    public function librarian(): BelongsTo
    {
        return $this->belongsTo(User::class, 'librarian_id');
    }
}
