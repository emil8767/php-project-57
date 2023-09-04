<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskStatus;
use Illuminate\Support\Facades\Gate;

class TaskStatusController extends Controller
{
   

    public function index()
    {
        $statuses = TaskStatus::paginate();
        return view('statuses.index', compact('statuses'));
    }

    public function create(TaskStatus $taskStatus)
    {
        $this->authorize('create', $taskStatus);
        $status = new TaskStatus();
        return view('statuses.create', compact('status'));
    }

    public function store(Request $request)
    {
        $status = new TaskStatus();
        $status->name = $request->input('name');
        $status->save();
        return redirect()
            ->route('task_statuses.index')->with('success','Статус успешно создан');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $status = TaskStatus::findOrFail($id);
        return view('statuses.edit', compact('status'));
        
    }

    public function update(Request $request, TaskStatus $taskStatus)
    {
        $this->authorize('update', $taskStatus);
        $status = TaskStatus::findOrFail($id);
        $status->name = $request->input('name');
        $status->save();
        return redirect()
            ->route('task_statuses.index')->with('success','Статус успешно изменён');

    }

    public function destroy(TaskStatus $taskStatus)
    {
        $this->authorize('delete', $taskStatus);
        $status = TaskStatus::find($id);
        if ($status) {
            $status->delete();
          }
          return redirect()->route('task_statuses.index');
    }
}
