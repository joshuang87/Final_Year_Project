<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ReserveController;
use App\Repositories\AdminRepositories\ParkingLotRepository;
use App\Repositories\AdminRepositories\ParkingSpaceRepository;
use App\Repositories\AdminRepositories\ParkingLotCommentRepository;

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
    Route::delete('/{parkingLotId}/delete',[ParkingLotRepository::class,'deleteParkingLot'])->name('api.deleteParkingLot');
    Route::patch('/{parkingLotId}/update',[ParkingLotRepository::class,'updateParkingLotInformation'])->name('api.updateParkingLotInformation');
});

Route::prefix('parkingSpace')->group(function(){
    Route::get('/allData',[ParkingSpaceRepository::class,'showParkingSpaces'])->name('api.showParkingSpaces');
    Route::get('/{parkingSpaceId}/details',[ParkingLotRepository::class,'showParkingSpaceDetails'])->name('api.showParkingSpaceDetails');
});

Route::prefix('comments')->group(function(){
    Route::get('/allComments',[ParkingLotCommentRepository::class,'showAllComments'])->name('api.showAllComments');
});

Route::prefix('reserve')->group(function(){
    Route::post('/payment',[ReserveController::class,'payment'])->name('api.makePayment');
    Route::get('/payment/success',[ReserveController::class,'success'])->name('api.paymentSuccess');
});

Route::get('userData',function(){
    dd(User::all());    
});

Route::post('checkLogin',function(Request $request){
    
    $data = $request->validate([
        'name' => ['required'],
        'password' => ['required']
    ]);

    if(Auth::attempt($data)) {
        return 'SUCCESS';
    }
    else {
        return response('Username or password incorrect',401);
    }
});