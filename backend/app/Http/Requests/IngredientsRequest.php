<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngredientsRequest extends FormRequest
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
        return [
            '*.name' => ['bail', 'required', 'max:255'],
            '*.amount' => ['between:0,99.99', 'required'],
            '*.measuring_instrument' => ['bail', 'required', 'max:255'],
        ];
    }
}
