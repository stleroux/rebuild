<?php

namespace App\Http\Requests;

// use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileProfileRequest extends FormRequest
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
            'first_name'	=> 'required|min:2|max:255',
            'last_name'     => 'required|min:2|max:255',
            'telephone'     => 'required',
            'image'			=> 'sometimes|image',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'   => 'Required',
            'first_name.min'        => 'Minimum 2 characters',
            'first_name.max'        => 'Maximum 255 characters',
            'last_name.required'    => 'Required',
            'last_name.min'         => 'Minimum 2 characters',
            'last_name.max'         => 'Maximum 255 characters',
            'telephone.required'    => 'Required',
            'image.image'           => 'Must be an image file'
        ];
    }
}