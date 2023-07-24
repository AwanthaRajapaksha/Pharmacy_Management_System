<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendQuatation;
use App\Mail\SendStates;
use App\Models\User;
use App\Models\Quotation;
use App\Models\Prescription;

class EmailController extends Controller
{
    public function index(Request $request){

        // $request->validate([
        //     'tableData' => 'required|array',
        //     'totalAmount' => 'required|numeric',
        //     'userid' => 'required|exists:users,id',
        //     'prescription_token' => 'required|string',
        //     'prescription_id' => 'required|exists:prescriptions,id',
        // ]);

        $tableData = $request->input('tableData');
        $totalAmount = $request->input('totalAmount');
        $userId = $request->input('userid');
        $prescription_token = $request->input('prescription_token');
        $prescription_id = $request->input('prescription_id');
        $states ='Under review';

        // get user email address sent to user email
        $User = User::find($userId);
        $user_email = $User->email;

        // Save Quatations
        $quotation = new Quotation();
        $quotation->userId = $userId;
        $quotation->prescription_id = $prescription_id;
        $quotation->totalAmount = $totalAmount;
        $quotation->tableData = $tableData;
        $quotation->save();


        // update pescription States Under review
        $prescription = Prescription::find($prescription_id);
        $prescription->states = $states;
        $prescription->save();


        if($request){
            $email_data = [
                'prescription_token' => $prescription_token,
            ];

            $recipientEmail = $user_email;
            Mail::to($recipientEmail)->send(new SendQuatation( $email_data));

            return response()->json([
                'status' => 200,
                'table' => $request->tableData,
            ]);
        }
        else{
            return response()->json([
                'status'=> 404
                ]);
        }

    }

    public function getquatationtype(Request $request){

        $prescription_id = $request->input('prescription_id');
        $states = $request->input('states');
        $userId = $request->input('userId');
        $prescription_token = $request->input('prescription_token');

        // get user email address sent to admin email
        $User = User::find($userId);
        $user_email = $User->email;

        // update pescription States Accept or Reject
        $prescription = Prescription::find($prescription_id);
        $prescription->states = $states;
        $prescription->save();


        if($request){
            $email_data = [
                'prescription_token' => $prescription_token,
                'states' => $states,
            ];

            $recipientEmail = $user_email;
            Mail::to($recipientEmail)->send(new SendStates( $email_data));

            return response()->json([
                'status' => 200,
                'emailbody' => $user_email,
            ]);
        }
        else{
            return response()->json([
                'status'=> 404
                ]);
        }

    }
}
