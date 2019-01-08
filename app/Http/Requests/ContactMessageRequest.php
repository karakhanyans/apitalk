<?php

namespace App\Http\Requests;

use App\Helpers\StatusCodeHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ContactMessageRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'age' => 'integer|min:18|max:100'
        ];
    }

    /**
     * Handle a failed validation attempt
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $response = [
            'success' => false,
            'errors' => [
                'validation' => $validator->errors()
            ],
            'data' => []
        ];
        throw new HttpResponseException(response()->json($response, StatusCodeHelper::HTTP_UNPROCESSABLE_ENTITY));
    }
}
