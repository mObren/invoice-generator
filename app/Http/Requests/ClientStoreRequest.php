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
     public function messages()
    {
        return [
            'company_name.required' => "Please, provide the client's company name.",
            'email.required' => "Client's email address is required.",
            'email.email' => "Please, provide a valid email address for the client.",
            'city.required' => "Please, enter the name of the city from which the client's company comes.",
            'address.required' => "Please, enter the address of the client's company.",
            'country.required' => "Please, enter the name of the country from which the client's company comes.",
            'registration_number.required' => "Please, provide the registration number of the client's company.",
            'tax_number.required' => "Please, provide the tax number of the client's company.",
            'zip_code.required' => "Please, provide the zip code of the client's company.",

        ];
    }
}
