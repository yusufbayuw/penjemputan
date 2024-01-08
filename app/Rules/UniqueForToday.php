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
            ->where(explode("." , $attribute)[1], $value);
        $count = $penjemputan->count();
        
        if ($count > 0) {
            $fail($penjemputan->first()->kartu->ortu->siswa[0]->nama.' sudah dijemput pada jam '. $penjemputan->first()->jam);
        }
    }
}
