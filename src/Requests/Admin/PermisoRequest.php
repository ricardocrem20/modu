<?php

namespace Ricardo\Modu\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermisoRequest extends FormRequest
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
        $permisoUnique = Rule::unique('permisos', 'permiso');
        $slugUnique    = Rule::unique('permisos', 'slug');

        if ($this->method() === 'PUT') {
            $permisoUnique = $permisoUnique->ignore($this->route('permiso'));
            $slugUnique    = $slugUnique->ignore($this->route('permiso'));
        }

        return [
            'permiso'     => ['required', 'string', 'max:60', $permisoUnique],
            'slug'        => ['required', 'string', 'max:70', $slugUnique],
            'descripcion' => ['nullable', 'string'],
            'area_id'     => ['required', 'numeric'],
        ];
    }
}
