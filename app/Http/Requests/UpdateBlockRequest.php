<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlockRequest extends FormRequest
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
            'letters'=> ['nullable','string'],
            'criteria'=> ['required','string'],
            'maxmark' => ['required', 'integer'],
            'coefficient' => ['required', 'integer'],
        ];
    }
}
