<?php

namespace App\Rules;

use App\DocumentWordCount;
use Illuminate\Contracts\Validation\Rule;

class CountingWords implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $documents
     * @return bool
     */
    public function passes($attribute, $documents)
    {
        $doc = new DocumentWordCount;

        $sum = 0;

        foreach ($documents as $document) {
            $sum += $doc->countWords($document);
        }

        dd($sum);

        return $sum <= 20000;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'تعداد کلمات باید کمتر از ۲۰۰۰ باشد.';
    }
}
