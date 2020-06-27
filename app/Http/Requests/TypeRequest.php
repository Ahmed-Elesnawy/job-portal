<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest
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
    {   $store = [
        'name' => ['required','min:3','string','unique:types']
        ];



        if ( $this->getMethod() == 'PUT' )
        {
            return [
                'name' => ['required','min:3','string','unique:types,name,'.$this->type->id]
             ];
        }
        return $store;
    }
    
}
