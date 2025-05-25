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
                    <h3>Presences</h3>
                    <p class="text-subtitle text-muted">Handle employees presences.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Presences</li>
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
                            Data Presences
                        </h5>
                        <a href="{{ route('presences.create') }}" class="btn btn-primary mb-3 ms-auto">
                            <i class="bi bi-plus-circle"></i> New Presence
                        </a>
                    </div>

                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presences as $presence)
                                <tr>
                                    <td>
                                        @if ($presence->employee)
                                            {{ $presence->employee->fullname }}
                                        @else
                                            <span style="color: red;">Deleted Employee</span>
                                        @endif
                                    </td>
                                    <td>{{ $presence->check_in }}</td>
                                    <td>{{ $presence->check_out }}</td>
                                    <td>{{ $presence->date }}</td>
                                    <td>
                                        @if ($presence->status === 'present')
                                            <span class="text-success">{{ ucfirst($presence->status) }}</span>
                                        @elseif ($presence->status === 'absent')
                                            <span class="text-danger">{{ ucfirst($presence->status) }}</span>
                                        @elseif ($presence->status === 'leave')
                                            <span class="text-warning">{{ ucfirst($presence->status) }}</span>
                                        @elseif ($presence->status === 'sick')
                                            <span class="text-info">{{ ucfirst($presence->status) }}</span>
                                        @elseif ($presence->status === 'late')
                                            <span class="text-secondary">{{ ucfirst($presence->status) }}</span>
                                        @else
                                            <span class="text-dark">{{ ucfirst($presence->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="d-flex gap-1">
                                        <a href="{{ route('presences.edit', $presence->id) }}"
                                            class="btn btn-warning btn-sm" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('presences.destroy', $presence->id) }}" method="POST"
                                            class="d-inline delete-form">
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
