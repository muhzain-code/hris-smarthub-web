<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->text('address');
            $table->date('birth_date');
            $table->date('hire_date');
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->string('status');
            $table->decimal('salary', 10, 2);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assigned_to')->constrained('employees')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->datetime('due_date');
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->decimal('salary', 10, 2);
            $table->decimal('bonuses', 10, 2);
            $table->decimal('deductions', 10, 2);
            $table->decimal('net_salary', 10, 2);
            $table->datetime('pay_date');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->datetime('check_in');
            $table->datetime('check_out');
            $table->date('date');
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->string('leave_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
        Schema::dropIfExists('presences');
        Schema::dropIfExists('payroll');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('roles');
    }
};
