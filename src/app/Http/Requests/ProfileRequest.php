<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'img_url'     => 'nullable|mimes:jpeg,png', // 拡張子が.jpegもしくは.png
            'name'        => 'required|max:20',        // 20文字以内
            'postal_code' => 'required|regex:/^\d{3}-\d{4}$/', // ハイフンありの8文字
            'address'     => 'required',
        ];
    }
}
