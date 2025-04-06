<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personnel;
use App\Models\Employee;
use Carbon\Carbon;

class PersonnelController extends Controller
{
    public function showIndex()
    {
        $personnels = Personnel::all();  // Fetch all personnel records
        return view('pages.Plantilla.index', compact('personnels'));
    }

    // Method to show the add personnel form/modal
    public function showAddForm()
    {
        // Fetch all employees for the dropdown
        $employees = Employee::all();
        
        // Get list of employee names who already have permanent positions
        $permanentPersonnel = Personnel::where('status', 'permanent')
            ->orWhere('status', 'regularPermanent')
            ->get();
            
        // Create arrays of full names for comparison
        $existingPersonnelNames = [];
        
        foreach ($permanentPersonnel as $person) {
            $fullName = trim($person->firstName . ' ' . $person->lastName);
            $existingPersonnelNames[] = strtolower($fullName);
        }
        
        return view('add_personnel', compact('employees', 'existingPersonnelNames'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'office' => 'required',
            'itemNo' => 'required',
            'position' => 'required',
            'salaryGrade' => 'required',
            'authorizedSalary' => 'required',
            'actualSalary' => 'required',
            'step' => 'required',
            'code' => 'required',
            'type' => 'required',
            'level' => 'required',
            'lastName' => 'required',
            'firstName' => 'required',
            'middleName' => 'nullable',
            'dob' => 'required|date',
            'originalAppointment' => 'required|date',
            'lastPromotion' => 'nullable|date',
            'status' => 'required',
        ]);

        // Compute Remarks based on Age
        $dob = Carbon::parse($validatedData['dob']);
        $age = $dob->age;

        if ($age > 60) {
            $validatedData['remarks'] = "retired";
        } elseif ($age == 60) {
            $validatedData['remarks'] = "retirable";
        } else {
            $validatedData['remarks'] = "non-retirable";
        }

        // Set lastPromotion to NULL if empty
        $validatedData['lastPromotion'] = $request->input('lastPromotion') ?: null;

        // Insert Personnel with Remarks
        Personnel::create($validatedData);

        return redirect()->route('Plantilla')->with('success', 'Personnel added successfully!');
    }

    public function filterPersonnel(Request $request)
    {
        $filters = $request->all();
        $currentYear = Carbon::now()->year;
    
        $personnels = Personnel::query();
    
        // Apply Filters (office, service, remarks, etc.)  
        if (isset($filters['office'])) {
            $personnels->where('office', $filters['office']);
        }
    
        if (isset($filters['status'])) {
            $personnels->where('status', $filters['status']);
        }
    
        // Fetch personnel records
        $personnels = $personnels->get();
    
        return response()->json(['personnels' => $personnels]);
    }
}
