<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'name'=>'required',
            'phone'=> 'required',
            'address'=> 'required',
            'payment_method'=> 'required',
        ];
    }

    public function messages() {
       return [
        'name.required'=> __('front.name-required'),
        'phone.required'=> __('front.phone-required'),
        'address.required'=> __('front.address-required'),
        'payment_method.required'=> __('front.payment-method-required'),
       ] ;
    }
}
