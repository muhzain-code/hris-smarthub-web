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
                    <h3>Detail Payroll</h3>
                    <p class="text-subtitle text-muted">Detail payroll data.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('payrolls.index') }}">Payrolls</a></li>
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

                    <div class="row" id="print-area">
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Employee</strong></label>
                            <p>{{ $payroll->employee->fullname }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Salary</strong></label>
                            <p>Rp {{ number_format($payroll->salary, 0, ',', '.') }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Bonuses</strong></label>
                            <p>Rp {{ number_format($payroll->bonuses, 0, ',', '.') }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Deductions</strong></label>
                            <p>Rp {{ number_format($payroll->deductions, 0, ',', '.') }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Net Pay</strong></label>
                            <p>Rp {{ number_format($payroll->net_pay, 0, ',', '.') }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Pay Date</strong></label>
                            <p>{{ $payroll->pay_date }}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('payrolls.index') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left"></i> Back to List
                        </a>
                        <button type="submit" class="btn btn-primary" id="btn-print"><span
                                class="bi bi-printer">Print</span>
                        </button>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <script>
        document.getElementById('btn-print').addEventListener('click', function() {
            let printContent = document.getElementById('print-area').innerHTML
            let originalContent = document.body.innerHTML

            document.body.innerHTML = printContent

            window.print()
            document.body.innerHTML = originalContent
        })
    </script>
@endsection
