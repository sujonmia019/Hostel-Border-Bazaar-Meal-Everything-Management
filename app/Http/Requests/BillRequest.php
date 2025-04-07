<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

class BillRequest extends FormRequest
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
            'type'           => ['required','string','in:all,user'],
            'bill_status_id' => ['required','integer'],
            'amount'         => ['required','integer'],
            'bill_month'     => ['required','date_format:F Y'],
            'border_id'      => ['nullable','required_if:type,user']
        ];
    }
}
