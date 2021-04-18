<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
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
            'title' => ['bail', 'required', 'max:255'],
            'user_id' => ['integer', 'required'],
            'ingredients_id' => ['integer', 'required'],
            'steps_id' => ['integer', 'required'],
            'categories_id' => ['integer', 'required'],
            'description' => ['bail', 'required', 'max:255'],
            'total_duration' => ['integer', 'required']
        ];
    }
}
