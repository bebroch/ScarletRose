<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminAddingExhibition extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'start_at' => 'required|before_or_equal:end_at',
            'end_at' => 'required|after_or_equal:start_at',
            'about' => 'required',
        ];
    }
}
