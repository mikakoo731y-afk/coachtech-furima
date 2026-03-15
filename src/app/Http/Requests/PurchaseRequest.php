<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            'payment_method' => 'required',
            'address_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'payment_method.required' => 'お支払い方法を選択してください',
            'address_id.required'     => '配送先住所を選択してください',
        ];
    }
}
