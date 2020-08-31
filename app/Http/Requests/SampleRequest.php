<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class SampleRequest extends FormRequest {

    protected function failedValidation(Validator $validator) {

        $response = clientErrorResponse($validator->errors()->getMessages(), []);
        throw new ValidationException($validator, $response);

    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [
            "POST" => [
                "name" => "required",
                'age'  => 'required|integer',
            ],
            "PUT"  => [
                "name" => "required",
            ]
        ];


        return $rules[ $this->getMethod() ];
    }
}
