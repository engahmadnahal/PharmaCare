<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutPrivecyTermUserReqest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'image' => 'nullable|image|mimes:png,jpg',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'body_ar' => 'required|string',
            'body_en' => 'required|string',
        ];
    }
}
