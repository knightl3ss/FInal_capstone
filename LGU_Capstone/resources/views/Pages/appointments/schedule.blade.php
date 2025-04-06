@extends('Layout.app')

@section('title', 'Appointment Schedule')

@section('content')
<style>
    .status-ongoing {
        background-color: #DEF7EC;
        color: #046C4E;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .status-retired {
        background-color: #FEF3C7;
        color: #92400E;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .btn-edit {
        background-color: #EBF5FF;
        color: #1E40AF;
        border: 1px solid #BFDBFE;
        transition: all 0.2s;
    }

    .btn-edit:hover {
        background-color: #DBEAFE;
    }

    .btn-remove {
        background-color: #FEE2E2;
        color: #B91C1C;
        border: 1px solid #FECACA;
        transition: all 0.2s;
    }

    .btn-remove:hover {
        background-color: #FEE2E2;
    }
</style>

<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="text-primary">Appointment Schedule</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('appointments') }}" class="text-muted">Appointment</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Schedule</li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-primary">Dashboard</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Page Content with Action Buttons -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <h5 class="card-title mb-3 mb-md-0 fw-bold text-dark">Appointment Schedule</h5>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addSchedModal" onclick="setAppointmentType('job_order')">
                        <i class="fas fa-plus-circle me-2"></i> Add Job Order
                    </button>
                    <button type="button" class="btn btn-outline-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addSchedModal" onclick="setAppointmentType('permanent')">
                        <i class="fas fa-plus-circle me-2"></i> Add Permanent
                    </button>
                    <button type="button" class="btn btn-outline-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addSchedModal" onclick="setAppointmentType('temporary')">
                        <i class="fas fa-plus-circle me-2"></i> Add Temporary
                    </button>
                </div>
            </div>
        </div>

        <!-- Filter Controls -->
        <div class="card-header bg-light py-3 border-top">
            <div class="d-flex align-items-center">
                <label for="appointmentTypeFilter" class="form-label fw-medium text-dark me-3 mb-0">Filter by appointment type:</label>
                <select class="form-select" id="appointmentTypeFilter" style="max-width: 200px;">
                    <option value="" {{ is_null($appointmentType) ? 'selected' : '' }}>All Types</option>
                    <option value="permanent" {{ $appointmentType == 'permanent' ? 'selected' : '' }}>Permanent</option>
                    <option value="temporary" {{ $appointmentType == 'temporary' ? 'selected' : '' }}>Temporary</option>
                    <option value="job_order" {{ $appointmentType == 'job_order' ? 'selected' : '' }}>Job Order</option>
                </select>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="px-3 py-3">#</th>
                            <th scope="col" class="px-3 py-3">Name</th>
                            <th scope="col" class="px-3 py-3">Position</th>
                            <th scope="col" class="px-3 py-3">Rate/Day</th>
                            <th scope="col" class="px-3 py-3">Period of Employment</th>
                            <th scope="col" class="px-3 py-3">Source of Fund</th>
                            <th scope="col" class="px-3 py-3">Office Assignment</th>
                            <th scope="col" class="px-3 py-3">Status</th>
                            <th scope="col" class="px-3 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $index => $appointment)
                        <tr>
                            <td class="px-3 py-3">{{ $index + 1 }}</td>
                            <td class="px-3 py-3 fw-medium">{{ $appointment->name }}</td>
                            <td class="px-3 py-3">{{ $appointment->position }}</td>
                            <td class="px-3 py-3">₱{{ number_format($appointment->rate_per_day, 2) }}/day</td>
                            <td class="px-3 py-3">
                                {{ \Carbon\Carbon::parse($appointment->employment_start)->format('M d, Y') }} to
                                {{ \Carbon\Carbon::parse($appointment->employment_end)->format('M d, Y') }}
                            </td>
                            <td class="px-3 py-3">{{ $appointment->source_of_fund }}</td>
                            <td class="px-3 py-3">{{ $appointment->office_assignment }}</td>
                            <td class="px-3 py-3">
                                @php
                                $currentDate = \Carbon\Carbon::now();
                                $employmentEndDate = \Carbon\Carbon::parse($appointment->employment_end);
                                $status = $currentDate->greaterThan($employmentEndDate) ? 'Retired' : 'Ongoing';
                                @endphp
                                <span class="{{ $status == 'Ongoing' ? 'status-ongoing' : 'status-retired' }}">{{ $status }}</span>
                            </td>
                            <td class="px-3 py-3">
                                <div class="d-flex gap-2">
                                    <button onclick="toggleEditModal(this)"
                                        class="btn-edit px-3 py-1 rounded text-sm fw-medium"
                                        data-id="{{ $appointment->id }}"
                                        data-name="{{ $appointment->name }}"
                                        data-position="{{ $appointment->position }}"
                                        data-rate_per_day="{{ $appointment->rate_per_day }}"
                                        data-employment_start="{{ $appointment->employment_start }}"
                                        data-employment_end="{{ $appointment->employment_end }}"
                                        data-source_of_fund="{{ $appointment->source_of_fund }}"
                                        data-office_assignment="{{ $appointment->office_assignment }}"
                                        data-appointment_type="{{ $appointment->appointment_type }}">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </button>

                                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-remove px-3 py-1 rounded text-sm fw-medium" onclick="return confirm('Are you sure you want to delete this appointment?');">
                                            <i class="fas fa-trash-alt me-1"></i> Remove
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Adding Schedule -->
<div id="addSchedModal" class="modal fade" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <form action="{{ route('appointment.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="appointment_type" id="appointment_type" value="">
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="name" class="form-label">Employee Name</label>
                            <select name="name" id="name" class="form-select" required>
                                <option value="">Select Employee</option>
                                @foreach($employees as $employee)
                                    @php 
                                        $fullName = $employee->getFullNameAttribute();
                                        // Normalize the name for comparison
                                        $isAppointed = false;
                                        
                                        // Check each appointed employee name
                                        foreach ($appointedEmployeeNames as $appointedName) {
                                            // If there's an exact match or a close match after normalization
                                            if ($appointedName == $fullName || 
                                                strtolower(trim($appointedName)) == strtolower(trim($fullName))) {
                                                $isAppointed = true;
                                                break;
                                            }
                                        }
                                    @endphp
                                    @if(!$isAppointed)
                                        <option value="{{ $fullName }}">{{ $fullName }} ({{ $employee->employee_id }})</option>
                                    @endif
                                @endforeach
                            </select>
                            <small class="text-muted">Only showing employees without existing appointments</small>
                            
                        </div>
                        <div class="col-md-6">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" name="position" id="position" class="form-control" placeholder="Enter position" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="rate_per_day" class="form-label">Rate/Day</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="number" name="rate_per_day" id="rate_per_day" class="form-control" placeholder="0.00" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Period of Employment</label>
                            <div class="row">
                                <div class="col-6">
                                    <label for="employment_start" class="form-label form-label-sm text-muted">From</label>
                                    <input type="date" name="employment_start" id="employment_start" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <label for="employment_end" class="form-label form-label-sm text-muted">To</label>
                                    <input type="date" name="employment_end" id="employment_end" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="source_of_fund" class="form-label">Source of Fund</label>
                            <input type="text" name="source_of_fund" id="source_of_fund" class="form-control" placeholder="Enter source of fund" required>
                        </div>
                        <div class="col-md-6">
                            <label for="office_assignment" class="form-label">Office Assignment</label>
                            <input type="text" name="office_assignment" id="office_assignment" class="form-control" placeholder="Enter office assignment" required>
                        </div>
                    </div>
                    
                    <div class="modal-footer px-0 pb-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save Appointment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Editing Schedule -->
<div id="editSchedModal" class="modal fade" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <form id="editAppointmentForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="scheduleId">
                    <input type="hidden" name="appointment_type" id="edit_appointment_type" value="">
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="appointmentName" class="form-label">Employee Name</label>
                            <select name="name" id="appointmentName" class="form-select" required data-appointment-id="">
                                <option value="">Select Employee</option>
                                @foreach($employees as $employee)
                                    @php 
                                        $fullName = $employee->getFullNameAttribute();
                                        // Check if employee is appointed in any appointment
                                        $isAppointed = false;
                                        $appointmentId = null;
                                        
                                        // Check each appointed employee name
                                        foreach ($appointedEmployees as $appointedEmployee) {
                                            // If there's an exact match or a close match after normalization
                                            if ($appointedEmployee->name == $fullName || 
                                                strtolower(trim($appointedEmployee->name)) == strtolower(trim($fullName))) {
                                                $isAppointed = true;
                                                $appointmentId = $appointedEmployee->id;
                                                break;
                                            }
                                        }
                                    @endphp
                                    <option value="{{ $fullName }}" {{ $isAppointed ? 'data-appointment-id="'.$appointmentId.'"' : '' }}>
                                        {{ $fullName }} ({{ $employee->employee_id }}){{ $isAppointed ? ' - Already Appointed' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">When editing, all employees are shown. The current employee's "Already Appointed" status will be ignored.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="appointmentPosition" class="form-label">Position</label>
                            <input type="text" name="position" id="appointmentPosition" class="form-control" placeholder="Enter position" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="appointmentRatePerDay" class="form-label">Rate/Day</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="number" name="rate_per_day" id="appointmentRatePerDay" class="form-control" placeholder="0.00" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Period of Employment</label>
                            <div class="row">
                                <div class="col-6">
                                    <label for="appointmentEmploymentStart" class="form-label form-label-sm text-muted">From</label>
                                    <input type="date" name="employment_start" id="appointmentEmploymentStart" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <label for="appointmentEmploymentEnd" class="form-label form-label-sm text-muted">To</label>
                                    <input type="date" name="employment_end" id="appointmentEmploymentEnd" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="appointmentSourceOfFund" class="form-label">Source of Fund</label>
                            <input type="text" name="source_of_fund" id="appointmentSourceOfFund" class="form-control" placeholder="Enter source of fund" required>
                        </div>
                        <div class="col-md-6">
                            <label for="appointmentOfficeAssignment" class="form-label">Office Assignment</label>
                            <input type="text" name="office_assignment" id="appointmentOfficeAssignment" class="form-control" placeholder="Enter office assignment" required>
                        </div>
                    </div>
                    
                    <div class="modal-footer px-0 pb-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Set the appointment type for the modal
    function setAppointmentType(type) {
        document.getElementById('appointment_type').value = type;
    }

    // Handle edit modal
    function toggleEditModal(button) {
        if (!button) return;
        
        // Set edit form data
        const form = document.getElementById('editAppointmentForm');
        const modal = document.getElementById('editSchedModal');
        
        const id = button.getAttribute('data-id');
        form.action = "{{ route('appointments.update', '') }}/" + id;
        
        document.getElementById('scheduleId').value = id;
        
        // Set the current appointment ID in the select element for reference
        const appointmentNameSelect = document.getElementById('appointmentName');
        appointmentNameSelect.setAttribute('data-current-id', id);
        
        // Set employee name dropdown - find and select the matching employee
        const employeeName = button.getAttribute('data-name');
        const options = appointmentNameSelect.options;
        
        let found = false;
        for (let i = 0; i < options.length; i++) {
            const option = options[i];
            
            // Show "Already Appointed" only for employees in other appointments
            const appointmentId = option.getAttribute('data-appointment-id');
            if (appointmentId && appointmentId !== id) {
                option.text = option.text; // Keep the text as is
            } else if (appointmentId && appointmentId === id) {
                // This is the current appointment's employee - remove "Already Appointed" text
                option.text = option.text.replace(' - Already Appointed', '');
            }
            
            if (option.value === employeeName) {
                option.selected = true;
                found = true;
            }
        }
        
        // If no match is found in the dropdown, add the current name as an option
        if (!found && employeeName) {
            const newOption = new Option(employeeName, employeeName);
            appointmentNameSelect.add(newOption);
            newOption.selected = true;
        }
        
        document.getElementById('appointmentPosition').value = button.getAttribute('data-position');
        document.getElementById('appointmentRatePerDay').value = button.getAttribute('data-rate_per_day');
        document.getElementById('appointmentEmploymentStart').value = button.getAttribute('data-employment_start');
        document.getElementById('appointmentEmploymentEnd').value = button.getAttribute('data-employment_end');
        document.getElementById('appointmentSourceOfFund').value = button.getAttribute('data-source_of_fund');
        document.getElementById('appointmentOfficeAssignment').value = button.getAttribute('data-office_assignment');
        document.getElementById('edit_appointment_type').value = button.getAttribute('data-appointment_type');
        
        // Show the modal using Bootstrap's native API
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
    }

    // Initialize on DOM loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Ensure Bootstrap is loaded properly
        if (typeof bootstrap !== 'undefined') {
            console.log('Bootstrap is loaded correctly');
            
            // Initialize the modals properly
            const addModal = document.getElementById('addSchedModal');
            const editModal = document.getElementById('editSchedModal');
            
            // Make sure modal dismiss works for all buttons
            document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    const modal = this.closest('.modal');
                    const bsModal = bootstrap.Modal.getInstance(modal);
                    if (bsModal) {
                        bsModal.hide();
                    }
                });
            });
        } else {
            console.error('Bootstrap is not defined. Modal functionality may not work properly.');
        }
        
        // Initialize appointment type filter
        document.getElementById('appointmentTypeFilter').addEventListener('change', function() {
            const selectedType = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set('appointment_type', selectedType);
            window.location.href = url.toString();
        });

        // Add search functionality to employee dropdown selects
        function setupEmployeeSearch(selectElementId) {
            const selectElement = document.getElementById(selectElementId);
            if (!selectElement) return;
            
            // Store all options for searching
            const allOptions = Array.from(selectElement.options);
            
            // Create search input
            const searchWrapper = document.createElement('div');
            searchWrapper.className = 'input-group mb-2';
            
            const searchIcon = document.createElement('span');
            searchIcon.className = 'input-group-text';
            searchIcon.innerHTML = '<i class="fas fa-search"></i>';
            
            const searchInput = document.createElement('input');
            searchInput.type = 'text';
            searchInput.className = 'form-control';
            searchInput.placeholder = 'Search employees...';
            
            searchWrapper.appendChild(searchIcon);
            searchWrapper.appendChild(searchInput);
            
            // Insert search before select
            selectElement.parentNode.insertBefore(searchWrapper, selectElement);
            
            // Add search functionality
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                // First option (placeholder) should always be visible
                const placeholderOption = allOptions[0];
                
                // Filter options
                selectElement.innerHTML = '';
                selectElement.appendChild(placeholderOption);
                
                // For edit form, show all employees, for add form, only show unassigned ones
                if (selectElementId === 'appointmentName') {
                    // For edit form - show all employees but mark appointed ones
                    allOptions.slice(1).forEach(option => {
                        if (option.text.toLowerCase().includes(searchTerm)) {
                            selectElement.appendChild(option.cloneNode(true));
                        }
                    });
                } else {
                    // For add form - only show unassigned employees
                    allOptions.slice(1).forEach(option => {
                        // In the add form, only show options that aren't already appointed
                        const isAppointed = option.hasAttribute('data-appointment-id');
                        if (option.text.toLowerCase().includes(searchTerm) && !isAppointed) {
                            selectElement.appendChild(option.cloneNode(true));
                        }
                    });
                }
            });
        }
        
        // Setup search for both dropdowns
        setupEmployeeSearch('name');
        setupEmployeeSearch('appointmentName');
    });
</script>
@endsection