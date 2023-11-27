<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessCSVDataJob;
use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Yajra\DataTables\Facades\DataTables;

class TaskImportController extends Controller
{
    public function upload_csv(Request $request)
    {
        if($request->has('csv')){
            $csv    = file($request->csv);
            $chunks = array_chunk($csv,1000);
            $header = [];
            $batch  = Bus::batch([])->dispatch();
          
           foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv', $chunk);
                    if($key == 0){
                        $header = $data[0];
                        unset($data[0]);
                    }
                    $batch->add(new ProcessCSVDataJob($data, $header));
           
                }
                return redirect()->back();
            }
            return redirect('tasks')->with('message','imported successfully');
        }

        public function data_list()
        {
            $data = Data::orderBy('status','desc');
    
            return DataTables::of($data)
            ->make(true);

        }
}

