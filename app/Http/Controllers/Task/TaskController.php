<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::all();
        return view('task.index', compact('tasks'));
    }

    public function create()
    {
        return view('task.create');
    }

    public function store(TaskRequest $request)
    {

        $validate = $request->validated();
        Task::create($validate);
        return redirect('tasks')->with('message', 'created successfully');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $tasks = Task::find($id);
        return view('task.edit', compact('tasks'));
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
                'status' => request('status')
            ]);
            return redirect('tasks');
        } catch (\Throwable $th) {
            info($th);
        }
    }

    public function destroy(string $id)
    {
        
        $task = Task::find($id);
        // return $tasks;
        $task->delete();
        return redirect('tasks');
    }
}
