<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Repositories\AdminRepositories\ParkingLotRepository;
use App\Repositories\AdminRepositories\ParkingSpaceRepository;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('parkingLot')->group(function(){
    Route::get('/allData',[ParkingLotRepository::class,'showParkingLots'])->name('api.showParkingLots');
    Route::get('/{parkingLotId}/details',[ParkingLotRepository::class,'showParkingLotDetails'])->name('api.showParkingLotDetails');
});

Route::prefix('parkingSpace')->group(function(){
    Route::get('/allData',[ParkingSpaceRepository::class,'showParkingSpaces'])->name('api.showParkingSpaces');
    Route::get('/{parkingSpaceId}/details',[ParkingLotRepository::class,'showParkingSpaceDetails'])->name('api.showParkingSpaceDetails');
});