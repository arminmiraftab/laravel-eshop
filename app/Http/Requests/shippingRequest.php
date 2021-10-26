<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class shippingRequest extends FormRequest
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
            'adderss' => 'required|string|max:90',
            'adderss_hand' => 'required|string|max:90',
            'plak' => 'required|numeric|max:1000',
            'unit' => 'required|numeric|max:1000',
            'post' => 'required|numeric|max:1000000000000',

        ];
    }
    public function messages()
    {
        return [
            'adderss.required' => 'ادرس روی نقشه مشخص کنید ',
            'adderss_hand.required' => 'ادرس روی نقشه مشخص کنید ',
            'adderss_hand.string' => 'بافرمت متن وارد کنید ',
            'adderss_hand.max' => 'کارکتر ها بیش از حد مجاز است   ',
            'plak.required' => 'ادرس روی نقشه مشخص کنید ',
            'plak.numeric' => 'بافرمت عدد وارد کنید ',
            'unit.required' => 'ادرس روی نقشه مشخص کنید ',
            'unit.numeric' => 'بافرمت عدد وارد کنید ',
            'post.required' => 'ادرس روی نقشه مشخص کنید ',
            'post.numeric' => 'بافرمت عدد وارد کنید',
            'adderss.string' => 'بافرمت متن وارد کنید',
            'adderss_hand.numeric' => 'بافرمت متن وارد کنید',
            'adderss.max' => 'کارکتر ها بیش از حد مجاز است',
            'plak.max' => 'کارکتر ها بیش از حد مجاز است',
            'unit.max' => 'کارکتر ها بیش از حد مجاز است',
            'post.max' => 'کارکتر ها بیش از حد مجاز است',

        ];
    }

}
