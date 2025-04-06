@extends('layout.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Admin Account Details</h5>
                <a href="{{ route('account_list') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
            
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th>
                                Employee ID
                            </th>
                            <td>
                                {{ $user->employee_id }}
                            </td>
                        </tr>
                        <tr>
                            <th width="30%">Full Name</th>
                            <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} {{ $user->extension_name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td>{{ $user->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>{{ ucfirst($user->role) }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge 
                                    @if($user->status == 'active') bg-success 
                                    @elseif($user->status == 'pending') bg-warning 
                                    @else bg-danger 
                                    @endif">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                        <th>Gender</th>
                        <td>{{ ucfirst($user->gender) }}</td>
                        </tr>
                        <tr>
                            <th>Age</th>
                            <td>{{ $user->age }}</td>
                        </tr>
                        <tr>
                            <th>Birthday</th>
                            <td>{{ \Carbon\Carbon::parse($user->birthday)->format('F d, Y') }}</td>
                        </tr>
                     
                        <tr>
                            <th>Address</th>
                            <td>{{ $user->address_street }}, {{ $user->address_city }}, {{ $user->address_state }}, {{ $user->address_postal_code }}</td>
                        </tr>
                        <tr>
                            <th>Last Login</th>
                            <td>{{ $user->last_login_at ? \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() : 'Never logged in' }}</td>
                        </tr>
                    </table>
                    <div class="mt-3">
                        <a href="{{ route('edit_account', ['id' => $user->id]) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Account
                        </a>
                        <form action="{{ route('delete_account', ['id' => $user->id]) }}" method="POST" class="d-inline delete-form" onsubmit="return confirmDelete()">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Delete Account
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDelete() {
    return confirm('Are you sure you want to delete this account? This action cannot be undone.');
}
</script>
@endpush
@endsection
