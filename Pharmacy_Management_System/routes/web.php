<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\EmailController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [ViewController::class, 'index'])->name('dashboard');

Route::get('/prescriptions/create', [PrescriptionController::class, 'create'])->name('prescriptions.create');

Route::post('/prescriptions', [PrescriptionController::class, 'store'])->name('prescriptions.store');

Route::get('/Get_Prescription/{prob_id}', [PrescriptionController::class, "GetPrescription"]);

Route::get('/user', [UserController::class, 'index'])->name('user');

Route::get('/Getdrug_Details/{drug_name}', [DrugController::class, 'index'])->name('get.drug.details');

Route::get('/Get_Drugs_Names', [DrugController::class, 'all'])->name('get.drugs.names');

Route::post('/Send_Email', [EmailController::class, 'index'])->name('send.email');

Route::post('/Get_Quatation_Type', [EmailController::class, 'getquatationtype'])->name('get.quatationtype');

Route::get('/get_quotations_details/{prescription_id}', [ViewController::class, 'quotation'])->name('get.quotation');




