<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'event_name' => ['required', 'string', 'max:255'],
            'program_id' => ['required', 'integer', 'min:0'],
            "start_fee" => ['required', 'integer', 'min:0'],
        ];
    }
}
