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
            ['name' => 'HR', 'description' => 'Human Resource', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'IT', 'description' => 'Information Technology', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sales', 'description' => 'Sales and Marketing', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Roles
        DB::table('roles')->insert([
            ['title' => 'HR Specialist', 'description' => 'Manages HR duties', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Software Engineer', 'description' => 'Develops systems', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Sales Executive', 'description' => 'Handles client sales', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Employees
        $employees = [
            ['fullname' => 'Andi Prasetyo', 'email' => 'andi.prasetyo@example.com', 'phone_number' => '081234567890', 'address' => 'Jakarta', 'birth_date' => '1990-03-12', 'hire_date' => '2015-06-01', 'department_id' => 1, 'role_id' => 1, 'status' => 'active', 'salary' => 7000000],
            ['fullname' => 'Budi Santoso', 'email' => 'budi.santoso@example.com', 'phone_number' => '081234567891', 'address' => 'Bandung', 'birth_date' => '1988-07-23', 'hire_date' => '2018-01-15', 'department_id' => 2, 'role_id' => 2, 'status' => 'active', 'salary' => 9000000],
            ['fullname' => 'Citra Dewi', 'email' => 'citra.dewi@example.com', 'phone_number' => '081234567892', 'address' => 'Surabaya', 'birth_date' => '1992-11-05', 'hire_date' => '2020-03-10', 'department_id' => 3, 'role_id' => 3, 'status' => 'active', 'salary' => 8000000],
            ['fullname' => 'Dedi Kurniawan', 'email' => 'dedi.kurniawan@example.com', 'phone_number' => '081234567893', 'address' => 'Yogyakarta', 'birth_date' => '1991-02-17', 'hire_date' => '2017-07-19', 'department_id' => 2, 'role_id' => 2, 'status' => 'active', 'salary' => 8500000],
            ['fullname' => 'Eka Putri', 'email' => 'eka.putri@example.com', 'phone_number' => '081234567894', 'address' => 'Medan', 'birth_date' => '1993-04-09', 'hire_date' => '2021-01-01', 'department_id' => 1, 'role_id' => 1, 'status' => 'active', 'salary' => 6500000],
            ['fullname' => 'Fajar Maulana', 'email' => 'fajar.maulana@example.com', 'phone_number' => '081234567895', 'address' => 'Palembang', 'birth_date' => '1989-12-11', 'hire_date' => '2014-04-20', 'department_id' => 3, 'role_id' => 3, 'status' => 'active', 'salary' => 7800000],
            ['fullname' => 'Gita Sari', 'email' => 'gita.sari@example.com', 'phone_number' => '081234567896', 'address' => 'Semarang', 'birth_date' => '1994-06-18', 'hire_date' => '2019-08-05', 'department_id' => 1, 'role_id' => 1, 'status' => 'active', 'salary' => 6800000],
            ['fullname' => 'Hadi Susanto', 'email' => 'hadi.susanto@example.com', 'phone_number' => '081234567897', 'address' => 'Makassar', 'birth_date' => '1990-09-27', 'hire_date' => '2016-11-11', 'department_id' => 2, 'role_id' => 2, 'status' => 'active', 'salary' => 9100000],
            ['fullname' => 'Intan Permata', 'email' => 'intan.permata@example.com', 'phone_number' => '081234567898', 'address' => 'Denpasar', 'birth_date' => '1995-10-02', 'hire_date' => '2022-05-01', 'department_id' => 3, 'role_id' => 3, 'status' => 'active', 'salary' => 7000000],
            ['fullname' => 'Joko Widodo', 'email' => 'joko.widodo@example.com', 'phone_number' => '081234567899', 'address' => 'Bogor', 'birth_date' => '1987-01-20', 'hire_date' => '2013-12-01', 'department_id' => 2, 'role_id' => 2, 'status' => 'active', 'salary' => 9500000],
        ];

        foreach ($employees as $employee) {
            DB::table('employees')->insert(array_merge($employee, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Tasks
        $tasks = [
            ['title' => 'Monthly Recruitment', 'description' => 'Handle recruitment process', 'assigned_to' => 1, 'due_date' => '2025-06-01', 'status' => 'pending'],
            ['title' => 'Develop API', 'description' => 'Build backend for mobile app', 'assigned_to' => 2, 'due_date' => '2025-05-28', 'status' => 'in progress'],
            ['title' => 'Client Follow-up', 'description' => 'Contact prospective clients', 'assigned_to' => 3, 'due_date' => '2025-06-03', 'status' => 'pending'],
        ];

        foreach ($tasks as $task) {
            DB::table('tasks')->insert(array_merge($task, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Payrolls (1 bulan terakhir)
        foreach (range(1, 10) as $empId) {
            DB::table('payrolls')->insert([
                'employee_id' => $empId,
                'salary' => $employees[$empId - 1]['salary'],
                'bonuses' => 1000000,
                'deductions' => 250000,
                'net_pay' => $employees[$empId - 1]['salary'] + 1000000 - 250000,
                'pay_date' => Carbon::parse('2025-05-24'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Presence (1 hari)
        foreach (range(1, 10) as $empId) {
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

        // Leave Requests
        DB::table('leave_requests')->insert([
            [
                'employee_id' => 4,
                'leave_type' => 'Sick Leave',
                'start_date' => '2025-05-27',
                'end_date' => '2025-05-29',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 5,
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
