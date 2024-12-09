<?php

namespace App\Http\Requests;

use App\Enums\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'item' => 'required',
            'size' => 'required',
            'weight' => 'required',
            'pickup_location' => 'required',
            'delivery_location' => 'required',
            'pickup_at' => 'required|date',
            'delivery_at' => 'required|date'
        ];
    }
}
