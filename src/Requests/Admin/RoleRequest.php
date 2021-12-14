<?php

namespace Ricardo\Modu\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
        $roleUnique = Rule::unique('roles', 'role');
        $slugUnique = Rule::unique('roles', 'slug');

        if ($this->method() === 'PUT') {
            $roleUnique = $roleUnique->ignore($this->route('role'));
            $slugUnique = $slugUnique->ignore($this->route('role'));
        }

        return [
            'role'        => ['required', 'string', 'max:60', $roleUnique],
            'slug'        => ['required', 'string', 'max:70', $slugUnique],
            'tipos_roles' => ['required', 'array'],
            'modulos'     => ['nullable', 'array'],
            'descripcion' => ['nullable', 'string']
        ];
    }
}
