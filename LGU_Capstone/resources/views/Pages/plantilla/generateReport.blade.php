<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Report - Plantilla</title>
    @extends('layout.app')
</head>
<body>
<link rel="stylesheet" href="{{ asset('css/report.css') }}">



@section('content')
<div class="container">
    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">⬅ Back to Personnel List</a>
    <div class="text-center">
        <h6 class="mb-1">Republic of the Philippines</h6> 
        <h6 class="mb-1 fw-bold">MUNICIPALITY OF MAGALLANES</h6> 
        <h6 class="mb-1">Plantilla of Personnel</h6>
        <h6 class="mb-1">For Fiscal Year: {{ now()->year }}</h6> 
    </div>

    <br>

    <div class="d-flex justify-content-between">
        <h6>(1) Department/GOCC: LGU</h6>
        <h6>(2) Bureau/Agency/Subsidiary: Municipal Government of Magallanes</h6>
    </div>
    <table class="table table-bordered">
        <thead class="table-light text-center align-middle">
            <tr>
                <th rowspan="2" class="align-middle">Item No.</th>
                <th rowspan="2" class="align-middle">Position</th>
                <th rowspan="2" class="align-middle">SG</th>
        
                <!-- New Annual Salary Header -->
                <th colspan="2" class="text-center align-middle">Annual Salary</th>
        
                <th rowspan="2" class="align-middle">Step</th>
        
                <!-- New Area Header -->
                <th colspan="2" class="text-center align-middle">Area</th>
        
                <th rowspan="2" class="align-middle">Level</th>

                <!-- New Incumbents Header -->
                <th colspan="3" class="text-center align-middle">Incumbents</th>
        
                <th rowspan="2" class="align-middle">Birthdate</th>
                <th rowspan="2" class="align-middle">Orig. Appt.</th>
                <th rowspan="2" class="align-middle">Last Promo</th>
                <th rowspan="2" class="align-middle">Status</th>
            </tr>
            <tr>
                <!-- Sub-columns for Annual Salary -->
                <th class="align-middle">Authorized</th>
                <th class="align-middle">Actual</th>
        
                <!-- Sub-columns for Area -->
                <th class="align-middle">Code</th>
                <th class="align-middle">Type</th>
        
                <!-- Sub-columns for Incumbents -->
                <th class="align-middle">Last Name</th>
                <th class="align-middle">First Name</th>
                <th class="align-middle">Middle Name</th>
            </tr>
        </thead>
        
        <tbody>
            @if(isset($personnels) && count($personnels) > 0)
                @php 
                    $currentOffice = null;
                @endphp
                
                @foreach($personnels as $personnel)
                    @if($currentOffice !== $personnel->office)
                    <tr class="fw-bold text-start">
                        <td colspan="17" style="white-space: normal; word-break: break-word;">
                            {{ strtoupper($personnel->office) }}
                        </td> 
                    </tr>
                        @php 
                            $currentOffice = $personnel->office; 
                        @endphp
                    @endif
        
                    <tr>
                        <td>{{ $personnel->itemNo }}</td>
                        <td>{{ $personnel->position }}</td>
                        <td>{{ $personnel->salaryGrade }}</td>
                        <td>{{  $personnel->authorizedSalary}}</td>
                        <td>{{  $personnel->actualSalary }}</td>
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
                    <td colspan="17" class="text-center">No personnel found.</td>
                </tr>
            @endif
        </tbody>
        
    </table>
</div>
@endsection

<!-- jQuery should be loaded first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Then load DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Then load Bootstrap DataTables (if used) -->
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

</body>
</html>