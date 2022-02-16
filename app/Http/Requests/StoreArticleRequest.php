<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            //
            'name' => 'required|unique:articles,name,' . $this->id,
            'body' => 'required|min:100'
        ];

        //return [
        //    'title' => "required|unique:posts,title,{$this->post->id}"
        //]; 

        //return [
        //    'title' => [
        //        'required',
        //        Rule::unique('posts', 'title')->ignore($this->post)
        //    ]
        //];

        //https://www.csrhymes.com/2019/06/22/using-the-unique-validation-rule-in-laravel-form-request.html
    }
}
