<?php

namespace App\Imports\Task;

use App\Models\Task;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TaskImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $row){
            Task::create([
                'name'=>$row[0],
                'email'=>$row[1],
                'code'=>$row[2],
                'phone'=>$row[3],
                'source'=>$row[4],
                'status'=>$row[5]   
            ]);
        }
    }
}
