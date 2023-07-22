<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\UserController;


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

Route::get('/getprescription/{prob_id}', [PrescriptionController::class, "GetPrescription"]);

Route::get('/user', [UserController::class, 'index'])->name('user');
