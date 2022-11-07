<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:100'],
            'address' => ['required', 'max:255'],
            'premium' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'policy' => ['required', 'max:100'],
            'insurer' => ['required', 'max:100']
        ];
    }
}
