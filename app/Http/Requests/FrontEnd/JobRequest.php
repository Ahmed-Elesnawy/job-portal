<?php

namespace App\Http\Requests\FrontEnd;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'title'       => ['required'],
            'banner'      => ['nullable','image'],
            'description' => ['required','min:50'],
            'exp_level'   => ['required','in:fresh,mid-level,professional'],
            'salary'      => ['required'],
            'type_id'     => ['required','numeric'],
            'category_id' => ['required','numeric'],
            'country_id'  => ['required','numeric'],
            'tags'        => ['required'],
            'skills'      => ['required']
        ];
    }
}
