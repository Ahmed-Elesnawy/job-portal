<?php

namespace App\Http\Requests\FrontEnd;

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
        return [
            
            'github'         => ['nullable','url'],
            'facebook'       => ['nullable','url'],
            'linkedin'       => ['nullable','url'],
            'twitter'        => ['nullable','url'],
            'image'          => ['nullable','image'],
            'fullname'       => ['nullable','string'],
            'mobile'         => ['nullable','string'],
            'position'       => ['nullable','string'],
            'experience'     => ['nullable','min:50'],
            'cv'             => ['nullable','mimes:pdf'],
            'size'           => ['in:small,medium,large'],
            'specialized_in' => ['nullable','string'],
            'phone'          => ['nullable','string'],
        ];
    }
}
