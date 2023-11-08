<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Models\Source;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        // $source = Source::first();
        //    $tasks = Task::first();
        $tasks = Task::get();
        
        $collectionA = collect([1, 2, 3, 4, 5]);
        // $collectionB = collect(["a","b","c"]);
        // $collectionC = $collectionA->concat([$collectionB]);
        // $collectionC->all();
        $getEven = $collectionA->map(function(int $item, int $key){
            if( $item % 2==0){
                return $item;
            }
           
            
        });
       
        $getEven->all();
        //  dd($getEven);
        

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
                'status' => request('status'),
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
