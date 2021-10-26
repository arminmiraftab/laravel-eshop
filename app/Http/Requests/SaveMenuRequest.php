<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveMenuRequest extends FormRequest
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
            'namemen' => 'required|string|max:35',
            'linkmen' => 'required|string|max:90',
        ];
    }
    public function messages()
    {
        return [
            'namemen.required' => trans('Validation.menu.name.required'),
            'linkmen.required' => trans('Validation.menu.link.required'),
            'namemen.max' => trans('Validation.menu.name.max'),
            'linkmen.max' => trans('Validation.menu.link.max'),
            'namemen.string' =>trans('Validation.menu.name.string'),
            'linkmen.string' => trans('Validation.menu.link.string'),

        ];
    }



}
