<!DOCTYPE html>
<meta name="csrf-token" content="{{ csrf_token() }}">

@extends('layout.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/plantilla.css') }}">
@endpush

@section('content')
<div class="container-fluid">
    <div class="container-fluid py-4">
<!-- Remarks Button and Search Bar Section -->
<div class="d-flex justify-content-left mb-4 align-items-center gap-3">
    <!-- Remarks Button -->
    <button id="remarksButton" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#remarksModal">
        Select Remarks
    </button>

    <!-- Vacant Plantilla Item Button -->
    <button id="vacantButton" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#vacantModal">
        Vacant Plantilla Item
    </button>

    <!-- Spacer to push Search Bar to the right -->
    <div class="ms-auto">
        <!-- Search Bar -->
        <input type="text" id="searchInput" class="form-control" placeholder="Search Personnel..." style="width: 250px;">
    </div>
</div>


<!-- Modal for Remarks -->
<div class="modal fade" id="remarksModal" tabindex="-1" aria-labelledby="remarksModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="remarksModalLabel">Select Remarks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Remarks Filter Section -->
                <div class="d-flex mb-4" style="gap: 5px;">
                    <button class="btn btn-outline-primary" id="retirableFilter">Retirable</button>
                    <button class="btn btn-outline-primary" id="retiredFilter">Retired</button>
                    <button class="btn btn-outline-primary" id="nonRetirableFilter">Non-Retirable</button>
                </div>
        <div class="table-responsive">
                <table class="table table-hover table-bordered table-sm" id="remarksTable">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 10%;">Office</th>
                            <th style="width: 15%;">Position</th>
                            <th style="width: 15%;">Last Name</th>
                            <th style="width: 15%;">First Name</th>
                            <th style="width: 15%;">Middle Name</th>
                            <th style="width: 10%;">Age</th>
                            <th style="width: 20%;">Date Eligible for Retirement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Rows will be inserted dynamically here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Vacant Plantilla Item Modal -->
<div class="modal fade" id="vacantModal" tabindex="-1" aria-labelledby="vacantModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vacantModalLabel">Vacant Plantilla Items</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Vacant Plantilla Item Content will be inserted dynamically -->
                <div class="table-responsive">
                <table class="table table-hover table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                                <th scope="col">Office</th>
                                <th scope="col">Position</th>
                                <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="vacantTableBody">
                        <!-- Dynamic Data Goes Here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

        <!-- Filter Section -->
        <div class="d-flex justify-content-left gap-2 mb-4">
            <select id="officeFilter" class="form-select">
                <option value="">Select Office</option>
                <option value="mayor">Office of the Mayor (MO)</option>
                <option value="sbo">Office of the Sanguniang Bayan (SBO)</option>
                <option value="mpdo">Municipal Planning & Development Coordinator (MPDO)</option>
                <option value="lcr">Office of the Local Registrar (LCR)</option>
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

            <select id="statusFilter" class="form-select">
                <option value="">Status</option>
                <option value="casual">Casual</option>
                <option value="contractual">Contractual</option>
                <option value="coterminous">Coterminous</option>
                <option value="coterminousTemporary">Coterminous-Temporary</option>
                <option value="permanent">Permanent</option>
                <option value="provisional">Provisional</option>
                <option value="regularPermanent">Regular Permanent</option>
                <option value="substitute">Substitute</option>
                <option value="temporary">Temporary</option>
            </select>

            <button id="filterBtn" class="btn btn-primary">Apply Filters</button>
        </div>

        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

           <!-- Table Section -->
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">List of Personnel</h5>
        <div class="d-flex gap-2">
            <a href="{{ route('generate.report') }}" class="btn btn-primary">
                📄 Generate Report
            </a>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPersonnelModal">
                + Add Personnel
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <!-- Table 1: Original Personnel Table -->
        <div id="originalPersonnelTableContainer">
            <div class="table-responsive">
                <table id="personnelTable" class="table table-hover table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Office</th>
                            <th>Item No.</th>
                            <th>Position</th>
                            <th>SG</th>
                            <th>Auth. Salary</th>
                            <th>Act. Salary</th>
                            <th>Step</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Lvl</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Birthdate</th>
                            <th>Orig. Appt.</th>
                            <th>Last Promo</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="employeeTable">
                        @if(isset($personnels) && count($personnels) > 0)
                            @foreach($personnels as $personnel)
                                <tr class="employee-data" data-office="{{ $personnel->office }}"
                                    data-remarks="{{ $personnel->remarks ?? '' }}"
                                    data-status="{{ $personnel->status }}">
                                    <td>{{ $personnel->office }}</td>
                                    <td>{{ $personnel->itemNo }}</td>
                                    <td>{{ $personnel->position }}</td>
                                    <td>{{ $personnel->salaryGrade }}</td>
                                    <td>{{ $personnel->authorizedSalary }}</td>
                                    <td>{{ $personnel->actualSalary }}</td>
                                    <td>{{ $personnel->step }}</td>
                                    <td>{{ $personnel->code }}</td>
                                    <td>{{ $personnel->type }}</td>
                                    <td>{{ $personnel->level }}</td>
                                    <td>{{ $personnel->lastName }}</td>
                                    <td>{{ $personnel->firstName }}</td>
                                    <td>{{ $personnel->middleName ?? '' }}</td>
                                    <td>{{ $personnel->dob }}</td>
                                    <td>{{ $personnel->originalAppointment }}</td>
                                    <td>{{ $personnel->lastPromotion ?? 'N/A' }}</td>
                                    <td>{{ $personnel->status }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="16" class="text-center">No personnel found.</td>
                            </tr>
                        @endif
                    </tbody>              
                </table>
            </div>
        </div>
    </div>
</div>



@endsection
@include('add_personnel')
@push('scripts')
    <script src="{{ asset('js/plantilla/personnel.js') }}"></script>
@endpush

<script>
    const PlantillaRoute = "{{ url('/Plantilla') }}";
</script>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Include DataTables Bootstrap 5 (optional, based on your design) -->
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<!-- Your custom script (plantilla_filtering.js) -->
<script>
    var filterUrl = "{{ url('/filtered-personnel') }}";
</script>
<script src="{{ asset('js/plantilla/plantilla_filtering.js') }}"></script>
<script src="{{ asset('js/plantilla/remarksModal.js') }}"></script>
<script src="{{ asset('js/plantilla/vacantModal.js') }}"></script>
<script src="{{ asset('js/plantilla/search.js') }}"></script>

{{-- <script src="{{ asset('js/plantilla/server-side-filter.js') }}"></script>
<script src="{{ asset('js/plantilla/client-side-filter.js') }}"></script> --}}

<!-- DataTable CSS -->
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> --}}

<!-- jQuery and DataTable JS -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}} --}}
