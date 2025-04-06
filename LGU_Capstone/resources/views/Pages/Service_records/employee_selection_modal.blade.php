<!-- Employee Selection Modal -->
<div class="modal fade" id="employeeSelectionModal" tabindex="-1" aria-labelledby="employeeSelectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header gradient-bg text-white py-3">
                <h5 class="modal-title" id="employeeSelectionModalLabel">
                    <i class="fas fa-users-cog me-2"></i>Employee Selection
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4">
                <div class="row g-4">
                    <!-- Permanent Employee Section -->
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-header bg-light-subtle border-bottom-0 d-flex justify-content-between align-items-center">
                                <h6 class="card-title mb-0 text-primary">
                                    <i class="fas fa-user-tie me-2"></i>Permanent Employees
                                </h6>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-primary" type="button" id="permanentEmployeeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="permanentEmployeeDropdown">
                                        <li>
                                            <label class="dropdown-item" for="permanentEmployeeExcel">
                                                <input type="file" id="permanentEmployeeExcel" class="d-none" accept=".xlsx,.xls" onchange="handleExcelUpload(this, 'permanentEmployeeList')">
                                                <i class="fas fa-file-excel me-2 text-success"></i>Import Excel
                                            </label>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-download me-2 text-primary"></i>Export Excel
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addPermanentEmployeeModal">
                                                <i class="fas fa-plus me-2 text-success"></i>Add New
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body pt-2">
                                <div class="input-group mb-3 shadow-sm">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                                    <input type="text" class="form-control border-start-0" placeholder="Search employees" id="permanentEmployeeSearch">
                                </div>
                                <div class="list-group list-group-flush" id="permanentEmployeeList" style="max-height: 300px; overflow-y: auto;">
                                    <!-- Dynamically populated list of permanent employees -->
                                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        John Doe
                                        <span class="badge bg-primary rounded-pill">ID: 001</span>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Jane Smith
                                        <span class="badge bg-primary rounded-pill">ID: 002</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job List Section -->
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-header bg-light-subtle border-bottom-0 d-flex justify-content-between align-items-center">
                                <h6 class="card-title mb-0 text-primary">
                                    <i class="fas fa-briefcase me-2"></i>Job List
                                </h6>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-primary" type="button" id="jobListDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="jobListDropdown">
                                        <li>
                                            <label class="dropdown-item" for="jobListExcel">
                                                <input type="file" id="jobListExcel" class="d-none" accept=".xlsx,.xls" onchange="handleExcelUpload(this, 'jobList')">
                                                <i class="fas fa-file-excel me-2 text-success"></i>Import Excel
                                            </label>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-download me-2 text-primary"></i>Export Excel
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addJobModal">
                                                <i class="fas fa-plus me-2 text-success"></i>Add New
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body pt-2">
                                <div class="input-group mb-3 shadow-sm">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                                    <input type="text" class="form-control border-start-0" placeholder="Search jobs" id="jobListSearch">
                                </div>
                                <div class="list-group list-group-flush" id="jobList" style="max-height: 300px; overflow-y: auto;">
                                    <!-- Dynamically populated list of jobs -->
                                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Software Engineer
                                        <span class="badge bg-success rounded-pill">Open</span>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Project Manager
                                        <span class="badge bg-warning rounded-pill">Pending</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Elected Employee Section -->
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-header bg-light-subtle border-bottom-0 d-flex justify-content-between align-items-center">
                                <h6 class="card-title mb-0 text-primary">
                                    <i class="fas fa-award me-2"></i>Elected Employees
                                </h6>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-primary" type="button" id="electedEmployeeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="electedEmployeeDropdown">
                                        <li>
                                            <label class="dropdown-item" for="electedEmployeeExcel">
                                                <input type="file" id="electedEmployeeExcel" class="d-none" accept=".xlsx,.xls" onchange="handleExcelUpload(this, 'electedEmployeeList')">
                                                <i class="fas fa-file-excel me-2 text-success"></i>Import Excel
                                            </label>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-download me-2 text-primary"></i>Export Excel
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addElectedEmployeeModal">
                                                <i class="fas fa-plus me-2 text-success"></i>Add New
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body pt-2">
                                <div class="input-group mb-3 shadow-sm">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                                    <input type="text" class="form-control border-start-0" placeholder="Search elected employees" id="electedEmployeeSearch">
                                </div>
                                <div class="list-group list-group-flush" id="electedEmployeeList" style="max-height: 300px; overflow-y: auto;">
                                    <!-- Dynamically populated list of elected employees -->
                                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Alice Johnson
                                        <span class="badge bg-info rounded-pill">Senior</span>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Bob Williams
                                        <span class="badge bg-info rounded-pill">Lead</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Cancel
                </button>
                <button type="button" class="btn btn-primary" id="confirmEmployeeSelection">
                    <i class="fas fa-check me-1"></i>Confirm Selection
                </button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.gradient-bg {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
}

.list-group-item-action:hover {
    background-color: rgba(37, 117, 252, 0.1);
    transition: background-color 0.3s ease;
}
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
<script>
function handleExcelUpload(input, listId) {
    const file = input.files[0];
    const list = document.getElementById(listId);

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, {type: 'array'});
            const firstSheetName = workbook.SheetNames[0];
            const worksheet = workbook.Sheets[firstSheetName];
            const jsonData = XLSX.utils.sheet_to_json(worksheet);

            // Clear existing list
            list.innerHTML = '';

            // Populate list with Excel data
            jsonData.forEach(row => {
                const listItem = document.createElement('a');
                listItem.href = '#';
                listItem.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center';
                
                // Customize this based on your Excel structure
                const name = row.Name || row.name || 'Unknown';
                const id = row.ID || row.id || '';
                const status = row.Status || row.status || '';

                listItem.innerHTML = `
                    ${name}
                    <span class="badge bg-primary rounded-pill">${id ? `ID: ${id}` : status}</span>
                `;

                listItem.addEventListener('click', function() {
                    list.querySelectorAll('.list-group-item').forEach(item => {
                        item.classList.remove('active', 'bg-primary', 'text-white');
                    });
                    this.classList.add('active', 'bg-primary', 'text-white');
                });

                list.appendChild(listItem);
            });

            // Show success toast
            Swal.fire({
                icon: 'success',
                title: 'Excel Import Successful',
                text: `Imported ${jsonData.length} items to ${listId}`,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        };
        reader.readAsArrayBuffer(file);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const permanentEmployeeList = document.getElementById('permanentEmployeeList');
    const jobList = document.getElementById('jobList');
    const electedEmployeeList = document.getElementById('electedEmployeeList');
    const confirmButton = document.getElementById('confirmEmployeeSelection');

    // Search functionality for each list
    ['permanentEmployeeSearch', 'jobListSearch', 'electedEmployeeSearch'].forEach(searchId => {
        const searchInput = document.getElementById(searchId);
        const listId = searchId.replace('Search', 'List');
        const list = document.getElementById(listId);

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const items = list.getElementsByClassName('list-group-item');
            
            Array.from(items).forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    });

    // Confirm selection
    confirmButton.addEventListener('click', function() {
        const selectedPermanentEmployee = permanentEmployeeList.querySelector('.active');
        const selectedJob = jobList.querySelector('.active');
        const selectedElectedEmployee = electedEmployeeList.querySelector('.active');

        if (selectedPermanentEmployee && selectedJob && selectedElectedEmployee) {
            // Here you would typically send the selected data to the server
            console.log('Selected Permanent Employee:', selectedPermanentEmployee.textContent);
            console.log('Selected Job:', selectedJob.textContent);
            console.log('Selected Elected Employee:', selectedElectedEmployee.textContent);
            
            // Close the modal
            bootstrap.Modal.getInstance(document.getElementById('employeeSelectionModal')).hide();
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Incomplete Selection',
                text: 'Please select an employee, job, and elected employee.',
                confirmButtonText: 'OK'
            });
        }
    });
});
</script>
@endpush
