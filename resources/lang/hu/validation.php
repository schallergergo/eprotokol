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

    'accepted' => 'A(z) :attribute nincs elfogadva.',
    'active_url' => 'A(z) :attribute nem érvényes URL.',
    'after' => 'A(z) :attribute :date utáni dátum lehet.',
    'after_or_equal' => 'A(z) :attribute must be a date after or equal to :date.',
    'alpha' => 'A(z) :attribute csak betűket tartalmazhat.',
    'alpha_dash' => 'A(z) :attribute csak betűket, számokat, kötőjelet és alsó vonást tartalmazhat.',
    'alpha_num' => 'A(z) :attribute csak betűket és számokat tartalmazhat.',
    'array' => 'A(z) :attribute must be an array.',
    'before' => 'A(z) :attribute :date előtti dátum lehet.',
    'before_or_equal' => 'A(z) :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'A(z) :attribute :min és :max között kell legyen.',
        'file' => 'A(z) :attribute :min és :max kilobyte között kell legyen.',
        'string' => 'A(z) :attribute :min - :max karakter legyen.',
        'array' => 'A(z) :attribute must have between :min and :max items.',
    ],
    'boolean' => 'A(z) :attribute field must be true or false.',
    'confirmed' => 'A(z) :attribute confirmation does not match.',
    'date' => 'A(z) :attribute nem valós dátum.',
    'date_equals' => 'A(z) :attribute must be a date equal to :date.',
    'date_format' => 'A(z) :attribute nem egyezik a formátummal: :format.',
    'different' => 'A(z) :attribute és :other különböző kell legyen.',
    'digits' => 'A(z) :attribute nem :digits számjegy.',
    'digits_between' => 'A(z) :attribute :min - :max számjegyet tartalmazhat.',
    'dimensions' => 'A(z) :attribute felbontása érvénytelen.',
    'distinct' => 'A(z) :attribute field has a duplicate value.',
    'email' => 'A(z) :attribute nem érvényes e-mail cím.',
    'ends_with' => 'A(z) :attribute csak ezekre végződhet: :values.',
    'exists' => 'A kiválasztott :attribute érvénytelen.',
    'file' => 'A(z) :attribute nem fájl.',
    'filled' => 'A(z) :attribute mező nem rendelkezik értékkel.',
    'gt' => [
        'numeric' => 'A(z) :attribute nem nagyobb, mint :value.',
        'file' => 'A(z) :attribute nem nagyobb, mint :value kilobyte.',
        'string' => 'A(z) :attribute nem nagyobb, mint :value karakter.',
        'array' => 'A(z) :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'A(z) :attribute nem nagyobb vagy egyenlő, mint :value.',
        'file' => 'A(z) :attribute nem nagyobb vagy egyenlő, mint :value kilobyte.',
        'string' => 'A(z) :attribute nem nagyobb vagy egyenlő, mint :value karakter.',
        'array' => 'A(z) :attribute must have :value items or more.',
    ],
    'image' => 'A(z) :attribute nem kép.',
    'in' => 'A kiválasztott :attribute érvénytelen.',
    'in_array' => 'A(z) :attribute mező nem létezik itt: :other.',
    'integer' => 'A(z) :attribute must be an integer.',
    'ip' => 'A(z) :attribute nem érvényes IP cím.',
    'ipv4' => 'A(z) :attribute nem érvényes IPv4 cím.',
    'ipv6' => 'A(z) :attribute nem érvényes IPv6 cím.',
    'json' => 'A(z) :attribute nem érvényes JSON string.',
    'lt' => [
        'numeric' => 'A(z) :attribute nem kisebb, mint :value.',
        'file' => 'A(z) :attribute nem kisebb, mint :value kilobyte.',
        'string' => 'A(z) :attribute nem kisebb, mint :value karakter.',
        'array' => 'A(z) :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'A(z) :attribute nem kisebb vagy egyenlő, mint :value.',
        'file' => 'A(z) :attribute nem kisebb vagy egyenlő, mint :value kilobyte.',
        'string' => 'A(z) :attribute nem kisebb vagy egyenlő, mint :value karakter.',
        'array' => 'A(z) :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'A(z) :attribute nem lehet több, mint :max.',
        'file' => 'A(z) :attribute nem lehet több, mint :max kilobyte.',
        'string' => 'A(z) :attribute nem lehet több, mint :max karakter.',
        'array' => 'A(z) :attribute must not have more than :max items.',
    ],
    'mimes' => 'A(z) :attribute :values típusú fájl lehet.',
    'mimetypes' => 'A(z) :attribute :values típusú fájl lehet.',
    'min' => [
        'numeric' => 'A(z) :attribute minimum :min lehet.',
        'file' => 'A(z) :attribute minimum :min kilobyte lehet.',
        'string' => 'A(z) :attribute minimum :min karakter legyen.',
        'array' => 'A(z) :attribute must have at least :min items.',
    ],
    'multiple_of' => 'A(z) :attribute :value többszöröse lehet.',
    'not_in' => 'The kiválasztott :attribute érvénytelen.',
    'not_regex' => 'A(z) :attribute formátuma érvénytelen.',
    'numeric' => 'A(z) :attribute nem szám.',
    'password' => 'Érvénytelen jelszó.',
    'present' => 'A(z) :attribute field must be present.',
    'regex' => 'A(z) :attribute formátuma érvénytelen.',
    'required' => 'A(z) :attribute mező kitöltése kötelező.',
    'required_if' => 'A(z) :attribute field is required when :other is :value.',
    'required_unless' => 'A(z) :attribute field is required unless :other is in :values.',
    'required_with' => 'A(z) :attribute field is required when :values is present.',
    'required_with_all' => 'A(z) :attribute field is required when :values are present.',
    'required_without' => 'A(z) :attribute field is required when :values is not present.',
    'required_without_all' => 'A(z) :attribute mező kitöltése kötelező, ha :values are present.',
    'prohibited' => 'A(z) :attribute field is prohibited.',
    'prohibited_if' => 'A(z) :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'A(z) :attribute field is prohibited unless :other is in :values.',
    'same' => 'A(z) :attribute és :other nem egyezik meg',
    'size' => [
        'numeric' => 'A(z) :attribute must be :size.',
        'file' => 'A(z) :attribute must be :size kilobytes.',
        'string' => 'A(z) :attribute must be :size characters.',
        'array' => 'A(z) :attribute must contain :size items.',
    ],
    'starts_with' => 'A(z) :attribute a következők egyikével kell kezdődjön: :values.',
    'string' => 'A(z) :attribute must be a string.',
    'timezone' => 'A(z) :attribute must be a valid zone.',
    'unique' => 'A(z) :attribute már foglalt.',
    'uploaded' => 'A(z) :attribute feltöltése sikertelen.',
    'url' => 'A(z) :attribute formátuma érvénytelen.',
    'uuid' => 'A(z) :attribute nem érvényes UUID.',

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
        'password'=>'jelszó',
        'username'=>'igazolási szám',
        'name'=>'név'
    ],

];
