<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ParkingLotController;
use App\Http\Controllers\Admin\ParkingSpaceController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ParkingLotController as ClientParkingLotController;
use App\Http\Controllers\Client\ParkingSpaceController as ClientParkingSpaceController;
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
    // mix route client and admin
    Route::get('/home',[ClientController::class,'index'])->name('test.home');
    Route::get('/home/inforGetting',[ClientController::class,'create'])->name('test.inforGetting');
    Route::post('/inforUpload',[ClientController::class,'store'])->name('test.inforUpload');
    Route::get('/home/allClient',[ClientController::class,'showAll'])->name('test.showAll');
    Route::get('/home/allClient/client{client_id}',[ClientController::class,'edit'])->name('test.editClientInfor');
    Route::patch('/home/allClient/client{client_id}/update',[ClientController::class,'update'])->name('test.updateClientInfor');
    Route::delete('/home/allClient/client{client_id}/delete',[ClientController::class,'destroy'])->name('test.deleteClientData');
    Route::get('/home/inforGetting/nowClient={client_id}/getParkingLot',[ClientParkingLotController::class,'showAvailable'])->name('test.showAvailableParkingLot');
    Route::get('/home/inforGetting/nowClient={client_id}/parkL={parking_lot_id}/getParkS',[ClientController::class,'getParkLID'])->name('test.getParkingLotID');
    Route::get('/home/inforGetting/nowClient={client_id}/parkL={parking_lot_id}/getParkS={parking_space_id}/getTime',[ClientController::class,'getParkSID'])->name('test.getParkingSpaceID');
    Route::patch('/home/inforGetting/nowClient={client_id}/parkL={parking_lot_id}/getParkS={parking_space_id}/getTime/reserve',[ClientController::class,'storeAllData'])->name('test.storeAllData');

    // admin
    Route::get('/admin/home',[AdminController::class,'index'])->name('test.adminHome');
    Route::get('/admin/home/addParkingLot',[ParkingLotController::class,'create'])->name('test.adminAddParkingLot');
    Route::post('/admin/home/addParkingLot/add',[ParkingLotController::class,'store'])->name('test.adminStoreParkingLot');
    Route::get('/admin/home/addParkingSpace',[ParkingSpaceController::class,'create'])->name('test.adminAddParkingSpace');
    Route::post('/admin/home/addParkingSpace/add',[ParkingSpaceController::class,'store'])->name('test.adminStoreParkingSpace');
    Route::get('/admin/home/allParkingLot',[ParkingLotController::class,'show'])->name('test.adminAllParkingLot');
    Route::delete('/admin/home/allParkingLot/delete={parking_lot_id}',[ParkingLotController::class,'destroy'])->name('test.adminDeleteParkingLot');
    Route::get('/admin/home/allParkingLot/editParkingLot={parking_lot_id}',[ParkingLotController::class,'edit'])->name('test.adminEditParkingLot');
    Route::patch('/admin/home/allParkingLot/editParkingLot={parking_lot_id}/update',[ParkingLotController::class,'update'])->name('test.adminUpdateParkingLot');
    Route::get('/admin/home/allParkingLot/detail={parking_lot_id}',[ParkingLotController::class,'detail'])->name('test.adminParkingLotDetail');

    Route::get('/fetch/parkL',[ClientParkingLotController::class,'fetch']);
    Route::get('/fetch/parkS',[ClientParkingSpaceController::class,'fetch']);
    
});