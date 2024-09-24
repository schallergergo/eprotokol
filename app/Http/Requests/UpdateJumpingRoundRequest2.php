<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJumpingRoundRequest2 extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'time2' => ['required', 'numeric', 'min:0'],
            'obstacle_fault2' => ['required', 'numeric', 'min:0'],
            'time_fault2' => ['required', 'numeric', 'min:0'],
            'total_fault2' => ['required', 'numeric', 'min:0'],
            'eliminated2'=> ['required', 'boolean'],
            'comments2'=>[],

        ];
    }


}
