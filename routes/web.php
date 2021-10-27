<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SendMailController;
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

Route::get('/', function (){
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
Route::get('/stats', [UserController::class, 'stats'])->middleware('auth', 'activeUser');
Route::post('/user/delete/{user}', [UserController::class, 'delete'])->middleware('auth', 'activeUser');




//Client routes
Route::prefix('clients')->group(function () {
    Route::get('/create/{client?}', [ClientController::class, 'create'])->middleware('auth', 'activeUser');
    Route::get('/invoices/{client?}', [ClientController::class, 'allInvoices'])->middleware('auth', 'activeUser');    
    Route::post('/save/{client?}', [ClientController::class, 'store'])->middleware('auth', 'activeUser');
    Route::post('/delete/{client}', [ClientController::class, 'delete'])->middleware('auth', 'activeUser');
    Route::get('/{client}', [ClientController::class, 'single'])->middleware('auth', 'activeUser');
    Route::get('', [ClientController::class, 'index'])->middleware('auth', 'activeUser');
});

//Invoice routes
Route::prefix('invoices')->group( function () {
    Route::get('/create/{invoice?}', [InvoiceController::class, 'create'])->middleware('auth', 'activeUser');
    Route::post('/save/{invoice?}', [InvoiceController::class, 'store'])->middleware('auth', 'activeUser');
    Route::post('/delete/{invoice}', [InvoiceController::class, 'delete'])->middleware('auth', 'activeUser');
    Route::get('/change/{invoice}', [InvoiceController::class, 'changeIsPaidStatus'])->middleware('auth', 'activeUser');
    Route::get('/toggle/{invoice}', [InvoiceController::class, 'toggleStatus'])->middleware('auth', 'activeUser');
    Route::get('/export/{invoice}', [InvoiceController::class, 'export'])->middleware('auth', 'activeUser');
    Route::get('/pdf/{invoice}', [InvoiceController::class, 'downloadPDF'])->middleware('auth', 'activeUser');
    Route::get('/add-to-client/{client}', [InvoiceController::class, 'addToClient'])->middleware('auth', 'activeUser');
    Route::post('/save-for-client/{client}', [InvoiceController::class, 'addInvoiceToClient'])->middleware('auth', 'activeUser');
    Route::get('/{invoice}', [InvoiceController::class, 'single'])->middleware('auth', 'activeUser');
    Route::get('', [InvoiceController::class, 'index'])->middleware('auth', 'activeUser');
    //Mail route
    Route::get('/send/{invoice}', [SendMailController::class, 'send'])->middleware('auth', 'activeUser');


});

//Item routes
Route::prefix('items')->group( function () {
    Route::post('/create', [ItemController::class, 'store'])->middleware('auth', 'activeUser');
    Route::post('/delete/{item}', [ItemController::class, 'delete'])->middleware('auth', 'activeUser');
});



