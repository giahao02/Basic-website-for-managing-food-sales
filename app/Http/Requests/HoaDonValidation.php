<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HoaDonValidation extends FormRequest
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
            'ten' => 'required|valid_name',
            'email' => 'required',
            'sdt' => 'required',
            'tongtien'=> 'integer|min:0.00000001'
        ];
    }

    public function messages()
    {
        return [
            'ten.valid_name' => 'The name must be letter, not special characters',
            'tongtien.min' => 'Please chose food'
        ];
    }
}
