<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Http\Request;

class NosaController extends Controller
{
    // Existing method to list personnel
    public function index()
    {
        $personnels = Personnel::all(); // Fetch all personnel
        return view('pages.nosa.index', compact('personnels'));
    }

    // Show specific NOSA (for existing functionality)
    public function showNosa($personnelId)
    {
        // Find personnel by ID or fail if not found
        $personnels = Personnel::findOrFail($personnelId);
    
        // Pass the $personnel to the view
        return view('pages.nosa.show', compact('personnels'));
    }

    // Show the form to generate the NOSA letter
    public function createForm($personnel_id)
{
    // Fetch the selected personnel
    $personnel = Personnel::find($personnel_id);

    if (!$personnel) {
        // Handle the case when no personnel is found
        return redirect()->route('pages.nosa.index')->withErrors('Personnel not found.');
    }

    // Return the form view with personnel data
    return view('pages.nosa.form', compact('personnel'));
}


    // Generate the NOSA letter with the submitted data
    public function generateLetter(Request $request)
{
    // Validate the input
    $validated = $request->validate([
        'personnel_id' => 'required|exists:personnels,id',
        'salary_adjustment' => 'required|numeric',
        'current_salary' => 'required|numeric',
    ]);

    // Retrieve the selected personnel (make sure it exists)
    $personnel = Personnel::find($request->personnel_id);

    if (!$personnel) {
        // Handle the case when no personnel is found
        return redirect()->route('nosa.index')->withErrors('Personnel not found.');
    }

    $salary_adjustment = $request->salary_adjustment;
    $current_salary = $request->current_salary;

    // Generate letter data for preview
    return view('nosa.preview', compact('personnel', 'salary_adjustment', 'current_salary'));
}

    // Preview the generated letter before printing
    public function previewLetter()
    {
        // Here, you could add logic for previewing the letter before printing
        return view('pages.nosa.preview');
    }

    // Print or generate a PDF of the NOSA letter
    public function printLetter(Request $request)
    {
        // Logic to generate a PDF (requires a PDF package like dompdf or barryvdh/laravel-dompdf)
        $pdf = \PDF::loadView('nosa.pdf', compact('request'));
        return $pdf->download('nosa-letter.pdf');
    }
}