<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 08.09.2021
 * Time: 22:54
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'category' => [
        'name'=>[
            'required'=>'نام دسته راوارد کنید ',
            'max'=>'کارکتر ها بیش از حد مجاز است ',
            'string'=>'لطفا نام خود را پر کنید',
        ],
        'description'=>[
            'max'=>'کارکتر ها بیش از حد مجاز است ',
        ],
    ],
    'comment' => [
        'success' => 'نظر شما باموفقیت ثبت ومنتظره تایید کارشناس است',
        'subject'=>[
            'required'=>'موضوع خود راوارد کنید ',
            'max'=>'کارکتر ها بیش از حد مجاز است ',
            'string'=>'لطفا به صورت درست  پر کنید',
            'min'=>'کارکتر ها کم تر از حد مجاز است ',
        ],
        'description'=>[
            'min'=>'کارکتر ها کم تر از حد مجاز است ',
            'required'=>'توضیحات خود راوارد کنید ',
            'max'=>'کارکتر ها بیش از حد مجاز است ',
            'string'=>'لطفا به صورت درست  پر کنید',            ],
    ],
    'id' => [

            'required'=>'ایدی خود راموجود نیست ',
            'numeric'=>'لطفا به صورت عددارسال کنید ',
    ],
    'manufacture' => [
        'success' => 'نظر شما باموفقیت ثبت ومنتظره تایید کارشناس است',
            'name'=>[
                'required'=>'برند خود راوارد کنید ',
                'max'=>'کارکتر ها بیش از حد مجاز است ',
                'string'=>'لطفا به صورت درست  پر کنید',
                'min'=>'کارکتر ها کم تر از حد مجاز است ',
            ],
            'description'=>[
                'min'=>'کارکتر ها کم تر از حد مجاز است ',
                'required'=>'توضیحات خود راوارد کنید ',
                'max'=>'کارکتر ها بیش از حد مجاز است ',
                'string'=>'لطفا به صورت درست  پر کنید',
                ],
            'category_id'=>[
                'required'=>'توضیحات خود راوارد کنید ',
                'max'=>'کارکتر ها بیش از حد مجاز است ',
                'numeric'=>'لطفا به صورت عدد  پر کنید',
                ],
        ],
    'address' => [
        'empty' => 'ادرس وارد کنید',
               ],
    'menu' => [
            'name' => [
                'required' => 'اسم منو وارد کنید',
                'max'=>'کارکتر ها بیش از حد مجاز است ',
                'string'=>'لطفا به صورت درست  پر کنید',
                   ],
             'link' => [
                 'required' => 'لینک منو وارد کنید',
                 'max'=>'کارکتر ها بیش از حد مجاز است ',
                 'string'=>'لطفا به صورت درست  پر کنید',
                   ],
              ],
    'submenu' => [
                'name_sub' => [
                    'required' => 'اسم منو وارد کنید',
                    'max'=>'کارکتر ها بیش از حد مجاز است ',
                    'string'=>'لطفا به صورت درست  پر کنید',
                       ],
                'link_sub' => [
                     'required' => 'لینک منو وارد کنید',
                     'max'=>'کارکتر ها بیش از حد مجاز است ',
                     'string'=>'لطفا به صورت درست  پر کنید',
                       ],
                'category_id' => [
                    'required'=>'ایدی خود راموجود نیست ',
                    'numeric'=>'لطفا به صورت عددارسال کنید ',
                       ],
                  ],
    'slider' => [
                'subcat' => [
                    'required' => 'سرموضوع خودرا وارد کنید',
                    'max'=>'کارکتر سرموضوع بیش از حد مجاز است ',
                    'string'=>'لطفا سرموضوع به صورت درست  پر کنید',
                       ],
                'cat' => [
                     'required' => 'لینک موضوع  وارد کنید',
                     'max'=>'کارکتر موضوع بیش از حد مجاز است',
                     'string'=>'لطفاموضوع به صورت درست  پر کنید',
                       ],
                'submit_link' => [
                     'max'=>'کارکتر توتضیحات بیش از حد مجاز است ',
                     'string'=>'لطفا به صورت درست  پر کنید',
                       ],
                'image_Product' => [
                     'required' => 'عکس  خودرا وارد کنید',
                     'image'=>'فایل را به صورت عکس وارد کنید',
                     'mimes'=>'فایل را با فرمت عکس وارد کنید',
                       ],
                'alt' => [
                    'required' => 'alt خودرا وارد کنید',
                    'max'=>'کارکتر alt بیش از حد مجاز است ',
                    'string'=>'لطفا به صورت درست  پر کنید',

                ],
                'write' => [
                    'max'=>'کارکتر توتضیحات بیش از حد مجاز است ',
                    'string'=>'لطفا به صورت درست  پر کنید',
                       ],
                  ],
    'user' => [

        'unique' =>'کاربر قبلا ثبت شده ',
        'name' => [
            'required' => 'اسم خود را وارد کنید',
            'max'=>'کارکتر ها بیش از حد مجاز است ',
            'string'=>'لطفا به صورت درست  پر کنید',
        ],
        'last_name' => [
            'required' => 'نام خانوادگی خود را وارد کنید',
            'max'=>'کارکتر ها بیش از حد مجاز است ',
            'string'=>'لطفا به صورت درست  پر کنید',
        ],
        'email' => [
            'required' => 'ایمیل خود را وارد کنید',
            'email' => 'به فرمت ایمیل وارد کنید',
            'max'=>'کارکتر ها بیش از حد مجاز است ',
            'string'=>'لطفا به صورت درست  پر کنید',
            'unique'=>'ایمیل قبلا ثبت شده',
        ],
        'password' => [
            'required'=>'ایدی خود راموجود نیست ',
            'max'=>'کارکتر های پسورد بیش از حد مجاز است',
            'min'=>'کارکتر های پسورد کمتر از حد مجاز است',
            'confirmed'=>'تایید پسورد تطابق ندارد',

        ],
        'phone_number' => [
            'max'=>'کارکتر های تلفن همراه بیش از حد مجاز است',
            'required'=>'تلفن همراه خود راموجود نیست ',
            'numeric'=>'لطفا به صورت عددارسال کنید ',
        ],
        'National_Code' => [
            'required'=>'ایدی خود راموجود نیست ',
            'numeric'=>'لطفا به صورت عددارسال کنید ',
            'max'=>'کارکتر های کدملی بیش از حد مجاز است',
        ],
    ],
    'Product' => [
        'name_Product' => [
            'required' => 'نام محصول خودرا وارد کنید',
            'max'=>'کارکتر های نام محصول بیش از حد مجاز است ',
            'string'=>'لطفا سرموضوع به صورت درست  پر کنید',
        ],
        'short_description_Product' => [
            'required' => 'توضیحات کوتاه خودرا وارد کنید',
            'max'=>'کارکتر های توضیحات کوتاه بیش از حد مجاز است ',
            'string'=>'لطفا توضیحات کوتاه به صورت درست  پر کنید',
        ],
        'long_description_Product' => [
            'required' => 'توضیحات بلند خودرا وارد کنید',
            'max'=>'کارکتر های توضیحات بلند بیش از حد مجاز است ',
            'string'=>'لطفا توضیحات بلند به صورت درست  پر کنید',
        ],
        'category_id' => [
            'required'=>'دسته خود را وارد کنید ',
            'numeric'=>'لطفا دسته را به صورت عددارسال کنید ',
        ],
        'color_id' => [
            'required'=>'رنگ خود را وارد کنید ',
            'numeric'=>'لطفا رنگ را به صورت عددارسال کنید ',
        ],
        'price_Product' => [
            'required'=>'قیمت خود را وارد کنید ',
            'numeric'=>'لطفا قیمت را به صورت عددارسال کنید ',
        ],

        'image_Product' => [
            'required' => 'عکس  خودرا وارد کنید',
            'image'=>'فایل را به صورت عکس وارد کنید',
            'mimes'=>'فایل را با فرمت عکس وارد کنید',
        ],
        'alt' => [
            'required' => 'alt خودرا وارد کنید',
            'max'=>'کارکتر alt بیش از حد مجاز است ',
            'string'=>'لطفا به صورت درست  پر کنید',

        ],

        'size_Product' => [
            'required'=>'سایز خود را وارد کنید ',
            'string'=>'لطفا به صورت درست  پر کنید',
        ],
    ],


    'success' => ' عملیات باموفقیت انجام شد',
    'error' => ' عملیات باموفقیت انجام نشد',



];