<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

class MealRequest extends FormRequest
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
        return [
            'meal_type'  => ['required','in:1,2,3,4'],
            'total_meal' => ['required','integer'],
            'comment'    => ['nullable','string'],
            'meal_date'  => ['required','date_format:Y-m-d'],
        ];
    }


}
