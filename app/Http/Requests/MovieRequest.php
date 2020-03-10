<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
   public function authorize()
   {
      return true;
   }

   public function rules()
   {
      return [
         // 'name' => 'required|max:20',
      ];
   }

   public function messages()
    {
        return [
            //'name.required'        => 'Required',
            //'name.max'             => 'Maximum 20 characters',
        ];
    }
}