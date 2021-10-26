<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RuleRequest extends FormRequest
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
            'name' => 'required|string|max:90',
            'user_nid' =>['numeric','nullable','max:9223372036854775807',
                Rule::unique('users','National_Code')->ignore($this->id)],
            'phone' => 'numeric|nullable|max:9223372036854775807',
            'last_name' => 'string|nullable|max:90',
            'rule_id' => 'numeric|nullable|max:10000',
            'email' => ['required','email','string','max:90',
                Rule::unique('users')->ignore($this->id)],
            'password' => 'string|nullable|confirmed',

        ];
    }
    public function messages()
    {
        return [
            'rule_id.numeric' => 'داده دست کاری شده است لطفا دوباره امتحان کنید',
            'name.required' => 'نام خودرا وارد کنید',
            'name.max' => 'کارکتر ها بیش از حد مجاز است  ',
            'name.string' => 'لطفا نام خود را پر کنید',
            'user_nid.unique' => 'شماره ملی قبلا وجود دارد',
            'user_nid.max' => 'کارکتر ها بیش از حد مجاز است ',
            'user_nid.numeric' => 'شماره خود را به درستی وارد نمایید',
            'phone.numeric' => 'شماره خود را به درستی وارد نمایید',
            'phone.max' => 'کارکتر ها بیش از حد مجاز است ',
            'last_name.required' => ' نام خانوادگی خودرا وارد کنید',
            'email.max' => 'کارکتر ها بیش از حد مجاز است ',
            'email.required' => ' ایمیل خودرا وارد کنید',
            'email.email' => 'بافرمت ایمیل وارد کنید',
            'email.unique' => 'ایمیل قبلا وجود دارد',
            'password.max' => 'کارکتر ها بیش از حد مجاز است ',
            'password.min' => 'پسورد کمتر از 6 کاراکتر است',
            'password.confirmed' => 'تایید پسورد ها با هم مطابقت نداد',
        ];
    }

}
