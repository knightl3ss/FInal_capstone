<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display the Add Employee form
     */
    public function create()
    {
        return view('Pages.Employee.Add_employee');
    }

    /**
     * Store a newly created employee in storage
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'age' => 'required|integer|min:18|max:100',
            'birthday' => 'required|date|before:today',
            'address_street' => 'required|string|max:255',
            'address_city' => 'required|string|max:255',
            'address_state' => 'required|string|max:255',
            'address_postal_code' => 'required|string|max:10',
            'email' => 'required|email|unique:employees,email',
            'phone_number' => 'required|string|regex:/^[0-9]{10,15}$/',
            'gender' => 'required|string|in:male,female,other',
            'extension_name' => 'nullable|string|max:10',
            'employee_id' => 'required|string|unique:employees,employee_id|max:20',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Create new employee
            $employee = Employee::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'extension_name' => $request->extension_name,
                'age' => $request->age,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'address_street' => $request->address_street,
                'address_city' => $request->address_city,
                'address_state' => $request->address_state,
                'address_postal_code' => $request->address_postal_code,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'employee_id' => $request->employee_id,
            ]);

            // Log successful employee creation
            Log::info('New employee added', [
                'employee_id' => $employee->id,
                'email' => $employee->email,
                'full_name' => $employee->getFullNameAttribute()
            ]);

            // Redirect back with success message
            return redirect()->route('employee.index')->with('success', 'Employee added successfully.');

        } catch (\Exception $e) {
            // Log error and redirect back with error message
            Log::error('Failed to add employee', [
                'error' => $e->getMessage(),
                'input' => $request->all()
            ]);

            return redirect()->back()
                ->with('error', 'Failed to add employee: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display a listing of employees
     */
    public function index()
    {
        $employees = Employee::orderBy('created_at', 'desc')->get();
        return view('Pages.Employee.index', compact('employees'));
    }

    /**
     * Remove the specified employee from storage
     */
    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            
            // Delete the employee
            $employee->delete();
            
            // Log successful deletion
            Log::info('Employee deleted', [
                'employee_id' => $id,
                'email' => $employee->email,
                'deleted_by' => auth()->id()
            ]);
            
            return redirect()->route('employee.index')->with('success', 'Employee deleted successfully.');
            
        } catch (\Exception $e) {
            // Log error
            Log::error('Failed to delete employee', [
                'error' => $e->getMessage(),
                'employee_id' => $id
            ]);
            
            return redirect()->route('employee.index')->with('error', 'Failed to delete employee: ' . $e->getMessage());
        }
    }
} 