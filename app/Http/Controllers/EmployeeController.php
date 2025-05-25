<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->get();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        $roles = Role::all();
        return view('employees.create', compact('departments', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone_number' => ['required', 'string', 'max:15', 'regex:/^\+?[0-9\s\-]{7,15}$/'],
            'address' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date|before_or_equal:today',
            'hire_date' => 'required|date|before_or_equal:today',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:active,inactive',
            'salary' => 'required|numeric|min:0',
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $roles = Role::all();
        return view('employees.edit', compact('employee', 'departments', 'roles'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone_number' => ['required', 'string', 'max:15', 'regex:/^\+?[0-9\s\-]{7,15}$/'],
            'address' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date|before_or_equal:today',
            'hire_date' => 'required|date|before_or_equal:today',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:active,inactive',
            'salary' => 'required|numeric|min:0',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
