<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DniRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    // Implementa los métodos requeridos por la interfaz Rule
    public function passes($attribute, $value)
    {
        // Verificar que el valor tenga 7 a mas caracteres numéricos
        if (!preg_match('/^\d{7,}$/', $value)) {
            return false;
        }

        // Verificar el algoritmo de validación del DNI (opcional)
        // Aquí puedes implementar la lógica específica de validación del DNI, si es necesario

        return true;
    }

    public function message()
    {
        // Define el mensaje de error para la regla de validación personalizada
        return 'The :attribute is not a valid DNI.';
    }
}
