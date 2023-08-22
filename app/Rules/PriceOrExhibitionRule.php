<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PriceOrExhibitionRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if(empty($value['price']) || empty($value['exhibitions'])){
            $fail('Картина должна иметь цену или участвовать в выставке.');
        }
        dd($value);
    }
}
