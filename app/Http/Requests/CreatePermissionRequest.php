<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePermissionRequest extends FormRequest
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
            'name'          => 'required|min:3|max:255|unique:permissions,name',
            'display_name'  => 'required',
            'model'         => 'required',
            'type'          => 'required',
            'description'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Required',
            'name.min'      => 'Minimum 3 characters',
            'name.max'      => 'Maximum 255 characters',
        ];
    }

}
