<?php

use App\Http\Controllers\Admin\ParkingLotController;
use App\Http\Controllers\Admin\ParkingSpaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\ReserveController;
use App\Repositories\AdminRepositories\ParkingLotRepository;
use App\Repositories\AdminRepositories\ReservationRepository;
use App\Repositories\AdminRepositories\ParkingSpaceRepository;
use App\Repositories\AdminRepositories\AuthenticationRepository;
use App\Repositories\AdminRepositories\ParkingLotCommentRepository;
use App\Repositories\AdminRepositories\UserRepository;

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

Route::prefix('admin')->group(function(){
    // Auth
    Route::post('/checkUser',[AuthenticationRepository::class,'checkUser'])->name('api.checkUser');
    Route::get('/getInfo',[AuthenticationRepository::class,'getInfo'])->middleware('auth:sanctum')->name('api.getInfo');
    Route::post('/logout',[AuthenticationRepository::class,'logout'])->middleware('auth:sanctum')->name('api.logout');
    Route::post('/updatePassword',[AuthenticationRepository::class,'updatePassword'])->middleware('auth:sanctum')->name('api.updatePassword');
    // Get Data
    Route::get('/getTotalReservation',[ReservationRepository::class,'getTotalReservation'])->middleware('auth:sanctum')->name('api.getTotalReservation');
});

Route::prefix('parkingLot')->group(function(){
    Route::get('/allData',[ParkingLotRepository::class,'showParkingLots'])->name('api.showParkingLots');
    Route::get('/{parkingLotId}/details',[ParkingLotRepository::class,'showParkingLotDetails'])->name('api.showParkingLotDetails');
    Route::post('/add',[ParkingLotController::class,'store'])->name('api.storeParkingLot');
    Route::delete('/{parkingLotId}/delete',[ParkingLotRepository::class,'deleteParkingLot'])->name('api.deleteParkingLot');
    Route::patch('/{parkingLotId}/update',[ParkingLotRepository::class,'updateParkingLotInformation'])->name('api.updateParkingLotInformation');
});

Route::prefix('parkingSpace')->group(function(){
    Route::get('/allData',[ParkingSpaceRepository::class,'showParkingSpaces'])->name('api.showParkingSpaces');
    Route::get('/{parkingSpaceId}/details',[ParkingSpaceRepository::class,'showParkingSpaceDetails'])->name('api.showParkingSpaceDetails');
    Route::get('filter/{parkingLotId}',[ParkingSpaceController::class,'getLayout'])->name('api.filter');
    Route::post('/updateLayout',[ParkingSpaceController::class,'updateLayout'])->name('api.updateLayout');
    Route::delete('/{parkingSpaceId}/delete',[ParkingSpaceController::class,'delete'])->name('api.deleteParkingSpace');
});

Route::prefix('comments')->group(function(){
    Route::get('/allComments',[ParkingLotCommentRepository::class,'showAllComments'])->name('api.showAllComments');
});

Route::prefix('reserve')->group(function(){
    Route::post('/',[ReserveController::class,'booking'])->name('api.book');
    Route::post('/payment',[PaymentController::class,'payment'])->name('api.makePayment');
    Route::post('/payment/store',[PaymentController::class,'store'])->name('api.storePayment');
    // Route::get('/payment/success',[ReserveController::class,'success'])->name('api.paymentSuccess');

    Route::post('/checkout',[ReserveController::class,'checkout'])->name('api.reserve.checkout');
    Route::get('/checkout/success',[ReserveController::class,'success'])->name('api.reserve.success');
    Route::get('/checkout/cancel',[ReserveController::class,'cancel'])->name('api.reserve.cancel');
    Route::post('/checkout/webhook',[ReserveController::class,'webhook'])->name('api.reserve.webhook');

});

Route::post('booking',[ReserveController::class,'booking'])->name('api.booking');
Route::patch('/{parkingSpaceId}/bookingStateUpdate',[ReserveController::class,'changeBookingState'])->name('api.bookingStateUpdate');

Route::get('test/{parkingLotId}',[ParkingSpaceController::class,'getLayout'])->name('api.name');

Route::get('/getUserInfo',[UserRepository::class, 'getUserInfo'])->name('api.getUserInfo');
