<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name_category' => 'required|string|max:90|nullable',
            'description_category' => 'string|nullable|max:65534',
            'category_id' => 'numeric|nullable',


        ];
    }
    public function messages()
    {
        return [
            'name_manufacture.required' => 'نام خودرا وارد کنید',
            'name_category.max' => 'کارکتر ها بیش از حد مجاز است ',
            'name_category.string' => 'لطفا نام خود را پر کنید',
            'description_manufacture.string' => 'لطفا توضیحات خود را په درستی وارد کنید',
            'description_manufacture.max' => 'کارکتر های توضیح بیش از حد مجاز است   ',

        ];
    }

}
