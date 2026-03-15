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
            'img_url'     => 'nullable|image|mimes:jpeg,png',
            'name'        => 'required|max:20',
            'postal_code' => 'required|size:8',
            'address'     => 'required',
        ];
    }

    public function messages(): array
    {
        return[
            'img_url.required'       => '画像をアップロードしてください',
            'img_url.mimes'          => '指定の拡張子（.jpeg, .png）でアップロードしてください',
            'name.required'     => 'お名前を入力してください',
            'name.max'          => 'お名前は20文字以内で入力してください',
            'postal_code.required' => '郵便番号を入力してください',
            'postal_code.size'     => '郵便番号はハイフンありの8文字で入力してください',
            'address.required'     => '住所を入力してください',
        ];
    }
}
