<?php

namespace Ricardo\Modu\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $identificacionUnique  = Rule::unique('users', 'identificacion');
        $emailUnique = Rule::unique('users', 'email');

        if ($this->method() === 'PUT') {
            $identificacionUnique  = $identificacionUnique->ignore($this->route('user'));
            $emailUnique = $emailUnique->ignore($this->route('user'));
        }

        return [
            'tipo_identificacion' => ['nullable', 'string'],
            'identificacion'      => ['nullable', 'string', $identificacionUnique],
            'nombres'             => ['required', 'string', 'max:45'],
            'apellidos'           => ['required', 'string', 'max:45'],
            'email'               => ['required', 'string', 'max:60', $emailUnique],
        ];
    }
}
