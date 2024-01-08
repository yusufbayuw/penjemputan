<?php

namespace App\Rules;

use App\Models\Penjemputan;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueForToday implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $penjemputan = Penjemputan::whereDate('created_at', Carbon::today())
            ->where($attribute, $value);
        $count = $penjemputan->count();
        
        if ($count > 0) {
            $fail($penjemputan->first()->ortu->siswa->nama.' sudah dijemput.');
        }
    }
}
