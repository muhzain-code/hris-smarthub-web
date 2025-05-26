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
                    <h3>Edit leave request</h3>
                    <p class="text-subtitle text-muted">Edit new leave request.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('leave-requests.index') }}">Leave Request</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Leave request</li>
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
                    <form action="{{ route('leave-requests.update', $leaveRequest->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Employee</label>
                            <select name="employee_id" id="employee_id"
                                class="form-control @error('employee_id') is-invalid @enderror">
                                <option value="" {{ old('employee_id') ? '' : 'selected' }}>Select an
                                    Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ old('employee_id', $leaveRequest->employee_id) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->fullname }}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="leave_type" class="form-label">Leave Type</label>
                            <select name="leave_type" id="leave_type"
                                class="form-control @error('leave_type') is-invalid @enderror">
                                <option value="" disabled {{ old('leave_type', $leaveRequest->leave_type) ? '' : 'selected' }}>Select type
                                </option>
                                <option value="annual" {{ old('leave_type', $leaveRequest->leave_type) == 'annual' ? 'selected' : '' }}>Annual
                                </option>
                                <option value="sick" {{ old('leave_type', $leaveRequest->leave_type) == 'sick' ? 'selected' : '' }}>
                                    Sick</option>
                                <option value="unpaid" {{ old('leave_type', $leaveRequest->leave_type) == 'unpaid' ? 'selected' : '' }}>Unpaid
                                </option>
                                <option value="emergency" {{ old('leave_type', $leaveRequest->leave_type) == 'emergency' ? 'selected' : '' }}>
                                    Emergency
                                </option>
                            </select>
                            @error('leave_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" value="{{ old('start_date', $leaveRequest->start_date) }}" name="start_date" id="start_date"
                                class="form-control date  @error('start_date') is-invalid @enderror">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="end_date" value="{{ old('end_date', $leaveRequest->end_date) }}" name="end_date" id="end_date"
                                class="form-control date  @error('end_date') is-invalid @enderror">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="pending" {{ old('status', $leaveRequest->status) == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="" {{ old('status', $leaveRequest->status) == 'approved' ? 'selected' : 'approved' }}>
                                    Approved</option>
                                <option value="rejected" {{ old('status', $leaveRequest->status) == 'rejected' ? 'selected' : '' }}>Rejected
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('leave-requests.index') }}" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-left"></i> Back to List
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Update Leave Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
