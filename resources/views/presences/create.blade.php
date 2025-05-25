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
                    <h3>Create presence</h3>
                    <p class="text-subtitle text-muted">Create new presence.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('presences.index') }}">Presences</a></li>
                            <li class="breadcrumb-item active" aria-current="page">New Presence</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('presences.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Employee</label>
                            <select name="employee_id" id="employee_id"
                                class="form-control @error('employee_id') is-invalid @enderror">
                                <option value="" {{ old('employee_id') ? '' : 'selected' }}>Select an
                                    Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->fullname }}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="check_in" class="form-label">Check In</label>
                            <input type="datetime-local" value="{{ old('check_in') }}" name="check_in" id="check_in"
                                class="form-control datetime  @error('check_in') is-invalid @enderror">
                            @error('check_in')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="check_out" class="form-label">Check Out</label>
                            <input type="datetime-local" value="{{ old('check_out') }}" name="check_out" id="check_out"
                                class="form-control datetime  @error('check_out') is-invalid @enderror">
                            @error('check_out')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="datetime-local" value="{{ old('date') }}" name="date" id="date"
                                class="form-control date  @error('date') is-invalid @enderror">
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="present" {{ old('status') == 'present' ? 'selected' : '' }}>Present</option>
                                <option value="absent" {{ old('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                                <option value="sick" {{ old('status') == 'sick' ? 'selected' : '' }}>Sick</option>
                                <option value="leave" {{ old('status') == 'leave' ? 'selected' : '' }}>Leave</option>
                                <option value="late" {{ old('status') == 'late' ? 'selected' : '' }}>Late</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('presences.index') }}" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-left"></i> Back to List
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Create Presence
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
