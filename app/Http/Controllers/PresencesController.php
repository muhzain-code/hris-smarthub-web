<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Http\Request;


class PresencesController extends Controller
{
    public function index()
    {
        $presences = Presence::latest()->get();
        return view('presences.index', compact('presences'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('presences.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'check_in' => 'required|date|before_or_equal:check_out',
            'check_out' => 'nullable|date|after_or_equal:check_in',
            'date' => 'required|date|before_or_equal:today',
            'status' => 'required|string|in:present,absent,leave,sick,late',
        ]);


        Presence::create($validated);

        return redirect()->route('presences.index')->with('success', 'Presence created successfully.');
    }

    public function show(Presence $presence)
    {
        $employees = Employee::all();
        return view('presences.show', compact('presence', 'employees'));
    }

    public function edit(Presence $presence)
    {
        $employees = Employee::all();
        return view('presences.edit', compact('presence', 'employees'));
    }

    public function update(Request $request, Presence $presence)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'check_in' => 'required|date|before_or_equal:check_out',
            'check_out' => 'nullable|date|after_or_equal:check_in',
            'date' => 'required|date|before_or_equal:today',
            'status' => 'required|string|in:present,absent,leave,sick,late',
        ]);


        $presence->update($validated);

        return redirect()->route('presences.index')->with('success', 'Presence updated successfully.');
    }

    public function destroy(Presence $presence)
    {
        $presence->delete();

        return redirect()->route('presences.index')->with('success', 'Presence deleted successfully.');
    }
}
