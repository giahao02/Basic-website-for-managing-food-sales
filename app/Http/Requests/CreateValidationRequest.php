<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateValidationRequest extends FormRequest
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
            'name' => 'required|unique:Food,name|valid_name|max:100',
            'count' => 'required|integer|min:0|max:1000',
            'categories_id' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,bmp'
        ] 
        ;
    }

            public function messages()
        {
            return [
                'name.valid_name' => 'The name must be letter, not special characters', 
            ];
        }

}
