@extends('layouts.dashboard')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        @if (session('success'))
            <div id="toast-success" class="toast align-items-center text-bg-success border-0 position-fixed top-0 end-0 m-3"
                role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 1080;">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Payrolls</h3>
                    <p class="text-subtitle text-muted">Handle payrolls salary.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Payrolls</li>
                            <li class="breadcrumb-item active">Index</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h5 class="card-title">
                            Data Payrolls
                        </h5>
                        <a href="{{ route('payrolls.create') }}" class="btn btn-primary mb-3 ms-auto">
                            <i class="bi bi-plus-circle"></i> New Payroll
                        </a>
                    </div>

                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Salary</th>
                                <th>Bonuses</th>
                                <th>Deduction</th>
                                <th>Net Pay</th>
                                <th>Pay Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payrolls as $payroll)
                                <tr>
                                    <td>{{ $payroll->employee->fullname }}</td>
                                    <td>{{ number_format($payroll->salary) }}</td>
                                    <td>{{ number_format($payroll->bonuses) }}</td>
                                    <td>{{ number_format($payroll->deductions) }}</td>
                                    <td>{{ number_format($payroll->net_pay) }}</td>
                                    <td>{{ $payroll->pay_date }}</td>
                                    <td class="d-flex gap-1">
                                        <a href="{{ route('payrolls.show', $payroll->id) }}" class="btn btn-info btn-sm"
                                            title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('payrolls.edit', $payroll->id) }}" class="btn btn-warning btn-sm"
                                            title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('payrolls.destroy', $payroll->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Payroll">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
