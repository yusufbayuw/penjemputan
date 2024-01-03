<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kartu extends Model
{
    use HasFactory;

    public function ortu(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ortu_id', 'id');
    }

    public function penjemputan(): HasMany
    {
        return $this->hasMany(Penjemputan::class, 'kartu_id', 'id');
    }
}
