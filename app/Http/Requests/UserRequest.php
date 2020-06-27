<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        

        if ( $this->getMethod() == 'POST' )
        {
            $store = [
                'name'       => ['required'],
                'email'      => ['required','email','unique:users'],
                'password'   => ['required','min:5'],
                'level'      => ['required','in:seeker,company'],
            ];

            return $store;

        } else if ( $this->getMethod() == 'PUT' )
        {
            $put = [ 
            'name'          => ['required'],
            'email'         => ['required','email','unique:users,email,'.$this->user->id],
            'password'      => ['nullable','min:5'],
            'github'        => ['nullable','url'],
            'facebook'      => ['nullable','url'],
            'linkedin'      => ['nullable','url'],
            'twitter'       => ['nullable','url'],
            'image'         => ['nullable','image'],
            'fullname'      => ['nullable','string'],
            'mobile'        => ['nullable','string'],
            'position'      => ['nullable','string'],
            'experience'    => ['nullable','min:50'],
            'cv'            => ['nullable','mimes:pdf'],
            'size'          => ['nullable','in:small,medium,large'],
            'specialized_in'=> ['nullable','string'],
            'phone'         => ['nullable','string'],
        ];

            return $put;
        }
        
    }
}