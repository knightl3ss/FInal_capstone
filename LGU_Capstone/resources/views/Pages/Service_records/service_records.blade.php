@extends('layout.app')

@push('styles')
<link href="{{ asset('css/custom-design.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Page Content -->
    <div class="container-fluid px-4 py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="text-primary">Service Records</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="text-muted">Service Records</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Record</li>
                        <li class="breadcrumb-item"><a href="dashboard" class="text-primary">Dashboard</a></li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex align-items-center">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#employeeSelectionModal">
                    <i class="fas fa-plus-circle me-2"></i>Add New Record
                </button>
            </div>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-header bg-white py-3 border-bottom-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0 text-primary">
                        <i class="fas fa-user-friends me-2"></i>Employee Service Records
                    </h4>
                    <div class="input-group" style="max-width: 300px;">
                        <span class="input-group-text bg-light border-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-0 bg-light" placeholder="Search employees..." id="searchEmployee">
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center action-column" style="width: 120px;">Actions</th>
                                <th style="width: 25%;">Employee Name</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>Department</th>
                                <th class="text-center">Record Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center ">
                                    <div class="action-buttons">
                                        <a href="Employee_records" class="btn btn-icon btn-outline-primary" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                    </div>
                                </td>
                                <td>John Doe</td>
                                <td>Male</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>IT Department</td>
                                <td class="text-center">
                                    <a href="Employee_records" class="btn btn-sm btn-primary">
                                        View Full Record
                                    </a>
                                </td>
                            </tr>
                            <!-- More table rows can be added dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Include the new modal -->
    @include('Pages.Service_records.employee_selection_modal')
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchEmployee');
    const tableBody = document.querySelector('.table tbody');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = tableBody.getElementsByTagName('tr');

        Array.from(rows).forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
});

// Employee Action Functions
function editEmployee() {
    Swal.fire({
        title: 'Edit Employee Record',
        html: `
            <input type="text" id="employeeName" class="swal2-input" placeholder="Employee Name">
            <select id="employeeDepartment" class="swal2-input">
                <option value="">Select Department</option>
                <option value="IT">IT Department</option>
                <option value="HR">HR Department</option>
                <option value="Finance">Finance Department</option>
            </select>
        `,
        focusConfirm: false,
        preConfirm: () => {
            const name = document.getElementById('employeeName').value;
            const department = document.getElementById('employeeDepartment').value;
            
            if (!name || !department) {
                Swal.showValidationMessage('Please fill in all fields');
                return false;
            }
            
            return { name, department };
        }
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                icon: 'success',
                title: 'Employee Record Updated',
                text: `Name: ${result.value.name}, Department: ${result.value.department}`
            });
        }
    });
}

function deleteEmployee() {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to delete this employee record?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'The employee record has been deleted.',
                'success'
            );
        }
    });
}
</script>
@endpush