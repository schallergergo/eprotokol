<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompetitionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'venue' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'discipline' => ['required'],
            'eventing' => ["required","boolean"],
        ];
    }
}
