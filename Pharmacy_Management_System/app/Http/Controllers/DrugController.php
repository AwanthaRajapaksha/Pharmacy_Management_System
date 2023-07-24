<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    public function index($drug_id){

        $drug = Drug::find($drug_id);
        if($drug){
            return response()->json([
                'status' => 200,
                'drug' => $drug,
            ]);
        }
        else{
            return response()->json([
                'status'=> 404
                ]);
        }
    }

    public function all(){

        $drugs = Drug::all();
        if($drugs){
            return response()->json([
                'status' => 200,
                'drugs' => $drugs,
            ]);
        }
        else{
            return response()->json([
                'status'=> 404
                ]);
        }
    }
}

