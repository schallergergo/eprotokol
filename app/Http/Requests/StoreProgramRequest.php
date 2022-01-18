<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgramRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'discipline' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'numofblocks' => ['required', 'integer'],
            'maxMark' => ['required', 'integer'],
            'typeofevent' => ['required', 'string', 'max:255'],
            'doublesided' => ['required', 'boolean'],
        ];
    }
}
