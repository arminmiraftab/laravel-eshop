<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class commentRequest extends FormRequest
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
            'cate' => 'required|string|max:90|min:2',
            'tex' => 'required|string|max:255|min:4',
        ];
    }
    public function messages()
    {
        return [
            'cate.required' => trans('Validation.comment.subject.required'),
            'cate.max' => trans('Validation.comment.subject.max'),
            'cate.string' => trans('Validation.comment.subject.string'),
            'cate.min' =>  trans('Validation.comment.subject.min'),
            'tex.max' =>  trans('Validation.comment.description.max'),
            'tex.min' =>  trans('Validation.comment.description.min'),
            'tex.required' =>  trans('Validation.comment.description.required'),
            'tex.string' =>  trans('Validation.comment.description.string'),
        ];
    }

}
