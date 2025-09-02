<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MunicipalityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $uniqueRule = Rule::unique('municipalities', 'name');

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $uniqueRule->ignore($this->route('municipality'));
        }

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'not_regex:/^\s*$/',
                $uniqueRule,
            ],
        ];

    }

        public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'name.string'   => 'Name must be a string.',
            'name.max'      => 'Name cannot be longer than 255 characters.',
            'name.unique'   => 'A municipality with this name already exists.',
        ];
    }
}
