<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'name' => [
                'required',
            ],
            'email' => [
                'required',
            ],
            'code' => [
                'required',
            ],
            'phone' => [
                'required',
            ],
            'source_id' => [
                'nullable'
            ]
          

        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'The phone code is required',

        ];
    }
}
