<?php

use App\Http\Controllers\Api\v1\AmenitiesController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\BedTypeController;
use App\Http\Controllers\Api\v1\BookingsController;
use App\Http\Controllers\Api\v1\DashboardController;
use App\Http\Controllers\Api\v1\DestinationController;
use App\Http\Controllers\Api\v1\MealTypeController;
use App\Http\Controllers\Api\v1\PropertyControllerr;
use App\Http\Controllers\Api\v1\PropertyTypeController;
use App\Http\Controllers\Api\v1\PropertyController;
use App\Http\Controllers\Api\v1\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// v1 route list
Route::prefix('v1')->group(function() {
    Route::prefix('/auth/client')->group(function() {
        Route::post('/login-email', [AuthController::class , 'loginUserEmail']);
        Route::post('/login-password', [AuthController::class , 'loginUserPassword']);
        Route::post('/register', [AuthController::class , 'createUser']);
        Route::group(['middleware'=>'auth:sanctum'], function() {
            Route::post('/logout', [AuthController::class , 'logOutUser']);
            Route::get('/details', [AuthController::class , 'getUserDetails']);
            Route::post('/details/update', [AuthController::class , 'updateUserDetails']);
        });
    });
    
    Route::group(['middleware'=>'auth:sanctum'], function() {

        Route::get('/dashboard/data',[DashboardController::class, 'index']);

        Route::get('/property',[PropertyController::class, 'index']);
        Route::get('/property/create',[PropertyController::class, 'create']);
        Route::get('/property/update',[PropertyController::class, 'update']);
        Route::get('/property/delete',[PropertyController::class, 'delete']);

        Route::get('/bookings',[BookingsController::class, 'index']);
        Route::get('/bookings/create',[BookingsController::class, 'create']);
        Route::get('/bookings/update',[BookingsController::class, 'update']);
        Route::get('/bookings/delete',[BookingsController::class, 'delete']);

        Route::get('/rooms',[RoomController::class, 'index']);
        Route::get('/rooms/create',[RoomController::class, 'create']);
        Route::get('/rooms/update',[RoomController::class, 'update']);
        Route::get('/rooms/delete',[RoomController::class, 'delete']);

        Route::get('/amenities',[AmenitiesController::class, 'index']);
        Route::get('/amenities/create',[AmenitiesController::class, 'create']);
        Route::get('/amenities/update',[AmenitiesController::class, 'update']);
        Route::get('/amenities/delete',[AmenitiesController::class, 'delete']);
    

    
        Route::get('/booking-items',[BookingItemsController::class, 'index']);
        Route::get('/booking-items/create',[BookingItemsController::class, 'create']);
        Route::get('/booking-items/update',[BookingItemsController::class, 'update']);
        Route::get('/booking-items/delete',[BookingItemsController::class, 'delete']);
    
        Route::get('/property-type',[PropertyTypeController::class, 'index']);
        Route::get('/property-type/create',[PropertyTypeController::class, 'create']);
        Route::get('/property-type/update',[PropertyTypeController::class, 'update']);
        Route::get('/property-type/delete',[PropertyTypeController::class, 'delete']);
    
        Route::get('/destination',[DestinationController::class, 'index']);

        Route::get('/meal-types',[MealTypeController::class, 'index']);
        Route::post('/meal-types/create',[MealTypeController::class, 'create']);
        Route::get('/meal-types/update',[MealTypeController::class, 'update']);

        Route::get('/bed-types',[BedTypeController::class, 'index']);
        Route::post('/bed-types/create',[BedTypeController::class, 'create']);
        Route::get('/bed-types/update',[BedTypeController::class, 'update']);

        

        // Route::get('/bookings'[]);
        // Route::get('/bookings/update'[]);

        // Route::get('/offers'[]);
        // Route::get('/offers/create'[]);
        // Route::get('/offers/update'[]);

        // Route::get('/properties'[]);
        // Route::get('/properties/create'[]);
        // Route::get('/properties/update'[]);


    });

    // Route::get('/amenities',[AmenitiesController::class, 'index']);
    // Route::get('/amenities/create',[AmenitiesController::class, 'create']);
    // Route::get('/amenities/update',[AmenitiesController::class, 'update']);
    // Route::get('/amenities/delete',[AmenitiesController::class, 'delete']);

    // Route::get('/bookings',[BookingsController::class, 'index']);
    // Route::get('/bookings/create',[BookingsController::class, 'create']);
    // Route::get('/bookings/update',[BookingsController::class, 'update']);
    // Route::get('/bookings/delete',[BookingsController::class, 'delete']);

    // Route::get('/bookingItems',[BookingItemsController::class, 'index']);
    // Route::get('/bookingItems/create',[BookingItemsController::class, 'create']);
    // Route::get('/bookingItems/update',[BookingItemsController::class, 'update']);
    // Route::get('/bookingItems/delete',[BookingItemsController::class, 'delete']);

    // Route::get('/property',[PropertyController::class, 'index']);
    // Route::get('/property/create',[PropertyController::class, 'create']);
    // Route::get('/property/update',[PropertyController::class, 'update']);
    // Route::get('/property/delete',[PropertyController::class, 'delete']);

    // Route::get('/propertyType',[PropertyTypeController::class, 'index']);
    // Route::get('/propertyType/createp',[PropertyTypeController::class, 'create']);
    // Route::get('/propertyType/update',[PropertyTypeController::class, 'update']);
    // Route::get('/propertyType/delete',[PropertyTypeController::class, 'delete']);

    // Route::get('/destination',[DestinationController::class, 'index']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
