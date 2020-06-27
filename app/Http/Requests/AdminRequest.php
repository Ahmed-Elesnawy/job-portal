<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'     => ['required'],
            'position' => ['required','string'],
            'email'    => ['required','email','unique:admins'],
            'password' => ['required','min:5'],
            'image'    => ['nullable','image']
        ];

        if ( $this->getMethod() == 'PUT' )
        {
            $rules['email']    = ['required','email','unique:admins,email,'.$this->admin->id];
            $rules['password'] = ['nullable','min:5'];
        }

        return $rules;
    }
}
