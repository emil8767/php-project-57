<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Label;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statusId = $request->input('status_id');
        $createdId = $request->input('created_by_id');
        $assignedId = $request->input('assigned_to_id');
        $tasks = Task::orderBy('id')->paginate();
        $statuses = TaskStatus::all()->sortBy('id')
        ->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item['name']];
        })->all();
        $users = User::all()->sortBy('id')
        ->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item['name']];
        })->all();
        if ($statusId || $createdId || $assignedId) {
            $taskQuery = Task::query();
            if ($statusId) {
                $taskQuery->where('status_id', $statusId);
            }
            if ($createdId) {
                $taskQuery->where('created_by_id', $createdId);
            }
            if ($assignedId) {
                $taskQuery->where('assigned_to_id', $assignedId);
            }
            $tasks = $taskQuery->paginate();
            return view('tasks.index', ['statuses' => $statuses, 'tasks' => $tasks, 'users' => $users]);
            
        }        
        return view('tasks.index', ['statuses' => $statuses, 'tasks' => $tasks, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Task $task)
    {
        $this->authorize('create', $task);
        $statuses = TaskStatus::all()->sortBy('id')
        ->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item['name']];
        })->all();
        $users = User::all()->sortBy('id')
        ->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item['name']];
        })->all();
        $labels = Label::all()->sortBy('id')
        ->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item['name']];
        })->all();
             
        return view('tasks.create', ['statuses' => $statuses, 'task' => $task, 'users' => $users, 'labels' => $labels]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->validate($request, [
            'name' => 'required|unique:tasks',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable',
            'description' => 'nullable',
        ]);
        $task = new Task();
        $task->fill($validator);
        $task->created_by_id = intval(Auth::id());
        $task->save();
        $labels = $request->input('label_id');
        $task->labels()->attach($labels);
        return redirect()
        ->route('tasks.index')->with('success','Задача успешно создана');

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        
        return view('tasks.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        
        $this->authorize('update', $task);
        $statuses = TaskStatus::all()->sortBy('id')
        ->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item['name']];
        })->all();
        $users = User::all()->sortBy('id')
        ->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item['name']];
        })->all();
        $labels = Label::all()->sortBy('id')
        ->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item['name']];
        })->all();      
        return view('tasks.edit', ['statuses' => $statuses, 'task' => $task, 'users' => $users, 'labels' => $labels]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validator = $this->validate($request, [
            'name' => 'required|unique:tasks',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable',
            'description' => 'nullable',
            'label_id' => 'nullable',
        ]);
        $task->fill($validator);
        $task->save();
        return redirect()
        ->route('tasks.index')->with('success','Задача успешно изменена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
          
          return redirect()->route('tasks.index');
    }
}
