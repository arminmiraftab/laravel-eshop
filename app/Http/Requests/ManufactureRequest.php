<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManufactureRequest extends FormRequest
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
            'name_manufacture' => 'required|string|max:90|min:2|nullable',
            'description_manufacture' => 'string|nullable|max:65534',
            'category_id' => 'numeric|nullable|max:65534',
        ];
    }
    public function messages()
    {
        return [
            'name_manufacture.required' => 'نام خودرا وارد کنید',
            'name_manufacture.max' => 'کارکتر ها بیش از حد مجاز است ',
            'name_manufacture.string' => 'لطفا نام خود را پر کنید',
            'description_manufacture.string' => 'لطفا توضحات خود را پر درست کنید',
            'description_manufacture.max' => 'کارکتر ها بیش از حد مجاز است ',

        ];
    }

}
