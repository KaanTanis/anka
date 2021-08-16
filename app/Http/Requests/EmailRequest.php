<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Mockery\Exception;

class EmailRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            //'checkbox' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'İsim alanı gereklidir',
            'email.required' => 'Email alanı gereklidir',
            'email.email' => 'Email adresi geçersiz',
            'phone.required' => 'Telefon alanı gereklidir',
            'checkbox.required' => 'Lütfen koşulları onaylayınız.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => 'warning',
            'message' => $validator->errors()->all()
        ]);

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}

