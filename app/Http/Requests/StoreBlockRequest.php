<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlockRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ordinal' => ['required', 'integer'],
            'programpart' => ['required', 'integer'],
            'letters'=> ['required','string'],
            'criteria'=> ['required','string'],
            'extra_info'=> ['nullable','string'],
            'maxmark' => ['required', 'integer'],
            'coefficient' => ['required', 'integer'],
        ];
    }
}
