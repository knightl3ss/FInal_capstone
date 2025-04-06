<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File; // Import the File model
use App\Models\Appointment;
use App\Models\Employee;

class AppointmentController extends Controller
{
    // Show Appointment Index Page
    public function index()
    {
        return view('Pages.appointments.index'); // Ensure correct case for 'Pages'
    }

    // Show Appointment Form Options Page
    public function showForm()
    {
        // Fetch all uploaded files to display in the table
        $files = File::all();
        return view('Pages.appointments.form', compact('files')); // Ensure correct case for 'Pages'
    }

    // Show Appointment Schedule Page
    public function showSchedule(Request $request)
    {
        // Get the appointment type from the request, default to null
        $appointmentType = $request->input('appointment_type', null);

        // Retrieve appointments based on the selected type or all if none is selected
        if ($appointmentType) {
            $appointments = Appointment::where('appointment_type', $appointmentType)->get();
        } else {
            $appointments = Appointment::all(); // Get all appointments if no type is specified
        }

        // Fetch all employees for the dropdown, including IDs for better matching
        $employees = Employee::all();
        
        // Get a list of employee names who already have appointments
        $appointedEmployees = Appointment::select('id', 'name')->get();
        $appointedEmployeeNames = $appointedEmployees->pluck('name')->toArray();
        
        // Create a list of employee ID to appointment ID mapping for the add form
        $appointedEmployeeMapping = [];
        $appointmentsByName = [];
        
        foreach ($appointedEmployees as $appointment) {
            $appointmentsByName[$appointment->name] = $appointment->id;
        }

        // Pass all data to the view
        return view('Pages.appointments.schedule', compact(
            'appointments', 
            'appointmentType', 
            'employees', 
            'appointedEmployeeNames',
            'appointedEmployees',
            'appointmentsByName'
        ));
    }

    // Handle file upload
    public function uploadFile(Request $request)
    {
        // Define custom error messages
        $messages = [
            'file.required' => 'Please select a file to upload.',
            'file.mimes' => 'The file must be a PDF, JPG, PNG, or DOCX file.',
            'file.max' => 'The file size must not exceed 100MB.',
        ];

        // Validate the incoming request
        $validated = $request->validate([
            'filename' => 'required|string|max:255',
            'file' => 'required|file|mimes:zip,rar,pdf,jpg,png,xlsx,ppt,docx|max:2400000',
        ], $messages);

        // If validation passes, proceed with file upload
        if ($validated) {
            // Store the file in the public/uploads directory
            $path = $request->file('file')->store('scannedAppointmentDocs', 'public');

            // Save the file information to the database
            File::create([
                'filename' => $request->filename,
                'file_path' => $path,
            ]);

            // Redirect back to the appointment form page with success message
            return redirect()->route('appointment.form')->with('success', 'File uploaded successfully');
        }
    }

    // Handle file download
    public function downloadFile($id)
    {
        try {
            // First check if the file exists
            $file = File::findOrFail($id);
            
            if (!Storage::disk('public')->exists($file->file_path)) {
                return redirect()->back()->with('error', 'File not found on server.');
            }
            
            // Redirect to the direct download route
            return redirect()->route('direct.download', ['id' => $id]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Download error: ' . $e->getMessage());
        }
    }

    public function deleteFile($id)
    {
        $file = File::findOrFail($id); // Adjust this based on your file storage
        $file->delete();

        return redirect()->back()->with('success', 'File deleted successfully.');
    }


    // Handle storing a new appointment
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'rate_per_day' => 'required|numeric',
            'employment_start' => 'required|date',
            'employment_end' => 'required|date',
            'source_of_fund' => 'required|string|max:255',
            'office_assignment' => 'required|string|max:255',
            'appointment_type' => 'required|string|max:255',
        ]);

        // Capitalize before saving
        $validated['name'] = ucwords(strtolower($validated['name']));
        $validated['position'] = ucwords(strtolower($validated['position']));
        $validated['office_assignment'] = ucwords(strtolower($validated['office_assignment']));

        // Create a new appointment record
        Appointment::create($validated);

        // Redirect back to the appointment form page with success message
        return redirect()->route('appointment.schedule')->with('success', 'Appointment added successfully');
    }

    // Handle editing appointment
    public function update(Request $request, $id)
    {
        // Find the appointment that is being updated
        $appointment = Appointment::findOrFail($id);
        
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'rate_per_day' => 'required|numeric',
            'employment_start' => 'required|date',
            'employment_end' => 'required|date',
            'source_of_fund' => 'required|string|max:255',
            'office_assignment' => 'required|string|max:255',
            'appointment_type' => 'required|string|max:255',
        ]);

        // Capitalize before saving
        $validated['name'] = ucwords(strtolower($validated['name']));
        $validated['position'] = ucwords(strtolower($validated['position']));
        $validated['office_assignment'] = ucwords(strtolower($validated['office_assignment']));

        // Update the appointment
        $appointment->update($validated);

        // Redirect back with a success message
        return redirect()->route('appointment.schedule')->with('success', 'Appointment updated successfully');
    }


    // Handle removing an appointment
    public function destroy($id)
    {
        // Find the appointment by ID
        $appointment = Appointment::findOrFail($id);

        // Delete the appointment
        $appointment->delete();

        // Redirect back with a success message
        return redirect()->route('appointment.schedule')->with('success', 'Appointment removed successfully');
    }
}
