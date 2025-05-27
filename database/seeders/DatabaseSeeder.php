<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $users = [
            ['name' => 'Muhammad Zainul Hasan', 'email' => 'mzhasan@gmail.com', 'employee_id' => 1, 'role' => 'HR'],
            ['name' => 'karyawan1', 'email' => 'karyawan1@gmail.com', 'employee_id' => 2, 'role' => 'Developer'],
            ['name' => 'karyawan2', 'email' => 'karyawan2@gmail.com', 'employee_id' => 3, 'role' => 'Sales'],
            ['name' => 'karyawan3', 'email' => 'karyawan3@gmail.com', 'employee_id' => 4, 'role' => 'Finance'],
        ];

        foreach ($users as $data) {
            $user = User::factory()->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'employee_id' => $data['employee_id'],
            ]);
        }

        $this->call([
            HumanResourceSeeder::class
        ]);
    }
}
