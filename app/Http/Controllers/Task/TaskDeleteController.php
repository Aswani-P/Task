<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskDeleteController extends Controller
{
    public function delete_data(Request $request)
    {
        // dd($request->all());
        // $id = $request->id;
        $id = 
        $task = Task::find($id);
        // dd($task);
        $task->delete();
        $msg = 'successfully deleted';

        return redirect('tasks');

    }
}
