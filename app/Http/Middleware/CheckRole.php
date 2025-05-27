<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $employeeId = Auth::user()->employee_id;
        $employee = Employee::find($employeeId);

        $request->session()->put('role', $employee->role->title);

        if(!in_array($employee->role->title, $roles)) {
            abort(403, 'Unauthorized action');
        }

        return $next($request);
    }
}
