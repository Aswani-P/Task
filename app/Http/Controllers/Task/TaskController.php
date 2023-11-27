<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Jobs\SendQueueEmail;
use App\Mail\SendEmail;
use App\Models\Source;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
    public function list()
    {
        $task = Task::get();
        return DataTables::of($task)
            ->editColumn('source_id', function ($task) {
                return $task->getSources ? $task->getSources->name : '';
            })
            ->editColumn('status', function ($task) {
                if ($task->status == 1)
                    return 'active';
                else {
                    return 'inactive';
                }
            })
            ->addColumn('Action', function ($task) {
                $delete = ' ';
                $edit = '<a href="' . route('tasks.edit', $task->id) . '" class="btn btn-warning" role="button">Update</a>';
                if (auth()->user()->hasRole('admin')) {
                    $delete = '<form action="' . route('delete', ['id' => $task->id]) . '" method="POST" style="display:inline">
                        ' . method_field('DELETE') . '' . csrf_field() . '<button type="submit"class="delete_btn btn btn-danger" onclick="alert_msg()" >Delete</button></form>';
                }
                $view = ' <a href="' . route('view', $task->id) . '"class="btn btn-primary" role="button">View</a>';

                $btn = $edit . $delete . $view;
                //   dd($btn);
                return $btn;
            })
            ->rawColumns(['source_id', 'status', 'Action'])
            ->make(true);
    }

    public function index()
    {

        return view('task.index');
    }

    public function create()
    {
        $source = Source::get();
        return view('task.create', compact('source'));
    }

    public function store(TaskRequest $request)
    {
        // dd($request->all());
        $validate = $request->validated();

        $task = new Task();
        $task->source_id = $request->source_id;
        $task->name = $request->name;
        $task->email = $request->email;
        $task->code = $request->code;
        $task->phone = $request->phone;
        $task->save();

        // if ($task) {

        // $mail_details = [
        //     'subject' => 'successfully submitted your task',

        // ];
        // $job = (new SendQueueEmail($mail_details))
        // 	->delay(now()->addSeconds(2)); 
        //     dispatch($job);

        //     Mail::to($request->email)->send(new SendEmail($mail_details, $task));

        SendQueueEmail::dispatch($task);

        return redirect('tasks')->with('message', 'created successfully');
    }


    public function edit(string $id)
    {
        $tasks = Task::find($id);
        $source = Source::get();

        return view('task.edit', compact('tasks', 'source'));
    }

    public function update(TaskUpdateRequest $request, string $id)
    {
        try {
            $tasks = Task::find($id);
            $tasks->update([
                'name' => request('name'),
                'email' => request('email'),
                'code' => request('code'),
                'phone' => request('phone'),
                'status' => request('status'),
            ]);

            return redirect('tasks')->with('message', 'updated successfully');
        } catch (\Throwable $th) {
            info($th);
        }
    }

    public function delete(Request $request)
    {

        $task = Task::find($request->id);

        $task->delete();

        return redirect('tasks')->with('message', 'deleted successfully');
    }
}
