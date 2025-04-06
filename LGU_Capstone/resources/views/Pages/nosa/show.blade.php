@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Notice of Salary Adjustment (NOSA) for {{ $personnel->last_name }}, {{ $personnel->first_name }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Date:</strong> {{ date('F d, Y') }}</p>

                <p><strong>To:</strong></p>
                <p><strong>{{ $personnel->last_name }}, {{ $personnel->first_name }}</strong></p>
                <p><strong>Position:</strong> {{ $personnel->position }}</p>
                <p><strong>Office/Department:</strong> {{ $personnel->office }}</p>

                <hr>

                <h5>Details of Adjustment:</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Current Position</th>
                        <td>{{ $personnel->position }}</td>
                    </tr>
                    <tr>
                        <th>Current Salary</th>
                        <td>₱{{ number_format($personnel->current_salary, 2) }}</td>
                    </tr>
                    <tr>
                        <th>New Salary Grade</th>
                        <td>{{ $personnel->new_salary_grade }}</td>
                    </tr>
                    <tr>
                        <th>New Salary</th>
                        <td>₱{{ number_format($personnel->new_salary, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Effective Date</th>
                        <td>{{ $personnel->effective_date->format('F d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Reason for Adjustment</th>
                        <td>{{ $personnel->reason }}</td>
                    </tr>
                    <tr>
                        <th>Remarks</th>
                        <td>{{ $personnel->remarks ?? 'N/A' }}</td>
                    </tr>
                </table>

                <hr>

                <p>If you have any questions, please feel free to reach out to the HR Department at <strong>hr@company.com</strong> or call us at <strong>(02) 1234-5678</strong>.</p>
                <p>Thank you for your continued service to the Local Government Unit.</p>

                <hr>

                <p>Sincerely,</p>
                <p><strong>{{ auth()->user()->name }}</strong><br>
                   {{ auth()->user()->position }}<br>
                   HR Department<br>
                   Local Government Unit</p>
            </div>
        </div>
    </div>
@endsection
