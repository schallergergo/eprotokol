<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStyleRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'time' => ['required', 'numeric', 'min:0'],
            'total_fault' => ['required', 'numeric', 'min:0'],           
            'given_mark' => ['required', 'numeric', 'min:0','max:10'],
            'deductions' => ['required', 'numeric', 'min:0'],
            'total_mark' => ['required', 'numeric', 'min:0'],
            'eliminated'=> ['required', 'boolean'],
            'comments'=>[],
        ];
    }
}
