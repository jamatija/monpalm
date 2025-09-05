<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VenueTypeRequest extends FormRequest
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
        $uniqueRule = Rule::unique('venue_types', 'name');
    
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $uniqueRule->ignore($this->route('venue-types'));
        }

        return [
            'name' => [
                'bail',
                'required',
                'string',
                'max:255',
                'filled', 
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
            'name.regex'    => 'Name cannot be empty or whitespace.',
            'name.unique'   => 'A venue type with this name already exists.',
        ];
    }
}
