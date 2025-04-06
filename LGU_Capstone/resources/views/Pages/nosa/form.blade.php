<!-- resources/views/nosa/form.blade.php -->
@extends('layout.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Generate Notice of Salary Adjustment (NOSA)</h5>
            </div>
            <div class="card-body">
                @if($personnel)
                <form action="{{ route('nosa.generate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="personnel_id" value="{{ $personnel->id }}">
                    <div class="form-group">
                        <label for="personnel_id">Select Personnel</label>
                        <select name="personnel_id" id="personnel_id" class="form-control" required>
                            <option value="">-- Select Personnel --</option>
                            @foreach($personnels as $personnel)
                                <option value="{{ $personnel->id }}">
                                    {{ $personnel->lastName }}, {{ $personnel->firstName }} {{ $personnel->middleName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="salary_adjustment">Salary Adjustment</label>
                        <input type="number" name="salary_adjustment" class="form-control" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="current_salary">Current Monthly Salary</label>
                        <input type="number" name="current_salary" class="form-control" step="0.01" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Generate Letter</button>
                </form>
                @else
    <p>Personnel not found.</p>
@endif
            </div>
        </div>
    </div>
@endsection
