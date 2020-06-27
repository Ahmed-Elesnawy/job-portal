<?php

namespace App\Http\Requests;

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

            'title'       => ['required','string'],
            'banner'      => ['nullable','image'],
            'description' => ['required','min:50'],
            'exp_level'   => ['required','in:fresh,mid-level,professional'],
            'apply_url'   => ['required','url'],
            'tags'        => ['required'],
            'skills'      => ['required'],
            'salary'      => ['required','string'],
            'type_id'     => ['required','numeric'],
            'category_id' => ['required','numeric'],
            'user_id'     => ['required','numeric'],
            'country_id'  => ['required','numeric'],
            'banner'      => ['nullable','image'],

        ];
    }
}
