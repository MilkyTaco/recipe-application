<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProceduresRequest extends FormRequest
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
            '*.step_count' => ['bail', 'integer', 'required'],
            '*.description' => ['required', 'max:255'],
            '*.duration' => ['integer', 'required'],
        ];
    }
}
