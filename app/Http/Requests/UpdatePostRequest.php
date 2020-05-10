<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'title'=>'required',
            'description'=>'required|max:100',
            'contents'=>'required',
            'category'=>'required'

        ];
    }
}
