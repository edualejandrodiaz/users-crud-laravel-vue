<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PutWorkerRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /*
        Password must be container 1 minus, 1 mayus and 1 digit
        */
        return [
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:workers,email,'.$this->worker->id,
            'password' =>  ['sometimes','required', 'regex:/((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,}))/u'],
            'birthdate' => 'sometimes|required|date',
            'active' => 'sometimes|required'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {

        return [
            'password.regex' => 'Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters' 
        ];
    }
}
