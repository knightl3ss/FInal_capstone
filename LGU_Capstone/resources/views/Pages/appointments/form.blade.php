@extends('Layout.app')

@section('title', 'Appointment Form Options')

@section('content')
<div class="container-fluid px-4 py-4">
    @if ($errors->any())
    <div class="alert alert-danger mb-4">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger mb-4">
        {{ session('error') }}
    </div>
    @endif

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="text-primary">Appointment Form</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('appointments') }}" class="text-muted">Appointment</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Form</li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-primary">Dashboard</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Section Header with Card styling -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0 fw-bold text-dark">Scanned Appointment Forms</h5>
            
            <!-- Upload Button -->
            <button type="button" onclick="toggleModal()" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#uploadModal">
                <i class="fas fa-upload me-2"></i>
                Save File
            </button>
        </div>
        
        <!-- Table to Display Uploaded Files -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-3 py-3">No.</th>
                            <th class="px-3 py-3">Filename</th>
                            <th class="px-3 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($files as $file)
                        <tr>
                            <!-- Counter Column -->
                            <td class="px-3 py-3">
                                {{ $loop->iteration }}
                            </td>

                            <!-- File Name Column -->
                            <td class="px-3 py-3 fw-medium text-truncate" style="max-width: 300px;">
                                {{ $file->filename }}
                            </td>

                            <!-- Download and Delete Button Column -->
                            <td class="px-3 py-3">
                                <div class="d-flex gap-2">
                                    <!-- Download Button -->
                                    <a href="{{ route('raw.download', $file->id) }}"
                                        class="btn btn-sm btn-outline-primary d-inline-flex align-items-center">
                                        <i class="fas fa-cloud-download-alt me-1"></i>
                                        Download
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('appointment.deleteFile', $file->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this file?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger d-inline-flex align-items-center">
                                            <i class="fas fa-trash-alt me-1"></i>
                                            Delete
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

<!-- Modal for File Upload -->
<div id="uploadModal" class="modal fade" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Appointment Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <form action="{{ route('appointment.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="filename" class="form-label">Filename</label>
                        <input type="text" name="filename" id="filename" class="form-control" placeholder="Enter filename" required>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Select File</label>
                        <input type="file" name="file" id="file" class="form-control" required>
                    </div>
                    
                    <div class="modal-footer px-0 pb-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle modal visibility
    function toggleModal() {
        const modal = document.getElementById('uploadModal');
        if (!modal) return;
        
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
    }

    // Create Bootstrap Modal instances
    document.addEventListener('DOMContentLoaded', function() {
        // Check if Bootstrap is loaded
        if (typeof bootstrap === 'undefined') {
            console.error('Bootstrap is not defined. Make sure Bootstrap JS is loaded.');
        } else {
            console.log('Bootstrap is loaded correctly.');
        }
    });
</script>
@endsection