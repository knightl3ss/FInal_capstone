@extends('layout.app')
<link rel="stylesheet" href="{{ asset('css/plantilla.css') }}">

@section('content')
<div class="container-fluid1">


<h2 class="mb-0">Office of the Mayor</h2>

<div class="container-fluid py-4">
    <!-- Recent Transactions Table -->
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0">Office of the Mayor</h5>
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






<h2 class="mb-0">Office of the Mayor</h2>