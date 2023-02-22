<?php

use App\Http\Controllers\Client\ClientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ADMIN_ROUTE

Route::prefix('admin')->group(function(){

    Route::get('/home');
    
});

// CLIENT_ROUTE

Route::get('/', function () {
    return view('welcome');
});

// TESTING_ROUTE

Route::prefix('test')->group(function(){

    Route::get('/home',[ClientController::class,'index'])->name('test.home');
    Route::get('/home/inforGetting',[ClientController::class,'create'])->name('test.inforGetting');
    Route::post('/inforUpload',[ClientController::class,'store'])->name('test.inforUpload');

});