<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkerRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:workers',
            'password' =>  ['required', 'regex:/((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,}))/u'],
            'birthdate' => 'required|date',
            'active' => 'required'
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
