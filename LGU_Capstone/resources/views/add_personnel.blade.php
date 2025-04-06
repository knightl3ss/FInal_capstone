<link rel="stylesheet" href="{{ asset('css/plantilla.css') }}">

<!-- Add Personnel Modal -->
<div class="modal fade" id="addPersonnelModal" tabindex="-1" aria-labelledby="addPersonnelModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPersonnelModalLabel">Add New Personnel</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPersonnelForm" action="{{ route('personnel.store') }}" method="POST">
                    @csrf
                
                    <div class="card mb-4">
                        <div class="card-body">
                            
                            <!-- Office Selection -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="office">Select Office</label>
                                    <select id="office" name="office" class="form-select" required>
                                        <option value="" disabled selected>Select an office</option>
                                        <option value="mayor">Office of the Mayor (MO)</option>
                                        <option value="sbo">Office of the Sanguniang Bayan (SBO)</option>
                                        <option value="mpdo">Municipal Planning & Development Coordinator (MPDO)</option>
                                        <option value="lcr">Office of the Local Civil Registrar (LCR)</option>
                                        <option value="mbo">Office of the Municipal Budget Officer (MBO)</option>
                                        <option value="macco">Office of the Municipal Accountant (MACCO)</option>
                                        <option value="mto">Office of the Municipal Treasurer (MTO)</option>
                                        <option value="masso">Office of the Municipal Assessor (MASSO)</option>
                                        <option value="mho">Office of the Municipal Health Officer (MHO/RHU)</option>
                                        <option value="mswdo">Social Welfare & Development Officer (MSWDO)</option>
                                        <option value="mao">Office of the Municipal Agriculturist (MAO)</option>
                                        <option value="meo">Office of the Municipal Engineer (MEO)</option>
                                        <option value="mee">Ergonomic Enterprise Development Management (MEE)</option>
                                        <option value="mdrrmo">Local Disaster Risk Reduction & Management (MDRRMO)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Personnel Details -->
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="itemNo">Item No.</label>
                                    <input type="text" id="itemNo" name="itemNo" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="position">Position Title</label>
                                    <input type="text" class="form-control" id="position" name="position" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="salaryGrade">Salary Grade</label>
                                    <input type="text" class="form-control" id="salaryGrade" name="salaryGrade" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="authorizedSalary">Authorized Salary</label>
                                    <input type="text" class="form-control" id="authorizedSalary" name="authorizedSalary" required>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <label for="actualSalary">Actual Salary</label>
                                    <input type="text" class="form-control" id="actualSalary" name="actualSalary" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="step">Step</label>
                                    <input type="text" class="form-control" id="step" name="step" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="code">Code</label>
                                    <input type="text" class="form-control" id="code" name="code" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="type">Type</label>
                                    <input type="text" class="form-control" id="type" name="type" value="M" readonly required>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <label for="level">Level</label>
                                    <select id="level" name="level" class="form-select" required>
                                        <option value="" disabled selected>Select Level</option>
                                        <option value="K">K</option>
                                        <option value="A">A</option>
                                    </select>
                                </div>
                                
                                <!-- Employee Information Section -->
                                <div class="col-md-9">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-select" required onchange="toggleEmployeeSelect()">
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="casual">Casual</option>
                                        <option value="contractual">Contractual</option>
                                        <option value="coterminous">Coterminous</option>
                                        <option value="coterminousTemporary">Coterminous - Temporary</option>
                                        <option value="permanent">Permanent</option>
                                        <option value="provisional">Provisional</option>
                                        <option value="regularPermanent">Regular Permanent</option>
                                        <option value="substitute">Substitute</option>
                                        <option value="temporary">Temporary</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Manual Employee Info Entry (Default) -->
                            <div id="manualEmployeeInfo" class="row mt-3">
                                <div class="col-md-3">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="middleName">Middle Name</label>
                                    <input type="text" class="form-control" id="middleName" name="middleName">
                                </div>
                                <div class="col-md-3">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" required>
                                </div>
                            </div>

                            <!-- Employee Dropdown for Permanent Positions (Hidden by Default) -->
                            <div id="employeeDropdownSection" class="row mt-3" style="display: none;">
                                <div class="col-md-12">
                                    <label for="employeeSelect">Select Employee</label>
                                    <select name="employeeSelect" id="employeeSelect" class="form-select mb-2">
                                        <option value="">Select Existing Employee</option>
                                        @isset($employees)
                                            @foreach($employees as $employee)
                                                @php 
                                                    $fullName = $employee->getFullNameAttribute();
                                                    $simpleName = strtolower(trim($employee->first_name . ' ' . $employee->last_name));
                                                    $isAlreadyPersonnel = isset($existingPersonnelNames) && in_array($simpleName, $existingPersonnelNames);
                                                @endphp
                                                @if(!$isAlreadyPersonnel)
                                                    <option value="{{ $employee->id }}" 
                                                            data-firstname="{{ $employee->first_name }}"
                                                            data-lastname="{{ $employee->last_name }}"
                                                            data-middlename="{{ $employee->middle_name }}"
                                                            data-dob="{{ $employee->birthday ? $employee->birthday->format('Y-m-d') : '' }}">
                                                        {{ $fullName }} ({{ $employee->employee_id }})
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endisset
                                    </select>
                                    <small class="text-muted">Only showing employees without existing permanent positions</small>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="originalAppointment">Date of Original Appointment</label>
                                    <input type="date" class="form-control" id="originalAppointment" name="originalAppointment" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastPromotion">Date of Last Promotion</label>
                                    <input type="date" class="form-control" id="lastPromotion" name="lastPromotion">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary">Add Personnel</button>
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('js/plantilla/personnel.js') }}"></script>
    <script>
    function toggleEmployeeSelect() {
        const status = document.getElementById('status').value;
        const employeeDropdownSection = document.getElementById('employeeDropdownSection');
        const manualEmployeeInfo = document.getElementById('manualEmployeeInfo');
        
        // If permanent or regularPermanent is selected, show the employee dropdown
        if (status === 'permanent' || status === 'regularPermanent') {
            employeeDropdownSection.style.display = 'flex';
            manualEmployeeInfo.style.display = 'none';
        } else {
            employeeDropdownSection.style.display = 'none';
            manualEmployeeInfo.style.display = 'flex';
        }
    }
    
    // Handle employee selection
    document.getElementById('employeeSelect').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        
        if (selectedOption.value) {
            // Get data attributes
            const firstName = selectedOption.getAttribute('data-firstname');
            const lastName = selectedOption.getAttribute('data-lastname');
            const middleName = selectedOption.getAttribute('data-middlename');
            const dob = selectedOption.getAttribute('data-dob');
            
            // Fill the hidden fields
            document.getElementById('firstName').value = firstName;
            document.getElementById('lastName').value = lastName;
            document.getElementById('middleName').value = middleName || '';
            document.getElementById('dob').value = dob;
        }
    });
    
    // Initialize the form state on load
    document.addEventListener('DOMContentLoaded', function() {
        toggleEmployeeSelect();
    });
    </script>
@endpush