<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            "shopId"=>['required','exists:shops,shopId'],
            "name" => ['required','unique:products,name'],
            "category" => ['required', 'exists:categories,id'],
            "image" => ['required'],
            "description" => ['required'],
            "price" => ['required', 'integer'],
            "size" => ['required','array'],
            "quantity" => ['required','array'],
        ];
    }
}
