<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'min:1', 'max:80', 'string'],
            'customer_email' => ['required', 'min:1', 'max:120', 'email'],
            'customer_mobile' => ['required', 'min:1', 'max:40'],
            'product_id' => ['required', 'exists:products,id']
        ];
    }
}
