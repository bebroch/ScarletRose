<?php

namespace App\Http\Requests;

use App\Rules\PriceOrExhibitionRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class addMyPictureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(!empty(Auth::user())){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
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
