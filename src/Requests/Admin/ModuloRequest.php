<?php

namespace Ricardo\Modu\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModuloRequest extends FormRequest
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
        $moduloUnique = Rule::unique('modulos', 'modulo');
        $urlUnique    = Rule::unique('modulos', 'url');

        if ($this->method() === 'PUT') {
            $moduloUnique = $moduloUnique->ignore($this->route('modulo'));
            $urlUnique    = $urlUnique->ignore($this->route('modulo'));
        }

        return [
            'modulo'      => ['required', 'string', 'max:15', $moduloUnique],
            'url'         => ['required', 'string', 'max:75', $urlUnique],
            'icono'       => ['required', 'string', 'max:50'],
            'orden'       => ['required', 'numeric'],
            'descripcion' => ['nullable', 'string']
        ];
    }
}
