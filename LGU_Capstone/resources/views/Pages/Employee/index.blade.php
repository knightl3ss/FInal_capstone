@extends('layout.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="text-primary">Employee Management</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="text-muted">Employee Management</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Employee List</li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-primary">Dashboard</a></li>
                </ol>
            </nav>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route('employee.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Add New Employee
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="card-title m-0">Employees List</h5>
            <div class="input-group w-25">
                <span class="input-group-text bg-light border-0"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control bg-light border-0" id="employeeSearch" placeholder="Search employees...">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle table-striped" id="employeesTable">
                    <thead class="table-light">
                        <tr>
                            <th>Employee ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Age</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                        <tr>
                            <td>{{ $employee->employee_id }}</td>
                            <td>
                                {{ $employee->first_name }} {{ $employee->middle_name ? substr($employee->middle_name, 0, 1) . '. ' : '' }} {{ $employee->last_name }} {{ $employee->extension_name }}
                            </td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone_number }}</td>
                            <td>{{ $employee->address_city }}, {{ $employee->address_state }}</td>
                            <td>{{ $employee->age }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-eye text-primary me-2"></i>View Details
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-edit text-warning me-2"></i>Edit Employee
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <button class="dropdown-item text-danger" 
                                                    onclick="confirmDelete('{{ $employee->id }}', '{{ $employee->first_name }} {{ $employee->last_name }}')">
                                                <i class="fas fa-trash text-danger me-2"></i>Delete Employee
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No employees found</h5>
                                    <p class="text-muted">Start by adding a new employee</p>
                                    <a href="{{ route('employee.create') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus-circle me-2"></i>Add Employee
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteEmployeeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle text-danger fa-4x mb-3"></i>
                <h5>Are you sure you want to delete this employee?</h5>
                <p class="text-muted" id="deleteEmployeeName"></p>
                <p class="text-danger">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteEmployeeForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Employee</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('employeeSearch');
        const table = document.getElementById('employeesTable');
        const rows = table.querySelectorAll('tbody tr');

        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            
            rows.forEach(row => {
                const rowData = row.textContent.toLowerCase();
                row.style.display = rowData.includes(searchTerm) ? '' : 'none';
            });
        });
    });

    // Delete confirmation
    function confirmDelete(employeeId, employeeName) {
        const modal = document.getElementById('deleteEmployeeModal');
        const modalInstance = new bootstrap.Modal(modal);
        
        document.getElementById('deleteEmployeeName').textContent = employeeName;
        document.getElementById('deleteEmployeeForm').action = `/employee/delete/${employeeId}`;
        
        modalInstance.show();
    }
</script>
@endpush 