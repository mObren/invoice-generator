<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ClientStoreRequest extends FormRequest
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
            'company_name' => 'required|max:255',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'registration_number' => 'required',
            'tax_number' => 'required',
            'zip_code' => 'required'
        ];
    }
}
