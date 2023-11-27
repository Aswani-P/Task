<?php

namespace App\Http\Controllers\Task;

use App\Exports\Task\TasksExport;
use App\Http\Controllers\Controller;
use App\Imports\Task\TaskImport;
use App\Models\RoleHasPermission;
use Illuminate\Http\Request;
use App\Models\Task;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
                // dd($request->file_upload);
                // Excel::import(new TaskImport,$request->file_upload,);
                return redirect('tasks')->with('message','imported successfully');
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
                return redirect('tasks')->with('message','failed to import.');

            }

          
        }
        
        
        // $date =now()->format('d-m-y');
        // Excel::import(new TaskImport,'tasks.xslx');
        public function show()
        {
            $roles = Role::get();
            $permissions = Permission::get();
            return view('task.manageRole',compact('roles','permissions'));
        }
        public function store(Request $request)
{
    $role = Role::first();
    $permission = Permission::first();

    if ($role && $permission) {
        RoleHasPermission::updateOrCreate(
            ['role_id' => $role->id, 'permission_id' => $permission->id],
           
        );
    } else {
        return redirect()->route('tasks.index')->with('error', 'Unable to find Role or Permission.');
    }

    return redirect()->route('tasks.index')->with('success', 'Role and permission linked successfully.');
}

    }

