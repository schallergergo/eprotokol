<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventingShowJumpingRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
             'time' => ['required',"min:0", 'numeric'],
            'obstacle_fault' => ['required',"min:0", 'numeric'],
            'time_fault' => ['required',"min:0", 'numeric'],
            'total_fault' => ['required',"min:0", 'numeric'],
            'comments' => ['nullable','string'],
            'eliminated'=>["required","numeric","max:1"]
        ];
    }
}
