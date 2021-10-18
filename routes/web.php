<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});


//Register routes
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');


//Session routes
Route::get('/login', [SessionController::class, 'create'])->middleware('guest');
Route::post('/login', [SessionController::class, 'login'])->middleware(['guest', 'userStatus']);
Route::get('/logout', [SessionController::class, 'destroy'])->middleware('auth');

//User routes
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth', 'activeUser');


//Client routes
Route::prefix('clients')->group(function () {
    Route::get('/create/{id?}', [ClientController::class, 'create'])->middleware('auth', 'activeUser');
    Route::get('/invoices/{id?}', [ClientController::class, 'allInvoices'])->middleware('auth', 'activeUser');    
    Route::post('/save/{id?}', [ClientController::class, 'store'])->middleware('auth', 'activeUser');
    Route::get('/delete/{id}', [ClientController::class, 'delete'])->middleware('auth', 'activeUser');
    Route::get('/{id}', [ClientController::class, 'single'])->middleware('auth', 'activeUser');
    Route::get('', [ClientController::class, 'index'])->middleware('auth', 'activeUser');
});

//Invoice routes
Route::prefix('invoices')->group( function () {
    Route::get('/create/{id?}', [InvoiceController::class, 'create'])->middleware('auth', 'activeUser');
    Route::post('/save/{id?}', [InvoiceController::class, 'store'])->middleware('auth', 'activeUser');

});
