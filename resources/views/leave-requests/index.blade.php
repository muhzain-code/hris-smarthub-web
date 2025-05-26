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
                    <h3>Leave Requests</h3>
                    <p class="text-subtitle text-muted">Handle employees leave request.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Leave Requests</li>
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
                            Data Leave Requests
                        </h5>
                        <a href="{{ route('leave-requests.create') }}" class="btn btn-primary mb-3 ms-auto">
                            <i class="bi bi-plus-circle"></i> New Leave Request
                        </a>
                    </div>

                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Leavel Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaveRequests as $leaveRequest)
                                <tr>
                                    <td>
                                        @if ($leaveRequest->employee)
                                            {{ $leaveRequest->employee->fullname }}
                                        @else
                                            <span style="color: red;">Deleted Employee</span>
                                        @endif
                                    </td>
                                    <td>{{ $leaveRequest->leave_type }}</td>
                                    <td>{{ $leaveRequest->start_date }}</td>
                                    <td>{{ $leaveRequest->end_date }}</td>
                                    <td>
                                        @if ($leaveRequest->status === 'pending')
                                            <span class="text-warning">{{ ucfirst($leaveRequest->status) }}</span>
                                        @elseif ($leaveRequest->status === 'approved')
                                            <span class="text-success">{{ ucfirst($leaveRequest->status) }}</span>
                                        @else
                                            <span class="text-danger">{{ ucfirst($leaveRequest->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="d-flex gap-1">
                                        <a href="{{ route('leave-requests.edit', $leaveRequest->id) }}"
                                            class="btn btn-warning btn-sm" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('leave-requests.destroy', $leaveRequest->id) }}"
                                            method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Presence">
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
