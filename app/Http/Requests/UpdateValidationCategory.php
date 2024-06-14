<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateValidationCategory extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('categories','name')->ignore($this->categories),
                'max:30',
                'valid_name'
            ],
            'description' => 'required',
        ];

    }
    public function messages()
        {
            return [
                'name.valid_name' => 'The name must be letter, not special characters', 
            ];
        }
}
