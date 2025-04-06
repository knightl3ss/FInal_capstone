@extends('layout.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="text-primary">Add New Employee</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="text-muted">Employee Management</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Employee</li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-primary">Dashboard</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="card-title m-0">Employee Information</h5>
        </div>
        <div class="card-body">
            <form id="addEmployeeForm" action="{{ route('employee.store') }}" method="POST">
                @csrf
                
                <!-- Personal Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="border-bottom pb-2 mb-3">Personal Details</h6>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="firstName" class="form-label">First Name*</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="middleName" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middleName" name="middle_name">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="lastName" class="form-label">Last Name*</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="extensionName" class="form-label">Name Extension</label>
                        <input type="text" class="form-control" id="extensionName" name="extension_name" placeholder="e.g. Jr., Sr., III">
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="gender" class="form-label">Gender*</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="" disabled selected>Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="dob" class="form-label">Date of Birth*</label>
                        <input type="date" class="form-control" id="dob" name="birthday" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="age" class="form-label">Age*</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="employeeId" class="form-label">Employee ID*</label>
                        <input type="text" class="form-control" id="employeeId" name="employee_id" required>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="border-bottom pb-2 mb-3">Contact Information</h6>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label">Email Address*</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number*</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phone_number" required>
                    </div>
                </div>
                
                <!-- Address Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="border-bottom pb-2 mb-3">Address</h6>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="streetAddress" class="form-label">Street Address*</label>
                        <input type="text" class="form-control" id="streetAddress" name="address_street" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="city" class="form-label">City*</label>
                        <input type="text" class="form-control" id="city" name="address_city" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="state" class="form-label">State/Province*</label>
                        <input type="text" class="form-control" id="state" name="address_state" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="postalCode" class="form-label">Postal Code*</label>
                        <input type="text" class="form-control" id="postalCode" name="address_postal_code" required>
                    </div>
                </div>
                
                <!-- Submit Buttons -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Save Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Calculate age automatically when date of birth changes
    document.getElementById('dob').addEventListener('change', function() {
        const dob = new Date(this.value);
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const m = today.getMonth() - dob.getMonth();
        
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
            age--;
        }
        
        document.getElementById('age').value = age;
    });
</script>
@endpush
