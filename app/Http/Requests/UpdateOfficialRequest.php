<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfficialRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'judge' => ['required', 'string', 'max:255'],
            'penciler' => ['required', 'integer', 'min:0'],
        ];
    }
}
