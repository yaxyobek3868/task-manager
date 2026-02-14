@extends('layouts.app')

@section('content')

        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="mb-1"><i class="bi bi-list-check text-primary me-2"></i>Vazifalar</h2>
                <p class="text-muted">Barcha vazifalarni boshqaring va kuzating</p>
            </div>
            <div class="col-md-6 text-md-end">
                <button class="btn btn-primary btn-lg">
                        <a href="{{ route ('tasks.create')}}" class="text-white"> + Vazifa yaratish</a>
                </button>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-primary shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Barcha vazifalar</h6>
                                <h2 class="mb-0 fw-bold text-primary">5</h2>
                            </div>
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-list-task fs-2 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-warning shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Kutilmoqda</h6>
                                <h2 class="mb-0 fw-bold text-warning">2</h2>
                            </div>
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-hourglass-split fs-2 text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-info shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Jarayonda</h6>
                                <h2 class="mb-0 fw-bold text-info">2</h2>
                            </div>
                            <div class="bg-info bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-arrow-repeat fs-2 text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-success shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Bajarildi</h6>
                                <h2 class="mb-0 fw-bold text-success">1</h2>
                            </div>
                            <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-check-circle fs-2 text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
