<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_at',
        'end_at',
        'returned_at',
        'user_id',
        'book_id'
    ];

    protected $casts = [
        'start_at' => 'date',
        'end_at' => 'date',
        'returned_at' => 'date',
    ];

    public function client() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book() : BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
