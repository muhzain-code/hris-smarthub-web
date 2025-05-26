<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $leaveRequests = LeaveRequest::latest()->get();

        return view('leave-requests.index', compact('leaveRequests'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('leave-requests.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type' => 'required|string|in:annual,sick,unpaid,emergency',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        LeaveRequest::create($validated);

        return redirect()->route('leave-requests.index')->with('success', 'Leave request created successfully.');
    }

    public function show(LeaveRequest $leaveRequest)
    {
        return view('leave-requests.show', compact('leaveRequest'));
    }

    public function edit(LeaveRequest $leaveRequest)
    {
        $employees = Employee::all();
        return view('leave-requests.edit', compact('leaveRequest', 'employees'));
    }

    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type' => 'required|string|max:50',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        $leaveRequest->update($validated);

        return redirect()->route('leave-requests.index')->with('success', 'Leave request updated successfully.');
    }

    public function destroy(LeaveRequest $leaveRequest)
    {
        $leaveRequest->delete();

        return redirect()->route('leave-requests.index')->with('success', 'Leave request deleted successfully.');
    }
}
