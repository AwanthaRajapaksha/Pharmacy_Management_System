<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    // start view all prescription
    public function index(){

        $Prescriptions = Prescription::all()->map(function ($prescription) {
            $prescription->user_type = Auth::user()->user_type;
            return $prescription;
        });
        return view('dashboard', compact('Prescriptions'));
        //dd($request);

    }
     // end view all prescription

     public function quotation($prescription_id){

        $quotation = Quotation::where('prescription_id', $prescription_id)->first();

        if($quotation){
            return response()->json([
            'status'=> 200,
            'quotation'=> $quotation
            ]);
        }
        else{
            return response()->json([
                'status'=> 404,
                'message' => 'quotation unsuccessfully',
                ]);
        }

    }
}
