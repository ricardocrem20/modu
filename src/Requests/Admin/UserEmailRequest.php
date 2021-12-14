<?php

namespace Ricardo\Modu\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserEmailRequest extends FormRequest
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
        if ($this->method() === 'PUT') {
            $emailUnique = $emailUnique->ignore($this->user);
        }
        return [
            'email' => ['required', 'email', 'max:60', $emailUnique]
        ];
    }
}
