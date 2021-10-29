<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UserEditRequest extends FormRequest
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
            'address' => 'required',
            'city' => 'required|max:255',
            'zip_code' => 'required',
            'phone_number' => 'required',
            'registration_number' => 'required',
            'tax_number' => 'required',
            'current_account' => 'required',
        ];
    }
}
