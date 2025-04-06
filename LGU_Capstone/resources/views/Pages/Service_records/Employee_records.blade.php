@extends('layout.app')

@push('styles')
<style>
    /* Enhanced Responsive Design */
    :root {
        --primary-color: #2575fc;
        --secondary-color: #6a11cb;
        --light-bg: #f8f9fa;
        --text-color: #333;
    }

    .employee-record-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 1rem;
    }

    .header-container {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .header-container h1 {
        color: white;
        margin-bottom: 0;
        font-weight: 600;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
    }

    .employee-details-card {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .employee-details-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background-color: var(--light-bg);
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .service-record-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.9rem;
        border: 1px solid black;
        border-collapse: collapse;
    }

    .service-record-table thead {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
    }

    .service-record-table thead tr:first-child th {
        padding: 0.75rem;
        text-align: center;
        vertical-align: middle;
        border: 1px solid rgba(255, 255, 255, 0.2);
        font-weight: 600;
        border: 1px solid black;
    }

    .service-record-table thead tr:nth-child(2) th {
        padding: 0.5rem;
        font-size: 0.8rem;
        background-color: rgba(255,255,255,0.1);
        border: 1px solid black;
    }

    .service-record-table tbody td {
        padding: 0.6rem;
        text-align: center;
        border: 1px solid #e9ecef;
        vertical-align: middle;
        border: 1px solid black;
    }

    .service-record-table tbody tr {
        transition: background-color 0.3s ease;
    }

    .service-record-table tbody tr:hover {
        background-color: rgba(37, 117, 252, 0.05);
    }

    .status-badge {
        display: inline-block;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.7rem;
        min-width: 100px;
    }

    .status-badge.in-service {
        background-color: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }

    .status-badge.suspension {
        background-color: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }

    .status-badge.not-in-service {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    


    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .service-record-table {
            font-size: 0.8rem;
        }

        .service-record-table thead tr:first-child th,
        .service-record-table thead tr:nth-child(2) th,
        .service-record-table tbody td {
            padding: 0.4rem;
        }
    }

    @media (max-width: 768px) {
        .service-record-table {
            font-size: 0.7rem;
        }

        .service-record-table thead tr:first-child th {
            font-size: 0.7rem;
        }

        .header-container {
            flex-direction: column;
            text-align: center;
        }

        .action-buttons {
            flex-direction: column;
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
    <div class="container-fluid employee-record-container">
        <div class="header-container d-flex justify-content-between align-items-center">
        <div class="header-container d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
            <h1 class="page-title mb-2 mb-md-0">
                <i class="fas fa-user-tie me-2"></i>Employee Record
            </h1>
            </div>
            <div class="action-buttons">
                <a href="service_records" class="btn btn-outline-light">
                    <i class="fas fa-arrow-left me-2"></i>Return to List
                </a>
                <button class="btn btn-light text-primary" onclick="window.location.href='{{ route('print_employee_records') }}'">
                    <i class="fas fa-print me-2"></i>Print Employee Records
                </button>
            </div>
        </div>

        <div class="card employee-details-card">
            <div class="employee-details-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h3 class="employee-name mb-2 mb-md-0">
                    Name: Prince
                </h3>
                <button class="btn btn-primary btn-responsive" data-bs-toggle="modal" data-bs-target="#updateEmployeeModal">
                    <i class="fas fa-edit me-2"></i>Update Details
                </button>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table service-record-table">
                        <thead>
                            <tr>
                                <th colspan="2" style="border: 1px solid black;">Service</th>
                                <th colspan="3" style="border: 1px solid black;">Record of Appointment</th>
                                <th colspan="4" style="border: 1px solid black;">Office Entity/Leave Division Absence</th>
                                <th rowspan="2" style="border: 1px solid black;">Separation Date</th>
                                <th rowspan="2" style="border: 1px solid black;">Status</th>
                            </tr>
                            <tr>
                                <th colspan="2" style="border: 1px solid black;">Inclusive Dates</th>
                                <th style="border: 1px solid black;">Designation</th>
                                <th style="border: 1px solid black;">Status Salary</th>
                                <th style="border: 1px solid black;">Salary Per Annum</th>
                                <th style="border: 1px solid black;">Station Place</th>
                                <th colspan="2" style="border: 1px solid black;">Branch</th>
                                <th style="border: 1px solid black;">Without Pay</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: 1px solid black;">6/15/98</td>
                                <td style="border: 1px solid black;">12/31/98</td>
                                <td style="border: 1px solid black;">IT</td>
                                <td style="border: 1px solid black;">Perm./Mo</td>
                                <td style="border: 1px solid black;">100,000</td>
                                <td style="border: 1px solid black;">RHU</td>
                                <td style="border: 1px solid black;">Magallanes</td>
                                <td style="border: 1px solid black;">Agusan del Norte</td>
                                <td style="border: 1px solid black;">-</td>
                                <td style="border: 1px solid black;">-</td>
                                <td style="border: 1px solid black;">
                                    <span class="status-badge in-service">
                                        In Service
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">1/1/99</td>
                                <td style="border: 1px solid black;">12/31/99</td>
                                <td style="border: 1px solid black;">IT</td>
                                <td style="border: 1px solid black;">Perm./Mo</td>
                                <td style="border: 1px solid black;">122,000</td>
                                <td style="border: 1px solid black;">RHU</td>
                                <td style="border: 1px solid black;">Magallanes</td>
                                <td style="border: 1px solid black;">Agusan del Norte</td>
                                <td style="border: 1px solid black;">-</td>
                                <td style="border: 1px solid black;">-</td>
                                <td style="border: 1px solid black;">
                                    <span class="status-badge suspension">
                                        Suspension
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">1/1/00</td>
                                <td style="border: 1px solid black;">8/31/00</td>
                                <td style="border: 1px solid black;">IT</td>
                                <td style="border: 1px solid black;">Perm./Mo</td>
                                <td style="border: 1px solid black;">150,000</td>
                                <td style="border: 1px solid black;">RHU</td>
                                <td style="border: 1px solid black;">Magallanes</td>
                                <td style="border: 1px solid black;">Agusan del Norte</td>
                                <td style="border: 1px solid black;">-</td>
                                <td style="border: 1px solid black;">-</td>
                                <td style="border: 1px solid black;">
                                    <span class="status-badge not-in-service">
                                        Not in Service
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const updateButton = document.querySelector('.btn-primary.btn-responsive');
    
    updateButton.addEventListener('click', function() {
        Swal.fire({
            title: 'Update Employee Details',
            html: `
                <input type="text" id="employeeName" class="swal2-input" placeholder="Employee Name">
                <input type="text" id="employeeDesignation" class="swal2-input" placeholder="Designation">
            `,
            focusConfirm: false,
            preConfirm: () => {
                const name = document.getElementById('employeeName').value;
                const designation = document.getElementById('employeeDesignation').value;
                
                if (!name || !designation) {
                    Swal.showValidationMessage('Please fill in all fields');
                }
                
                return { name, designation };
            }
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    icon: 'success',
                    title: 'Details Updated',
                    text: `Name: ${result.value.name}, Designation: ${result.value.designation}`
                });
            }
        });
    });
});
</script>
@endpush