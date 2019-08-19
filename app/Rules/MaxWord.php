<?php

namespace App\Rules;

use App\DocumentWordCount;
use App\Setting;
use Illuminate\Contracts\Validation\Rule;

class MaxWord implements Rule
{
    protected $wordCount = 0;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param          $documents
     *
     * @return bool
     */
    public function passes($attribute, $documents)
    {
        $this->wordCount = DocumentWordCount::files($documents)->countWords();

        return $this->wordCount <= (int) Setting::first()->upload_words_per_day;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'تعداد کلمات بایستی کمتر از' . $this->wordCount . 'باشد.';
    }
}
