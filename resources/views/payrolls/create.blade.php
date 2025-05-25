@extends('layouts.dashboard');

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
                    <h3>Create payroll</h3>
                    <p class="text-subtitle text-muted">Create new payroll.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('payrolls.index') }}">Payrolls</a></li>
                            <li class="breadcrumb-item active" aria-current="page">New Payroll</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    @if ($errors->has('net_pay'))
                        <div class="alert alert-danger">
                            {{ $errors->first('net_pay') }}
                        </div>
                    @endif
                    <form action="{{ route('payrolls.store') }}" method="POST">
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
                            <label for="salary" class="form-label">Salary</label>
                            <input type="number" value="{{ old('salary') }}"
                                class="form-control @error('salary') is-invalid @enderror" name="salary" min="0"
                                step="0.01" placeholder="e.g. 500000">
                            @error('salary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bonuses" class="form-label">Bonuses</label>
                            <input type="number" value="{{ old('bonuses') }}"
                                class="form-control @error('bonuses') is-invalid @enderror" name="bonuses" min="0"
                                step="0.01" placeholder="e.g. 500000">
                            @error('bonuses')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="deductions" class="form-label">Deductions</label>
                            <input type="number" value="{{ old('deductions') }}"
                                class="form-control @error('deductions') is-invalid @enderror" name="deductions"
                                min="0" step="0.01" placeholder="e.g. 500000">
                            @error('deductions')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pay_date" class="form-label">Pay Date</label>
                            <input type="datetime-local" value="{{ old('pay_date') }}" name="pay_date" id="pay_date"
                                class="form-control datetime @error('pay_date') is-invalid @enderror">
                            @error('pay_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('payrolls.index') }}" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-left"></i> Back to List
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Create Payroll
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
