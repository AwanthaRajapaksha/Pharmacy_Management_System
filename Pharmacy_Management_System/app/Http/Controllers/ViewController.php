<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    // start view all prescription
    public function index(){

        $Prescriptions = Prescription::all()->map(function ($prescription) {
            // Add an extra value to each prescription
            $prescription->user_type = Auth::user()->user_type;
            return $prescription;
        });
        return view('dashboard', compact('Prescriptions'));
        //dd($request);

    }
     // end view all prescription
}
