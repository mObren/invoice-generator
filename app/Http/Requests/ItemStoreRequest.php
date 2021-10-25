<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'invoice_id' => 'required',
            'service' => 'required',
            'quantity' => 'required|numeric|gt:0',
            'price' => 'required|numeric|gt:0',
            'pdv' => 'required|numeric|gt:0',
        ];
    }

    public function messages()
    {
        return [
            'service.required' => 'Description is required!',
            'quantity.required' => 'Quantity is required!',
            'price.required' => 'Price is required!',
            'pdv.required' => "Tax is required!",
            'pdv.numeric' => "Tax must be in number format.",
            'pdv.gt' => "Tax must be greater than zero."

        ];
    }
}
