<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSystemMessageRequest extends FormRequest
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
            'title' => 'required|max:255',
            'body' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'title.max' => '标题长度不可超过255',
            'body.required' => '正文不能为空',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();
        $expected_errors_array = [];
        foreach ($errors as $error) {
            $expected_errors_array['errors'][] = $error;
        }
        exit(json_encode(ReturnHelper::returnWithStatus(
            $expected_errors_array,
            6002
        )));
    }
}
