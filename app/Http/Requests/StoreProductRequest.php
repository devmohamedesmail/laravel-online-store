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
            "name" => "required",
            "category" => "required",
            "image"=> "required",
            "price"=> "required|numeric",
            "sale_price"=> "numeric",
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => __('products.name-required'),
            'category.required' => __('products.category-required'),
            'image.required' => __('products.image-required'),
            'price.required' => __('products.price-required'),
            'price.integer' => __('products.price-integer'),
            'sale_price.integer' => __('products.price-integer'),
        ];
    }
}
