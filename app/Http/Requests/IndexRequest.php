<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class IndexRequest extends FormRequest {

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
        return [
            //
            "paginate" => "required|in:true,false",
            'per_page' => 'required_if:paginate,true|integer'
        ];
    }
}
