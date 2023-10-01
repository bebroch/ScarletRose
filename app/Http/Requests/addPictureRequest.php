<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addPictureRequest extends FormRequest
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
            "UserFirstName" => "required|string",
            "UserLastName" => "required|string",

            'uploadPicture' => 'required',
            'namePicture' => 'required|string',
            'aboutPicture' => 'required|string',
            'yearCreate' => 'required',
            'width' => 'required|integer',
            'height' => 'required|integer',
            'price' => 'integer|gt:0|lt:4294967295|required_without:exhibitions',
            'exhibitions' => 'required_without:price',
        ];
    }
}