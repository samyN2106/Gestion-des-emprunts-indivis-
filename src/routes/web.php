<?php

use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
use App\Models\Loan;
use Illuminate\Support\Facades\Route;
 

Route::get('/', function () {
    return view('dashboard');
})->name('main');

Route::get('clients',[UserController::class,'ClientsList'])->name('client');
Route::get('add-client',[UserController::class,'form_add_client'])->name('add-client');
Route::post('add-client',[UserController::class,'store_client'])->name('add-client');

Route::get('emprunts',[LoanController::class,'index'])->name('emprunts');

Route::get('details',[LoanController::class,'LoanDetails'])->name('details');

Route::get('attribution-pret',[LoanController::class,'AssignLoan'])->name('attribution-pret');

Route::post('attribution-pret',[LoanController::class,'LoanStorage'])->name('attribution-pret');

Route::get('gestion-versements',[LoanController::class,'gestionVersements'])->name('gestionVersements');

Route::post('gestion-versements',[LoanController::class,'versementStorage'])->name('gestionVersements');


Route::get('modifier-profil',function(){
    return view('modifier-profil');
})->name('modifier-profil');


Route::get('login',function(){
    return view('login');
})->name('login');


