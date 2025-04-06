<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\NosaController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EmployeeController;

// Guest routes (redirect to dashboard if authenticated)
Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('Auth.login_page');
    });

    Route::get('/login_page', function () {
        return view('Auth.login_page');
    });

    Route::get('/register', function () {
        return view('Auth.register_page');
    });

    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

// Protected routes (require authentication and prevent back history)
Route::middleware(['auth', 'prevent-back'])->group(function () {
    // Dashboard route - entry point after login
    Route::get('/dashboard', function () {
        return view('Pages.dashboard');
    })->name('dashboard');

    Route::get('/list_of_employee', function () {
        return view('Pages.Service_records.list_of_employee');
    });

    Route::get('/service_records', function () {
        return view('Pages.Service_records.service_records');
    })->name('service_records');

    Route::get('/account_list', [AuthController::class, 'accountList'])->name('account_list');
    Route::get('/view_account/{id}', [AuthController::class, 'viewAccount'])->name('view_account');
    Route::get('/edit_account/{id}', [AuthController::class, 'editAccount'])->name('edit_account');
    Route::put('/update_account/{id}', [AuthController::class, 'updateAccount'])->name('update_account');
    Route::post('/delete_account/{id}', [AuthController::class, 'deleteAccount'])->name('delete_account');

    Route::get('/Employee_records', function () {
        return view('Pages.Service_records.Employee_records');
    })->name('Employee_records');

    Route::get('/print-employee-records', function () {
        return view('Pages.Service_records.Print_Employee_Records');
    })->name('print_employee_records');

    // Routes for appointments
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');
    Route::get('/appointment/form', [AppointmentController::class, 'showForm'])->name('appointment.form');
    Route::get('/appointment/schedule', [AppointmentController::class, 'showSchedule'])->name('appointment.schedule');
    Route::post('/appointments/upload', [AppointmentController::class, 'uploadFile'])->name('appointment.upload');
    Route::get('/appointments/download/{id}', [AppointmentController::class, 'downloadFile'])->name('appointment.download');
    Route::post('/appointments/store', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::put('/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::delete('/appointment/file/{id}', [AppointmentController::class, 'deleteFile'])->name('appointment.deleteFile');

    // Employee management routes
    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/list', [EmployeeController::class, 'index'])->name('employee.index');
    Route::delete('/employee/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
});

// Logout route (accessible to anyone)
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/Plantilla', function () {
    // Placeholder for plantilla page
    return view('Pages.Plantilla.index');
})->name('Plantilla');

Route::get('/Nosa', function () {
    // Placeholder for plantilla page
    return view('Pages.Nosa.index');
})->name('Nosa');

Route::get('/notifications', function () {
    return view('Pages.Additional.notifications');
});

Route::get('/settings', function () {
    return view('Pages.Additional.setting');
});

Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
Route::put('/profile/update', [ProfileController::class, 'updateAccount'])->name('profile.update');

// Password reset OTP routes
Route::post('/password/send-otp', [\App\Http\Controllers\PasswordResetController::class, 'sendOTP'])->name('password.sendOtp');
Route::post('/password/verify-otp', [\App\Http\Controllers\PasswordResetController::class, 'verifyOTP'])->name('password.verifyOtp');
Route::post('/password/reset', [\App\Http\Controllers\PasswordResetController::class, 'resetPassword'])->name('password.reset');

Route::post('/register-modal', [AuthController::class, 'registerModal'])->name('register.modal');

Route::delete('/admin/delete/{id}', [AuthController::class, 'deleteAdmin'])->name('admin.delete');

// plantilla
Route::get('/office-mayor', [OfficeController::class, 'mayor'])->name('mayor.office');

// Personnel Routes
Route::get('/add-personnel', [PersonnelController::class, 'showAddForm'])->name('personnel.add');
Route::post('/add-personnel', [PersonnelController::class, 'store'])->name('personnel.store');

//personnel data
Route::get('/Plantilla', [PersonnelController::class, 'showIndex'])->name('Plantilla');
// filter
Route::post('/filtered-personnel', [PersonnelController::class, 'filterPersonnel']);

// nosa
Route::post('/add-nosa', [NosaController::class, 'store'])->name('nosa.store');
// web.php (routes file)

// Existing routes for listing personnel and viewing a specific NOSA
Route::get('/nosa', [NosaController::class, 'index'])->name('nosa.index');
Route::get('/nosa/{personnelId}', [NosaController::class, 'showNosa'])->name('nosa.show');

// Routes for generating and previewing the NOSA letter
Route::get('/generate-nosa/{personnel_id}', [NosaController::class, 'createForm'])->name('nosa.create');  // Form to generate letter
Route::post('/generate-nosa', [NosaController::class, 'generateLetter'])->name('nosa.generate');  // Submit form to generate the letter
Route::get('/generate-nosa/preview', [NosaController::class, 'previewLetter'])->name('nosa.preview');  // Preview generated letter
Route::post('/generate-nosa/print', [NosaController::class, 'printLetter'])->name('nosa.print');  // Print or download the letter as a PDF

// report
Route::get('/generate-report', [ReportController::class, 'show'])->name('generate.report');

Route::get('/test-otp', function () {
    return view('test_otp_route');
});

// Direct download route that bypasses middleware
Route::get('/direct-download/{id}', function($id) {
    try {
        $file = App\Models\File::findOrFail($id);
        $path = storage_path('app/public/' . $file->file_path);
        
        if (!file_exists($path)) {
            abort(404, 'File not found');
        }
        
        // Get file extension and set appropriate content type
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $contentTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'ppt' => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
        ];
        $contentType = $contentTypes[strtolower($extension)] ?? 'application/octet-stream';
        
        // Prepare download filename
        $fileName = $file->filename;
        if (!str_contains($fileName, '.')) {
            $fileName .= '.' . $extension;
        }
        
        // Use raw PHP for download
        ob_end_clean(); // Clear output buffer
        header('Content-Description: File Transfer');
        header('Content-Type: ' . $contentType);
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit;
    } catch (\Exception $e) {
        abort(500, 'File download error');
    }
})->name('direct.download')->middleware('web');

// Raw file download route without middleware
Route::get('/raw-download/{id}', function($id) {
    try {
        $file = App\Models\File::findOrFail($id);
        $path = storage_path('app/public/' . $file->file_path);
        
        if (!file_exists($path)) {
            echo 'File not found';
            exit;
        }
        
        // Get file info
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $fileName = $file->filename;
        if (!str_contains($fileName, '.')) {
            $fileName .= '.' . $extension;
        }
        
        // Set headers and output file using PHP directly
        if (ob_get_level()) ob_end_clean();
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit;
    } catch (\Exception $e) {
        echo 'Error: ' . $e->getMessage();
        exit;
    }
})->name('raw.download');









