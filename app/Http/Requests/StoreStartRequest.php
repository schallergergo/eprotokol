<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStartRequest extends FormRequest
{
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rider_id' => ['required', 'string', 'max:6'],
            'rider_name' => ['required', 'string', 'max:255'],
            'horse_id' => ['required', 'string', 'max:6'],
            'horse_name' => ['required', 'string', 'max:255'],
            'club' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string',  'max:255'],
        ];
    }
}
