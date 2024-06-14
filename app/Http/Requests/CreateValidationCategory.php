<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateValidationCategory extends FormRequest
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
            'name' => 'required|unique:categories,name|valid_name|max:30',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.valid_name' => 'The name must be letter, not special characters', 
        ];
    }
}
