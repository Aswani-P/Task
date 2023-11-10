<?php

namespace App\Imports\Task;

use App\Models\Task;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;

use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class TaskImport implements ToCollection, WithValidation
{
    use Importable,SkipsFailures;
  

    public function collection(Collection $collection)
    {
        try {
            foreach ($collection as $row) {
                Task::create([
                    'name' => $row[0],
                    'email' => $row[1],
                    'code' => $row[2],
                    'phone' => $row[3],
                    'source_id' => $row[4],
                    'status' => $row[5]
                ]);
            }
        } catch (\Throwable $th) {
            //    dd($th);
        }
    }
    public function rules(): array
    {
        return [
            '0' => [
                'required'
            ],
            '1'=>[
                'required'
            ],
            '2'=>[
                'required'
            ],
            '3'=>[
                'required'
            ],
            '4'=>[
                'required'
            ],
            '5'=>[
                'required'
            ]
        ];
    }
    public function onFailure(Failure ...$failures)
    {
        
    }
    public function onError(\Throwable $e)
    {
       throw($e);
    }
    public function customValidationMessages()
    {
        return [
            '0'=>'The name is required',
            '1'=>'email is mandatory',
            '2'=>'phone code is needed',
            '3'=>'mobile number is required'
        ];

    }
}
