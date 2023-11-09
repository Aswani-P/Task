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



        return view('task.view',compact('task'));
    }
    public function taskPdf($id){
        $task = Task::find($id);
        $date=now()->format('d-m-y');

        $name=$task->name.'-'.$date;
        $pdf = Pdf::loadView('task.pdf',compact('task'));
        return $pdf->stream($name.'.pdf');

    }
    public function taskExport(){
        $date =now()->format('d-m-y');
        return Excel::download(new TasksExport, 'tasks'.$date.'.xlsx'); 
    }
    public function taskImport(){
        $date =now()->format('d-m-y');
        Excel::import(new TaskImport,'tasks'.$date.'.xslx');
    }
}
