<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJumpingRoundRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'time1' => ['required', 'numeric', 'min:0'],
            'obstacle_fault1' => ['required', 'numeric', 'min:0'],
            'time_fault1' => ['required', 'numeric', 'min:0'],
            'total_fault1' => ['required', 'numeric', 'min:0'],
            'eliminated1'=> ['required', 'boolean'],
            'comments1'=>[],

        ];
    }


}
