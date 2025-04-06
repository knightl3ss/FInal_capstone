@extends('layout.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Admin Accounts</h5>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#registrationModal">
                    <i class="fas fa-plus"></i> Add Admin
                </button>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover" id="adminTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Last Login</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->employee_id }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <strong>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</strong>
                                </div>
                            </td>
                            <td>{{ $user->role }}</td>
                            @php
                                // Define status color mapping
                                $statusColors = [
                                    'active' => ['class' => 'success', 'icon' => 'check-circle'],
                                    'pending' => ['class' => 'warning', 'icon' => 'clock'],
                                    'inactive' => ['class' => 'danger', 'icon' => 'times-circle'],
                                    'suspended' => ['class' => 'secondary', 'icon' => 'ban'],
                                    'archived' => ['class' => 'light text-muted', 'icon' => 'archive']
                                ];
                            @endphp
                            <td>
                                @php
                                    $status = strtolower(ucfirst($user->status));
                                    $statusConfig = $statusColors[$status] ?? $statusColors['inactive'];
                                @endphp
                                <span class="badge bg-{{ $statusConfig['class'] }} d-inline-flex align-items-center gap-2 py-2 px-3 rounded-pill">
                                    <i class="fas fa-{{ $statusConfig['icon'] }} me-1"></i>
                                    {{ $status }}
                                </span>
                            </td>
                            <td>
                                @if($user->last_login_at)
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-clock text-muted mr-2"></i>
                                        <span>
                                            {{ $user->last_login_at->diffForHumans() }}
                                            <small class="d-block text-muted">
                                                {{ $user->last_login_at->format('Y-m-d H:i:s') }}
                                            </small>
                                        </span>
                                    </div>
                                @else
                                    <span class="text-muted">
                                        <i class="fas fa-ban mr-2"></i>Never logged in
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('view_account', ['id' => $user->id]) }}" class="btn btn-info btn-sm" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('edit_account', ['id' => $user->id]) }}" class="btn btn-warning btn-sm" title="Edit Account">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('delete_account', ['id' => $user->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this account? This action cannot be undone.');">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Account">
                                            <i class="fas fa-trash"></i>
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

<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel">Register New Admin Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="{{ route('register.modal') }}" method="POST" id="adminRegistrationForm" enctype="multipart/form-data">
                    @csrf
                    <div class="border p-3">
                        <h6 class="section-header ">Personal Information</h6>
                    
                    <div class="row ">
                        <div class="col-md-3 mb-2">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" pattern="[A-Za-z\s]+" title="Please enter alphabets only" maxlength="50" required>
                            @error('first_name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="middle_name" pattern="[A-Za-z\s]*" title="Please enter alphabets only" maxlength="50">
                            @error('middle_name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" pattern="[A-Za-z\s]+" title="Please enter alphabets only" maxlength="50" required>
                            @error('last_name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Extension Name (e.g., Jr., Sr.)</label>
                            <input type="text" class="form-control" id="extension_name" name="extension_name" pattern="[A-Za-z\s\.]+" title="Please enter valid extension (e.g., Jr., Sr.)" maxlength="10">
                            @error('extension_name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Age</label>
                            <input type="number" class="form-control" name="age" min="18" max="100" required>
                            <small id="ageFeedback" class="form-text"></small>
                            @error('age')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Birthday</label>
                            <input type="date" class="form-control" name="birthday" max="{{ date('Y-m-d', strtotime('-18 years')) }}" required>
                            <small id="birthdayFeedback" class="form-text"></small>
                            @error('birthday')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                                <option value="blocked">Blocked</option>
                            </select>
                            @error('status')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Gender Identity</label>
                            <select name="gender" id="gender" class="form-select" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    </div>
                    

                            <!-- Address and Account Information -->
                            
                            <div class="border p-3 m">
                            <div class="row">
                            <h6 class="section-header">Address Information</h6>
                            <div class="col-md-3 mb-2">
                                <label for="address_street" class="form-label">Street Address</label>
                                <input type="text" class="form-control address-input" id="address_street" name="address_street" maxlength="100" required>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="address_city" class="form-label">City</label>
                                <input type="text" class="form-control address-input" id="address_city" name="address_city" pattern="[A-Za-z\s]+" title="Please enter alphabets only" maxlength="50" required>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="address_state" class="form-label">State</label>
                                <input type="text" class="form-control address-input" id="address_state" name="address_state" pattern="[A-Za-z\s]+" title="Please enter alphabets only" maxlength="50" required>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="address_postal_code" class="form-label">Postal Code</label>
                                <input type="text" class="form-control address-input" id="address_postal_code" name="address_postal_code" pattern="[0-9]+" minlength="4" maxlength="10" title="Please enter numbers only" required>
                            </div>
                        </div>
                        </div>
                        

                            <!-- Account Information -->
                            <div class="border p-3">
                            <div class="row">
                            <h6 class="section-header">Account Information</h6>
                            <div class="col-md-3 mb-2">
                                <label for="employee_id" class="form-label">Employee ID</label>
                                <input type="text" class="form-control" id="employee_id" name="employee_id" pattern="[A-Za-z0-9\-]+" title="Alphanumeric characters and hyphens only" maxlength="20" required>
                                @error('employee_id')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" title="Please enter a valid email address" maxlength="100" required>
                                <small id="emailFeedback" class="form-text"></small>
                                @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="XXX-XXX-XXXX" maxlength="15" required>
                                <small class="form-text text-muted">Format:+63 XXX-XXX-XXXX or 09XX XXX XXXX</small>
                                @error('phone_number')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" name="role" required>
                                    <option value="">Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                </select>
                                @error('role')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        </div>

                            <!-- Security Information -->
                            <div class="border p-3">
                            <div class="row">
                            <h6 class="section-header">Security</h6>
                            <div class="col-md-3 mb-2">
                                <label for="password" class="form-label">Password</label>
                                <div class="password-field-container">
                                    <input type="password" class="form-control" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" title="Must contain at least one number, one uppercase letter, one lowercase letter, one special character, and at least 8 characters" required>
                                </div>
                                <div class="password-strength-meter" id="passwordStrengthMeter"></div>
                                <small id="passwordStrengthText" class="form-text"></small>
                                @error('password')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <div class="password-field-container">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" title="Must match the password field"  required>
                                </div>
                                @error('password_confirmation')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="adminRegistrationForm" class="btn btn-primary">Register Admin</button>
            </div>
            </div>
        </div>
    </div>
</div>



@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<style>

.modal-xl {
    max-width: 90%;
}

.profile-upload-container {
    text-align: center;
}

.profile-preview {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #007bff;
    margin: 0 auto;
}
    #adminTable th, #adminTable td {
        vertical-align: middle;
    }
    
    /* Password strength indicator */
    .password-strength-meter {
        height: 5px;
        margin-top: 5px;
        border-radius: 3px;
        transition: all 0.3s ease;
    }
    
    .weak { background-color: #ff4d4d; width: 25%; }
    .medium { background-color: #ffa64d; width: 50%; }
    .strong { background-color: #ffff4d; width: 75%; }
    .very-strong { background-color: #4dff4d; width: 100%; }
    
    .password-field-container {
        position: relative;
    }
</style>
@endpush

@push('scripts')

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#adminTable').DataTable({
        responsive: true,
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        columnDefs: [
            { targets: [-1], orderable: false }, // Disable sorting for actions column
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search accounts...",
            lengthMenu: "Show _MENU_ entries",
        }
    });
    
    // Handle profile picture changes
    $('#profilePicture').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#profilePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });

    // Date of birth validation
    $('input[name="birthday"]').on('change', function() {
        const dob = new Date($(this).val());
        const today = new Date();
        const minAgeDate = new Date();
        minAgeDate.setFullYear(today.getFullYear() - 18);
        
        if (dob > minAgeDate) {
            $(this).addClass('is-invalid');
            $('#birthdayFeedback').text('You must be at least 18 years old').addClass('text-danger');
            // Update age field to empty
            $('input[name="age"]').val('');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
            $('#birthdayFeedback').text('Valid age').removeClass('text-danger').addClass('text-success');
            
            // Calculate and set the age automatically
            const age = today.getFullYear() - dob.getFullYear();
            const monthDiff = today.getMonth() - dob.getMonth();
            
            // If birthday hasn't occurred yet this year, subtract one year
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                $('input[name="age"]').val(age - 1);
            } else {
                $('input[name="age"]').val(age);
            }
        }
    });
    
    // When age is entered manually, validate
    $('input[name="age"]').on('input', function() {
        const age = parseInt($(this).val());
        if (age < 18) {
            $(this).addClass('is-invalid');
            $('#ageFeedback').text('Age must be at least 18').addClass('text-danger');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
            $('#ageFeedback').text('').removeClass('text-danger');
        }
    });

    // Form Validation
    $('#adminRegistrationForm').on('submit', function(e) {
        const password = $('input[name="password"]').val();
        const confirmPassword = $('input[name="password_confirmation"]').val();
        
        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Passwords do not match!');
            return false;
        }
        
        // Check age validation
        const age = parseInt($('input[name="age"]').val());
        if (age < 18) {
            e.preventDefault();
            alert('Age must be at least 18 years old!');
            return false;
        }
    });
    
    // Email validation
    $('#email').on('input', function() {
        const email = $(this).val();
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        
        if (email.length > 0) {
            if (emailRegex.test(email)) {
                $(this).removeClass('is-invalid').addClass('is-valid');
                $('#emailFeedback').removeClass('text-danger').addClass('text-success').text('Valid email format');
            } else {
                $(this).removeClass('is-valid').addClass('is-invalid');
                $('#emailFeedback').removeClass('text-success').addClass('text-danger').text('Invalid email format');
            }
        } else {
            $(this).removeClass('is-valid is-invalid');
            $('#emailFeedback').text('');
        }
    });
    
    // Phone number formatting
    $('#phone_number').on('input', function() {
        let value = $(this).val().replace(/\D/g, ''); // Remove non-digits
        
        if (value.length > 0) {
            // Format as XXX-XXX-XXXX or international format
            if (value.length <= 10) {
                // Format for 10 digit US number
                if (value.length > 3 && value.length <= 6) {
                    value = value.slice(0, 3) + '-' + value.slice(3);
                } else if (value.length > 6) {
                    value = value.slice(0, 3) + '-' + value.slice(3, 6) + '-' + value.slice(6, 10);
                }
            } else {
                // International format
                value = '+' + value;
            }
            
            $(this).val(value);
        }
    });
    
    // Password strength meter
    $('#password').on('input', function() {
        const password = $(this).val();
        const $meter = $('#passwordStrengthMeter');
        
        // Remove all classes
        $meter.removeClass('weak medium strong very-strong');
        
        if (password.length === 0) {
            $meter.css('width', '0%');
            return;
        }
        
        // Calculate strength
        let strength = 0;
        
        // Length check
        if (password.length >= 8) strength += 1;
        
        // Lowercase letter check
        if (/[a-z]/.test(password)) strength += 1;
        
        // Uppercase letter check
        if (/[A-Z]/.test(password)) strength += 1;
        
        // Number check
        if (/[0-9]/.test(password)) strength += 1;
        
        // Special character check
        if (/[^A-Za-z0-9]/.test(password)) strength += 1;
        
        // Set meter class based on strength
        if (strength <= 2) {
            $meter.addClass('weak');
            $('#passwordStrengthText').text('Weak');
        } else if (strength === 3) {
            $meter.addClass('medium');
            $('#passwordStrengthText').text('Medium');
        } else if (strength === 4) {
            $meter.addClass('strong');
            $('#passwordStrengthText').text('Strong');
        } else {
            $meter.addClass('very-strong');
            $('#passwordStrengthText').text('Very Strong');
        }
    });
});
</script>
@endpush
@endsection
