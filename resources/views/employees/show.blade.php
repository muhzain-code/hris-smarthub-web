@extends('layouts.dashboard')

@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Employee</h3>
                <p class="text-subtitle text-muted">Detail employee data.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Employees</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Fullname</strong></label>
                        <p>{{ $employee->fullname }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Email</strong></label>
                        <p>{{ $employee->email }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Phone Number</strong></label>
                        <p>{{ $employee->phone_number }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Address</strong></label>
                        <p>{{ $employee->address }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Birth Date</strong></label>
                        <p>{{ $employee->birth_date }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Hire Date</strong></label>
                        <p>{{ $employee->hire_date }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Department</strong></label>
                        <p>{{ $employee->department->name }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Role</strong></label>
                        <p>{{ $employee->role->title }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Salary</strong></label>
                        <p>{{ $employee->salary }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Status</strong></label>
                        <p>{{ $employee->status }}</p>
                    </div>
                </div>

                <a href="{{ route('tasks.index') }}" class="btn btn-secondary mt-3">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
