<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function mayor()
    {
        return view('pages.Plantilla.offices.mo'); // Match the correct file path
    }
}
