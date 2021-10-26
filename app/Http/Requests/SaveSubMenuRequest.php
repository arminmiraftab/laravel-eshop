<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSubMenuRequest extends FormRequest
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
            'name_sub' => 'required|string|max:35',
            'link_sub' => 'required|string|max:90',
            'category_id' => 'required|numeric',

        ];
    }
    public function messages()
    {
        return [
            'name_sub.required' => trans('Validation.submenu.name_sub.required'),
            'link_sub.required' => trans('Validation.submenu.link_sub.required'),
            'name_sub.max' => trans('Validation.submenu.name_sub.max'),
            'link_sub.max' => trans('Validation.submenu.link_sub.max'),
            'name_sub.string' =>trans('Validation.submenu.name_sub.string'),
            'link_sub.string' => trans('Validation.submenu.link_sub.string'),
            'category_id.required' => trans('Validation.submenu.category_id.required'),
            'category_id.numeric' => trans('Validation.submenu.category_id.numeric'),
        ];
    }

}
