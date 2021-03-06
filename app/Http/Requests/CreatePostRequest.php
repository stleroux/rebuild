<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
        // https://laravel.com/docs/5.2/validation#available-validation-rules
        return [
            'title'			=> 'min:5|required|max:255',
            // 'slug'			=> 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'	=> 'required',
            'body'			=> 'required',
            'image'         => 'sometimes|image|mimes:jpeg,jpg,png,bmp,gif',
        ];
    }

    public function messages()
    {
        return [
            'title.required'        => 'Required',
            'title.min'             => 'Minimum 5 characters',
            'title.max'             => 'Maximum 255 characters',
            // 'slug.required'         => 'Required',
            // 'slug.alpha_dash'       => 'Alpha characters only including the "_"',
            // 'slug.min'              => 'Minimum 5 characters',
            // 'slug.max'              => 'Maximum 255 characters',
            // 'slug.unique'           => 'Must be unique',
            'category_id.required'  => 'Required',
            'body.required'         => 'Required',
        ];
    }
}
