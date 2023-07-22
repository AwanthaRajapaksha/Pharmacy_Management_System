<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prescription;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class PrescriptionController extends Controller
{
    public function create()
    {
        return view('prescription.create');
    }

    public function store(Request $request)
    {

        //dd($request);
        $request->validate([
            'note' => 'nullable|string|max:255',
            'images' => 'required|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image file
        ]);

        $images = [];
        foreach ($request->file('images') as $index => $image) {
            if ($index < 5) {
                $randomString = rand(); // Generate a random string of length 16 characters
                $timestamp = time(); // Get the current timestamp
                $extension = $image->getClientOriginalExtension(); // Get the original file extension
                $filename = $timestamp . '_' . $randomString .'_image_' . ($index + 1) . '.' . $extension;
                $image->storeAs('public/images/prescription_images', $filename); // Store the image in the storage/app/prescription_images directory
                $images[] = $filename;
            }
        }

        // Pad the $images array with null values up to five elements
        $images = array_pad($images, 5, null);
        // Token Number Create
        $random ='INC'.rand();

        $prescription = Prescription::create([

            'user_id' => $request->input('user_id'),
            'note' => $request->input('note'),
            'address' => $request->input('address'),
            'prescription_token' => $random,
            'delivery_date' => $request->input('delivery_date'),
            'delivery_time' => $request->input('delivery_time'),
            'image1' => $images[0],
            'image2' => $images[1],
            'image3' => $images[2],
            'image4' => $images[3],
            'image5' => $images[4],
            'states' => 'Not Yet Send Quotations',
        ]);

        Session::flash('success', 'Answer saved successfully');
        return redirect()->back();
        // Redirect or return a response indicating success
    }


    public function GetPrescription($prescription_id){

        $prescription = Prescription::find($prescription_id);
        if($prescription){
            return response()->json([
            'status'=> 200,
            'prescription'=> $prescription
            ]);
        }
        else{
            return response()->json([
                'status'=> 404
                ]);
        }
     }
}
