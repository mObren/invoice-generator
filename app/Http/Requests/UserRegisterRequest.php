<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UserRegisterRequest extends FormRequest
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
            'username' => 'required|unique:users,username|min:4|max:255',
            'password' => 'required|max:255|min:6',
            'email' => 'required|email|unique:users,email|max:255',
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
