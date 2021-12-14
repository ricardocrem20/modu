<?php

namespace Ricardo\Modu\Requests\ApiAuth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $emailUnique = Rule::unique('users', 'email');
        return [
            'nombre'   => ['required', 'string', 'max:45'],
            'email'    => ['required', 'email', 'max:60', $emailUnique],
            'password' => ['required', 'string', 'min:6', 'max:45']
        ];
    }
}
