<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreRequest extends FormRequest
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

    //
    /**

     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email',
            'mobile' => 'required|string|unique:admins,mobile',
            'address' => 'required|string',
            'avater' => 'required|image|mimes:png,jpg',
            'national_id' => 'required|string|unique:admins,national_id',
            'password' => 'required|string|min:6|max:12'
        ];
    }
}
