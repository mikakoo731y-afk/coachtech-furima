<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'name'          => 'required',
            'description'   => 'required|max:255',
            'img_url'       => 'required|mimes:jpeg,png',
            'categories'    => 'required',
            'condition_id'  => 'required',
            'price'         => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'          => '商品名を入力してください',
            'description.required'   => '商品説明を入力してください',
            'description.max'        => '商品説明は255文字以内で入力してください',
            'img_url.required'       => '商品画像をアップロードしてください',
            'img_url.mimes'          => '指定の拡張子（.jpeg, .png）でアップロードしてください',
            'categories.required'    => 'カテゴリーを選択してください',
            'condition_id.required'  => '商品の状態を選択してください',
            'price.required'         => '販売価格を入力してください',
            'price.numeric'          => '販売価格は数値で入力してください',
            'price.min'              => '販売価格は0円以上で入力してください',
        ];
    }
}
