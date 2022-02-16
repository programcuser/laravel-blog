<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        //print_r($this);
        //return [
            //
        //    'name' => 'required|unique:articles,name,' . $this->article->id,
        //    'body' => 'required|min:100'
        //];

        //return [
        //    'title' => "required|unique:posts,title,{$this->post->id}"
        //]; 

        return [
            'name' => [
                'required',
                Rule::unique('articles', 'name')->ignore($this->article)
            ],
            'body' => [
                'required',
                'min:100'
            ]
        ];

        //https://www.csrhymes.com/2019/06/22/using-the-unique-validation-rule-in-laravel-form-request.html
        //https://laracasts.com/discuss/channels/requests/laravel-5-validation-request-how-to-handle-validation-on-update
    }
}
