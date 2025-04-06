@extends('layout.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Statistics Cards Row -->
    <div class="row g-3 mb-4">
        <!-- Admin Card -->
        <div class="col-md-2">
            <div class="card h-100 bg-light stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-user-shield text-primary"></i>
                        </div>
                        <div>
                            <h3 class="mb-0">1</h3>
                            <p class="text-muted mb-0">Admin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Male Card -->
        <div class="col-md-2">
            <div class="card h-100 bg-light stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                            <i class="fas fa-male text-warning"></i>
                        </div>
                        <div>
                            <h3 class="mb-0">20</h3>
                            <p class="text-muted mb-0">Male</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Female Card -->
        <div class="col-md-2">
            <div class="card h-100 bg-light stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                            <i class="fas fa-female text-danger"></i>
                        </div>
                        <div>
                            <h3 class="mb-0">15</h3>
                            <p class="text-muted mb-0">Female</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Permanent Employee Card -->
        <div class="col-md-2">
            <div class="card h-100 bg-light stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                            <i class="fas fa-user-tie text-success"></i>
                        </div>
                        <div>
                            <h3 class="mb-0">15</h3>
                            <p class="text-muted mb-0">Permanent</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Elected Employee Card -->
        <div class="col-md-2">
            <div class="card h-100 bg-light stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                            <i class="fas fa-vote-yea text-info"></i>
                        </div>
                        <div>
                            <h3 class="mb-0">10</h3>
                            <p class="text-muted mb-0">Elected</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction Card -->
        <div class="col-md-2">
            <div class="card h-100 bg-light stat-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-secondary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-exchange-alt text-secondary"></i>
                        </div>
                        <div>
                            <h3 class="mb-0">1000</h3>
                            <p class="text-muted mb-0">Transaction</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions Table -->
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0">Recent Transaction</h5>
            <div class="d-flex gap-2">
                <button class="btn btn-light btn-sm">
                    <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-light btn-sm">
                    <i class="fas fa-filter"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee</th>
                            <th>Transaction Date</th>
                            <th>Gender</th>
                            <th>Status Salary</th>
                            <th>Status</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Prince</td>
                            <td>01-10-2021</td>
                            <td>Male</td>
                            <td>Permanent Employee</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>Admin2</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Kenny</td>
                            <td>01-10-2021</td>
                            <td>Female</td>
                            <td>Permanent Employee</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>Admin1</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Narisma</td>
                            <td>01-10-2021</td>
                            <td>Male</td>
                            <td>Permanent Employee</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>Admin1</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border: none;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .stat-card {
        border-radius: 10px;
    }
    .status-badge {
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 12px;
    }
    .status-active {
        background-color: #34c759;
        color: #fff;
    }
</style>
@endpush