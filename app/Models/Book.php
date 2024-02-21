<?php

namespace App\Models;

use App\Enums\BookStatus;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author',
        'release_at',
        'publisher',
    ];

    protected $casts = [
        'release_at' => 'date',
    ];

    public function loans() : HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function activeLoan() : HasOne
    {
        return $this->hasOne(Loan::class)->whereNull('returned_at');
    }

    public function getStatusAttribute()
    {
        if($this->activeLoan === null) {
            return BookStatus::AVAILABLE;
        }

        if($this->activeLoan->end_at > Carbon::now()) {
            return BookStatus::UNAVAILABLE;
        }

        return BookStatus::NOT_RETURNED;
    }

    public function scopeSearch(Builder $query, $search)
    {
        $query->where(function ($query) use ($search) {
            $query->orWhere('name', 'like', "%{$search}%");
            $query->orWhere('author', 'like', "%{$search}%");
            $query->orWhereHas('activeLoan.client', function ($clientQuery) use ($search) {
                $clientQuery->orWhere('name', "%{$search}%");
                $clientQuery->orWhere('surname', "%{$search}%");
            });
        });

        return $query;
    }
}
