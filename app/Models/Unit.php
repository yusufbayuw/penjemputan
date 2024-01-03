<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    use HasFactory;

    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class, 'unit_id', 'id');
    }
}
