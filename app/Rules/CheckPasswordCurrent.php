<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CheckPasswordCurrent implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $guard;
    public function __construct($guard)
    {
        $this->guard = $guard;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($this->guard == 'admin') return Hash::check($value, Auth::guard("admin")->user()->password);
        if($this->guard == 'web') return Hash::check($value, auth()->user()->password);
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Mật khẩu hiện tại không chính xác.';
    }
}
