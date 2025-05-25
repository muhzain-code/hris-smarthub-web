<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('tasks.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required|exists:employees,id',
            'due_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:pending,in_progress,done',
        ]);

        Task::create($validated);
        return redirect()->route('tasks.index')->with('success', 'Task Created Successfully');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $employees = Employee::all();

        return view('tasks.edit', compact('task', 'employees'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required|exists:employees,id',
            'due_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:pending,in_progress,done',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task Updated Successfully');
    }

    public function done(int $id)
    {
        $task = Task::find($id);
        $task->update(['status' => 'done']);

        return redirect()->route('tasks.index')->with('success', 'Task Marked as Done ');
    }

    public function pending(int $id)
    {
        $task = Task::find($id);
        $task->update(['status' => 'pending']);

        return redirect()->route('tasks.index')->with('success', 'Task Marked as Pending ');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task Deleted Successfully');
    }
}
