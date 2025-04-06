@extends('layout.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>List of Personnel for Notice of Salary Adjustment (NOSA)</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Salary Grade</th>
                            <th>Step</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($personnels as $personnel)
                            <tr>
                                <td>{{ $personnel->lastName }}, {{ $personnel->firstName }}, {{ $personnel->middleName }}</td>
                                <td>{{ $personnel->position }}</td>
                                <td>{{ $personnel->office }}</td>
                                <td>{{ $personnel->salaryGrade }}</td>
                                <td>{{ $personnel->step }}</td>
                                
                                <td>
                                    <!-- Button to open modal -->
                                    <button class="btn btn-primary generate-nosa-btn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#nosaModal"
                                            data-id="{{ $personnel->id }}"
                                            data-name="{{ $personnel->lastName }}, {{ $personnel->firstName }} {{ $personnel->middleName }}"
                                            data-position="{{ $personnel->position }}"
                                            data-office="{{ $personnel->office }}"
                                            data-salaryGrade="{{ $personnel->salaryGrade }}"
                                            data-step="{{ $personnel->step }}">
                                        Generate NOSA
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('add_nosa')

@endsection

<!-- jQuery should be loaded first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Then load DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Then load Bootstrap DataTables (if used) -->
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>