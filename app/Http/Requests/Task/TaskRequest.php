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
                'nullable'
            ],
            'email' => [
                'nullable'
            ],
            'code' => [
                'nullable'
            ],
            'phone' => [
                'nullable'
            ]
        ];
    }
}
