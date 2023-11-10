<?php

namespace App\Http\Controllers\Task;

use App\Exports\Task\TasksExport;
use App\Http\Controllers\Controller;
use App\Imports\Task\TaskImport;
use Illuminate\Http\Request;
use App\Models\Task;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class TaskPdfController extends Controller
{
    public function view(Request $request)
    {

        $id = request('id');
        // dd($id);
        $task = Task::find($id);
        // dd($task);

        return view('task.view', compact('task'));
    }
    public function taskPdf($id)
    {
        $task = Task::find($id);
        $date = now()->format('d-m-y');

        $name = $task->name . '-' . $date;
        $pdf = Pdf::loadView('task.pdf', compact('task'));
        return $pdf->stream($name . '.pdf');
    }

    public function taskExport()
    {
        $date = now()->format('d-m-y');
        return Excel::download(new TasksExport, 'tasks' . $date . '.xlsx');
    }
    public function taskImport(Request $request)
    {
        try
        {
            if ($request->file('file_upload')) 
            {
                (new TaskImport)->import($request->file_upload, null, \Maatwebsite\Excel\Excel::XLSX);
                // Excel::import(new TaskImport,$request->file_upload,);
            }
        }
        catch(\Maatwebsite\Excel\Validators\ValidationException $e)
            {
                $error_msg ="";
                $failures = $e->failures();
                foreach ($failures as $failure) {
                   // row that went wrong
                   $error_msg= $error_msg. $failure->errors()[0]; // Actual error messages from Laravel validator
                    $failure->values(); // The values of the row that has failed.
                }
                return redirect('tasks')->with('message',$error_msg);

            }

          
        }
        
        
        // $date =now()->format('d-m-y');
        // Excel::import(new TaskImport,'tasks.xslx');
    
    }

