<?php

namespace Ricardo\Modu\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AreaRequest extends FormRequest
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
        $areaUnique = Rule::unique('areas', 'area');
        $urlUnique  = Rule::unique('areas', 'url');

        if ($this->method() === 'PUT') {
            $areaUnique = $areaUnique->ignore($this->route('area'));
            $urlUnique  = $urlUnique->ignore($this->route('area'));
        }

        return [
            'area'        => ['required', 'string', 'max:15', $areaUnique],
            'url'         => ['required', 'string', 'max:75', $urlUnique],
            'icono'       => ['required', 'string', 'max:50'],
            'orden'       => ['required', 'numeric'],
            'menu'        => ['required', 'boolean'],
            'descripcion' => ['nullable', 'string'],
            'modulo_id'   => ['required', 'numeric'],
        ];
    }
}
