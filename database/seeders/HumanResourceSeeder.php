<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HumanResourceSeeder extends Seeder
{
    public function run(): void
    {
        // Departments
        DB::table('departments')->insert([
            ['name' => 'Human Resources', 'description' => 'Handles recruitment, payroll, and employee relations', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Information Technology', 'description' => 'Responsible for software, hardware, and networks', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Marketing & Sales', 'description' => 'Drives product promotion and client acquisition', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Finance', 'description' => 'Manages company finances and reporting', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Roles
        DB::table('roles')->insert([
            ['title' => 'HR', 'description' => 'Manages HR department', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Developer', 'description' => 'Develops and maintains systems', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Sales', 'description' => 'Handles client acquisition and sales', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Finance', 'description' => 'Responsible for financial processes', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Employees
        $employees = [
            ['fullname' => 'Muhammad Zainul Hasan', 'email' => 'mzhasan@gmail.com', 'phone_number' => '081234567890', 'address' => 'Jakarta', 'birth_date' => '1990-03-12', 'hire_date' => '2015-06-01', 'department_id' => 1, 'role_id' => 1, 'status' => 'active', 'salary' => 7000000],
            ['fullname' => 'karyawan1', 'email' => 'karyawan1@gmail.com', 'phone_number' => '081234567891', 'address' => 'Bandung', 'birth_date' => '1988-07-23', 'hire_date' => '2018-01-15', 'department_id' => 2, 'role_id' => 2, 'status' => 'active', 'salary' => 9000000],
            ['fullname' => 'karyawan2', 'email' => 'karyawan2@gmail.com', 'phone_number' => '081234567892', 'address' => 'Surabaya', 'birth_date' => '1992-11-05', 'hire_date' => '2020-03-10', 'department_id' => 3, 'role_id' => 3, 'status' => 'active', 'salary' => 8000000],
            ['fullname' => 'karyawan3', 'email' => 'karyawan3@gmail.com', 'phone_number' => '081234567899', 'address' => 'Bogor', 'birth_date' => '1987-01-20', 'hire_date' => '2013-12-01', 'department_id' => 4, 'role_id' => 4, 'status' => 'active', 'salary' => 9500000],
        ];

        foreach ($employees as $employee) {
            DB::table('employees')->insert(array_merge($employee, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Tasks (assigned to employee_id 1-3)
        $tasks = [
            ['title' => 'Monthly Recruitment', 'description' => 'Handle recruitment process', 'assigned_to' => 1, 'due_date' => '2025-06-01', 'status' => 'pending'],
            ['title' => 'Develop Mobile API', 'description' => 'Build backend for mobile app', 'assigned_to' => 2, 'due_date' => '2025-05-28', 'status' => 'in progress'],
            ['title' => 'Client Outreach Campaign', 'description' => 'Initiate campaign to contact prospective clients', 'assigned_to' => 3, 'due_date' => '2025-06-03', 'status' => 'pending'],
        ];

        foreach ($tasks as $task) {
            DB::table('tasks')->insert(array_merge($task, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Payrolls (employee_id 1–4 only, sesuai jumlah employee)
        foreach (range(1, 4) as $empId) {
            $salary = $employees[$empId - 1]['salary'];
            DB::table('payrolls')->insert([
                'employee_id' => $empId,
                'salary' => $salary,
                'bonuses' => 1000000,
                'deductions' => 250000,
                'net_pay' => $salary + 1000000 - 250000,
                'pay_date' => Carbon::parse('2025-05-24'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Presence (employee_id 1–4 only)
        foreach (range(1, 4) as $empId) {
            DB::table('presences')->insert([
                'employee_id' => $empId,
                'check_in' => Carbon::parse('2025-05-24 09:00:00'),
                'check_out' => Carbon::parse('2025-05-24 17:00:00'),
                'date' => Carbon::parse('2025-05-24'),
                'status' => 'present',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Leave Requests (employee_id 3–4 only)
        DB::table('leave_requests')->insert([
            [
                'employee_id' => 3,
                'leave_type' => 'Sick Leave',
                'start_date' => '2025-05-27',
                'end_date' => '2025-05-29',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 4,
                'leave_type' => 'Annual Leave',
                'start_date' => '2025-06-05',
                'end_date' => '2025-06-10',
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
