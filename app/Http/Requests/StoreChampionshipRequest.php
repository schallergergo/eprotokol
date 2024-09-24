<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChampionshipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
   
    public function rules()
    {

            return [
            'championshipname' => ['required', 'string', 'max:255'],
            'discipline' => ['required'],
            'type'=> ['required', 'string', 'max:50'],
        ];
    }
}
