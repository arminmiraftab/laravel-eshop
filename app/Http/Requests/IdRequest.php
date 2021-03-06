<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdRequest extends FormRequest
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
            'id'=>'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'id.required' => trans('Validation.id.required'),
            'id.numeric' => trans('Validation.id.numeric'),
      
        ];
    }
}
