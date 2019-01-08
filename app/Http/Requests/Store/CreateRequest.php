<?php

namespace App\Http\Requests\Store;

use App\Models\Brand;
use App\Models\Store;
use App\Helpers\StatusCodeHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateRequest extends FormRequest
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
            'brand_id' => 'required|exists:' . (new Brand())->getTable() . ',id',
            'number' => 'required|integer',
            'name' => 'required|max:255|unique:' . (new Store())->getTable() . ',name',
            'type' => 'required|in:' . Store::TYPE_NOT_LICENSED . ',' . Store::TYPE_LICENSED,
            'phone_number' => 'phone:US,AM,UK',
            'country' => 'required',
            'city' => 'required',
            'timezone' => 'required|min:2'
        ];
    }

    public function messages()
    {
        return [
            'timezone.min' => 'The timezone field is required'
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
