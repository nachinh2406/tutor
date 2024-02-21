<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckIfExistedPhotoCard implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public function __construct()
    {

    }


    public function passes($attribute, $value)
    {
        // if(is_null(optional($this->card)->photo_before ) && is_null($value) && $attribute == 'photo_before') return false;
        // if(is_null(optional($this->card)->photo_after ) && is_null($value) && $attribute == 'photo_after') return false;
        // return true;
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'photo is required';
    }
}
