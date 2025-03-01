<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name'                  => ['required','string','max:100'],
            'email'                 => ['required','string','max:50','unique:users,email'],
            'password'              => ['required','string','min:8','max:16','confirmed'],
            'password_confirmation' => ['required','string'],
            'gender'                => ['required','in:1,2']
        ];

        if(request()->update_id){
            $rules['email'][3]                 = 'unique:users,email,'.request()->update_id;
            $rules['password'][0]              = 'nullable';
            $rules['password_confirmation'][0] = 'nullable';
        }

        return $rules;
    }
}
