<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ComprovaContrasenya implements Rule
{

    /**
     * Comprova si les contrasenyes coincideixen.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Hash::check($value, auth()->user()->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "L'atribut :attribute amb la contrasenya antiga.";
    }
}
