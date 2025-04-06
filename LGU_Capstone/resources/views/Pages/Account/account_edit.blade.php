@extends('layout.app')


@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Admin Account</h5>
                <a href="{{ route('view_account', ['id' => $user->id]) }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back to Profile
                </a>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any()) 
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('update_account', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">

                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <h4 class="border-bottom border-black pb-2">Personal Information</h4>
                            <div class="col-md-3 form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $user->middle_name }}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="extension_name">Extension Name</label>
                                <input type="text" class="form-control" id="extension_name" name="extension_name" value="{{ $user->extension_name }}">
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                        <div class="col-md-4 form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="age">Age</label>
                                <input type="number" class="form-control" id="age" name="age" value="{{ $user->age }}" min="18" max="100" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="birthday">Birthday</label>
                                <input type="date" class="form-control" id="birthday" name="birthday" value="{{ $user->birthday }}" required>
                            </div>
                        </div>
                        
                    
                        <div class="row mt-3">
                            <h4 class="border-bottom border-black pb-2">Address Information</h4>
                            <div class="col-md-3 form-group">
                                <label for="street_address">Street Address</label>
                                <input type="text" class="form-control" id="street_address" name="address_street" value="{{ $user->address_street }}" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="city_address">City</label>
                                <input type="text" class="form-control" id="city_address" name="address_city" value="{{ $user->address_city }}" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="state_address">State</label>
                                <input type="text" class="form-control" id="state_address" name="address_state" value="{{ $user->address_state }}" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" class="form-control" id="postal_code" name="address_postal_code" value="{{ $user->address_postal_code }}" required>
                            </div>
                            </div>
                        <div class="row mt-3">
                            <h4 class="border-bottom border-black pb-2">Account Information</h4>
                            <div class="col-md-4 form-group">
                                <label for="employee_id">Employee ID</label>
                                <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{ $user->employee_id }}" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="blocked" {{ $user->status == 'blocked' ? 'selected' : '' }}>Blocked</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="row mt-3">
                            <h4 class="border-bottom border-black pb-2">Security Information</h4>
                            <div class="col-md-4 form-group">
                                <label for="password">New Password (optional)</label>
                                <input type="password" class="form-control" id="password" name="password" minlength="8">
                                <small class="text-muted">Leave blank if you don't want to change the password</small>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="password_confirmation">Confirm New Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" minlength="8">
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-center gap-2">
                            <button type="submit" class="btn btn-primary">Update Account</button>
                            <a href="{{ route('view_account', ['id' => $user->id]) }}" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
