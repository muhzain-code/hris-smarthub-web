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
                    <h3>Detail task</h3>
                    <p class="text-subtitle text-muted">Detail task.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
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

                    <div class="mb-3">
                        <label class="form-label"><strong>Title:</strong></label>
                        <p>{{ $task->title }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Description:</strong></label>
                        <p>{{ $task->description }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Status:</strong></label>
                        <p>{{ $task->status }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Due Date:</strong></label>
                        <p>{{ $task->due_date }}</p>
                    </div>

                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
