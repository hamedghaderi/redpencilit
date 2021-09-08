<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute باید پذیرفته شده باشد.',
    'active_url' => 'آدرس :attribute معتبر نیست',
    'after' => ':attribute باید تاریخی بعد از :date باشد.',
    'after_or_equal' => ':attribute باید تاریخی بعد یا مساوی با :date باشد',
    'alpha' => ':attribute باید شامل حروف الفبا باشد.',
    'alpha_dash' => ':attribute باید شامل حروف الفبا و عدد و خط تیره(-) باشد.',
    'alpha_num' => ':attribute باید شامل حروف الفبا و عدد باشد.',
    'array' => ':attribute باید شامل آرایه باشد.',
    'before' => ':attribute باید تاریخی قبل از :date باشد.',
    'before_or_equal' => ':attribute باید تاریخی قبل یا مساوی با :date باشد.',
    'between' => [
        'numeric' => ':attribute باید بین :min و :max باشد.',
        'file' => ':attribute باید بین :min و :max کیلوبایت باشد.',
        'string' => ':attribute باید بین :min و :max کاراکتر باشد.',
        'array' => ':attribute باید بین :min و :max آیتم باشد.',
    ],
    'boolean' => 'فیلد :attribute فقط میتواند صحیح و یا غلط باشد',
    'confirmed' => ':attribute با تاییدیه مطابقت ندارد.',
    'date' => ':attribute یک تاریخ معتبر نیست.',
    'date_equals' => ':attribute باید یک تاریخ مساوی با :date باشد.',
    'date_format' => ':attribute با الگوی :format مطاقبت ندارد.',
    'different' => ':attribute و :other باید متفاوت باشند.',
    'digits' => ':attribute باید :digits رقم باشد.',
    'digits_between' => ':attribute باید بین :min و :max رقم باشد.',
    'dimensions' => ':attribute دارای ابعاد تصویر غیر معتبر است.',
    'distinct' => ':attribute تکراری میباشد.',
    'email' => ':attribute یک ادرس ایمیل معتبر نیست.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'ends_with' => ':attribute باید با یکی از مقادیر :values پایان یابد.',
    'exists' => ':attribute انتخاب شده، معتبر نیست.',
    'file' => ':attribute بایدیک فایل باشد',
    'filled' => ':attribute باید یک مقدار داشته باشد.',
    'gt' => [
        'numeric' => ':attribute باید از :value بزرگتر باشد',
        'file' => ':attribute باید بزرگتر از :value کیلوبایت باشد.',
        'string' => ':attribute باید بیشتر از :value کاراکتر باشد.',
        'array' => ':attribute باید بیشتر از :value مقدار داشته باشد.',
    ],
    'gte' => [
        'numeric' => ':attribute باید از :value بزرگتر یا مساوی باشد',
        'file' => ':attribute باید بزرگتر یا مساوی با :value کیلوبایت باشد.',
        'string' => ':attribute باید بیشتر یامساوی با :value کاراکتر باشد.',
        'array' => ':attribute باید بیشتر یا مساوی با :value مقدار داشته باشد.',
    ],
    'image' => ':attribute باید تصویر باشد.',
    'in' => ':attribute انتخاب شده، معتبر نیست.',
    'in_array' => ':attribute در :other وجود ندارد.',
    'integer' => ':attribute باید یک عدد صحیح باشد.',
    'ip' => ':attribute باید یک ادرس آی پی معتبر باشد.',
    'ipv4' => ':attribute باید یک ادرس IPv4 معتبر باشد',
    'ipv6' => ':attribute باید یک آدرس IPv6 معتبر باشد.',
    'json' => ':attribute باید یک رشته JSON معتبر باشد.',
    'lt' => [
        'numeric' => ':attribute باید کمتر از :value باشد',
        'file' => ':attribute باید کمتر از :value کیلوبایت باشد.',
        'string' => ':attribute باید کمتر از :value کاراکتر باشد',
        'array' => ':attribute باید کمتر از :value مقدار داشته باشد',
    ],
    'lte' => [
        'numeric' => ':attribute باید کمتر یا مساوی با :value باشد',
        'file' => ':attribute باید کمتر یا مساوی :value کیلوبایت باشد.',
        'string' => ':attribute باید کمتر یا مساوی با :value کاراکتر باشد',
        'array' => ':attribute باید کمتر یا مساوی با :value مقدار داشته باشد',
    ],
    'max' => [
        'numeric' => ':attribute نباید بیشتر از :max باشد.',
        'file' => ':attribute نباید بیشتر از :max کیلوبایت باشد.',
        'string' => ':attribute نباید بیشتر از :max کاراکتر باشد.',
        'array' => ':attribute نباید بیشتر از :max مقدار داشته باشد.',
    ],
    'mimes' => ':attribute باید یک فال با فرمت: :values باشد.',
    'mimetypes' => ':attribute باید یک فال با فرمت: :values باشد.',
    'min' => [
        'numeric' => ':attribute حداقل باید :min باشد.',
        'file' => ':attribute باید حداقل :min کیلوبایت باشد.',
        'string' => ':attribute حداقل باید :min کاراکتر باشد.',
        'array' => ':attribute حداقل باید :min مقدار داشته باشد.',
    ],
    'not_in' => ':attribute انتخاب شده، معتبر نیست.',
    'not_regex' => ':attribute فرمت قابل قبولی ندارد',
    'numeric' => ':attribute باید یک عدد باشد.',
    'password' => 'رمز اشتباه است.',
    'present' => 'فیلد ورودی :attribute باید وجود داشته باشد.',
    'regex' => 'فرمت :attribute قابل قبول نمیباشد',
    'required' => ':attribute الزامی است.',
    'required_if' => ':attribute الزامی است در صورتی که :other برابر :value باشد.',
    'required_unless' => ':attribute الزامی است تا زمانی که :other در :values باشد.',
    'required_with' => ':attribute الزامی است زمانی که :values وجود دارد.',
    'required_with_all' => ':attribute الزامی است زمانی که :values وجود دارند.',
    'required_without' => ':attribute الزامی است زمانی که :values وجود ندارند.',
    'required_without_all' => ':attribute الزامی است زمانی که هیچکدام از :values وجود ندارند.',
    'same' => 'The :attribute and :other must match.',
    'same' => ':attribute و :other باید با هم برابر باشند.',
    'size' => [
        'numeric' => ':attribute باید :size باشد.',
        'file' => ':attribute باید :size کیلوبایت باشد.',
        'string' => ':attribute باید :size کاراکتر باشد.',
        'array' => ':attribute باید دارای :size مقدار باشد.',
    ],
    'starts_with' => ':attribute باید با یکی از :values شروع شود.',
    'string' => ':attribute باید یک رشته باشد.',
    'timezone' => ':attribute باید که موقعیت مکان زمانی معتبر باشد.',
    'unique' => ':attribute قبلا استفاده شده است.',
    'uploaded' => ':attribute موفق به آپلود نشده است.',
    'url' => ':attribute باید یک url معتبر باشد.',
    'uuid' => ':attribute باید یک UUID معتبر باشد.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'title' => 'تیتر',
        'name' => 'نام',
        'username' => 'نام کاربری',
        'description' => 'توضیحات',
        'body' => 'متن',
        'tags' => 'تگ',
        'email' => 'ایمیل',
        'password' => 'رمز عبور',
        'link' => 'لینک',
        'image' => 'تصویر',
        'reciver' => 'دریافت کننده',
        'content' => 'محتوا',
        'year' => 'سال',
        'month' => 'ماه',
        'day' => 'روز',
        'hour' => 'ساعت',
        'minute' => 'دقیقه',
        'seconds' => 'ثانیه',
    ],

];
