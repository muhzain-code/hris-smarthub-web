<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::latest()->get();
        return view('payrolls.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('payrolls.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'salary' => 'required|numeric|min:0|max:9999999999.99',
            'bonuses' => 'nullable|numeric|min:0|max:9999999999.99',
            'deductions' => 'nullable|numeric|min:0|max:9999999999.99',
            'pay_date' => 'required|date',
        ]);

        $validated['net_pay'] = $validated['salary'] + ($validated['bonuses'] ?? 0) - ($validated['deductions'] ?? 0);

        if ($validated['net_pay'] < 0) {
            return back()
                ->withInput()
                ->withErrors(['net_pay' => 'Net pay cannot be negative. Please review salary, bonuses, and deductions.']);
        }
        
        Payroll::create($validated);

        return redirect()->route('payrolls.index')->with('success', 'Payroll created successfully.');
    }

    public function show(Payroll $payroll)
    {
        return view('payrolls.show', compact('payroll'));
    }

    public function edit(Payroll $payroll)
    {
        $employees = Employee::all();
        return view('payrolls.edit', compact('payroll', 'employees'));
    }

    public function update(Request $request, Payroll $payroll)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'salary' => 'required|numeric|min:0|max:9999999999.99',
            'bonuses' => 'nullable|numeric|min:0|max:9999999999.99',
            'deductions' => 'nullable|numeric|min:0|max:9999999999.99',
            'pay_date' => 'required|date',
        ]);

        $validated['net_pay'] = $validated['salary'] + ($validated['bonuses'] ?? 0) - ($validated['deductions'] ?? 0);

        if ($validated['net_pay'] < 0) {
            return back()
                ->withInput()
                ->withErrors(['net_pay' => 'Net pay cannot be negative. Please review salary, bonuses, and deductions.']);
        }

        $payroll->update($validated);

        return redirect()->route('payrolls.index')->with('success', 'Payroll updated successfully.');
    }

    public function destroy(Payroll $payroll)
    {
        $payroll->delete();
        return redirect()->route('payrolls.index')->with('success', 'Payroll deleted successfully.');
    }
}
