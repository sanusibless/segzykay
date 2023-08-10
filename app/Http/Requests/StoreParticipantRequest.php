<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParticipantRequest extends FormRequest
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
            'firstname' => "required|string",
            'midname' => "required|string",
            'lastname' => "required|string",
            'email' => "required|email|unique:users,email",
            'phone' => "required|digits:11",
            'dob' => "required|date",
            'gender' => "required",
            'street' => "required_with:city,state|string",
            'city' => "required_with:street,state|string",
            'state' => "required_with:street,city|string",
            'image' => "required|image"
        ];
    }
}
