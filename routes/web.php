<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\BackendAuthController;
use App\Http\Controllers\BackendUserController;
use App\Http\Controllers\BedTypeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContantPageController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\AllotmentController;
use App\Http\Controllers\DestinationFeatureController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\FormBuilder;
use App\Http\Controllers\FrontendUserController;
use App\Http\Controllers\MealTypeController;
use App\Http\Controllers\MediaLibraryController;
use App\Http\Controllers\NearPlaceController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PaymentOptionController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TaxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsAppController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingForcastController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


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
 

Route::post('/webhook', [WhatsAppController::class, 'handleWebhook']);
Route::get('/build-form', function () {
    return view('build-form');
});
Route::post('/create-build-form', [FormBuilder::class, 'buildForm'])->name('create-build-form');
Route::post('/whatsapp/webhook', [WhatsAppController::class, 'handleWebhook']);
Route::group(['middleware' => ['auth:sanctum', 'verified', 'web']], function () {
    Route::get('/two-step-verification', [BackendAuthController::class, 'twoStepRequest'])->name('2fa.request');
    Route::post('/two-step-verification', [BackendAuthController::class, 'twoStepVerify'])->name('2fa.verify');
    Route::get('/activate', [BackendAuthController::class, 'activateProfileView'])->name('profile.activate.request');
    Route::post('/activate', [BackendAuthController::class, 'activateProfile'])->name('profile.activate');
});

Route::group(['middleware' => ['auth:sanctum', 'verified', 'web', 'profile.activate']], function () {

    Route::get('/', function () {
        return redirect('/admin/dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // meal types
    Route::prefix('meal-type')->group(function () {
        Route::get('/', [MealTypeController::class, 'index'])->middleware(['can:meal-type.view'])->name('meal.types.index');
        Route::get('/getdata', [MealTypeController::class, 'getdata'])->middleware(['can:meal-type.view'])->name('meal.types.getdata');
        Route::get('/create', [MealTypeController::class, 'create'])->middleware(['can:meal-type.create'])->name('meal.types.create');
        Route::post('/store', [MealTypeController::class, 'store'])->middleware(['can:meal-type.create'])->name('meal.types.store');
        Route::get('/edit/{id}', [MealTypeController::class, 'edit'])->middleware(['can:meal-type.edit'])->name('meal.types.edit');
        Route::post('/update', [MealTypeController::class, 'update'])->middleware(['can:meal-type.edit'])->name('meal.types.update');
        Route::put('/update-status', [MealTypeController::class, 'updateStatus'])->middleware(['can:meal-type.edit'])->name('meal.types.status');
        Route::post('/delete', [MealTypeController::class, 'destroy'])->middleware(['can:meal-type.delete'])->name('meal.types.delete');
        // property meal types
        Route::get('/property/meal-types', [MealTypeController::class, 'propertyMealTypeIndex'])->middleware(['can:meal-type.view','can:meal-type.create'])->name('property.meal-types.index');
        Route::post('/property/meal-types/update', [MealTypeController::class, 'propertyMealTypeUpdate'])->middleware(['can:meal-type.view','can:meal-type.edit'])->name('property.meal-types.update');
    });
    // bed types
    Route::prefix('bed-type')->group(function () {
        Route::get('/', [BedTypeController::class, 'index'])->middleware(['can:bed-type.view'])->name('bed.types.index');
        Route::get('/getdata', [BedTypeController::class, 'getdata'])->middleware(['can:bed-type.view'])->name('bed.types.getdata');
        Route::get('/create', [BedTypeController::class, 'create'])->middleware(['can:bed-type.create'])->name('bed.types.create');
        Route::post('/store', [BedTypeController::class, 'store'])->middleware(['can:bed-type.create'])->name('bed.types.store');
        Route::get('/edit/{id}', [BedTypeController::class, 'edit'])->middleware(['can:bed-type.edit'])->name('bed.types.edit');
        Route::post('/update', [BedTypeController::class, 'update'])->middleware(['can:bed-type.edit'])->name('bed.types.update');
        Route::put('/update-status', [BedTypeController::class, 'updateStatus'])->middleware(['can:bed-type.edit'])->name('bed.types.status');
        Route::post('/delete', [BedTypeController::class, 'destroy'])->middleware(['can:bed-type.delete'])->name('bed.types.delete');
        // property bed types
        Route::get('/property/bed-types', [BedTypeController::class, 'propertyBedTypeIndex'])->middleware(['can:bed-type.view','can:bed-type.create'])->name('property.bed-types.index');
        Route::post('/property/bed-types/update', [BedTypeController::class, 'propertyBedTypeUpdate'])->middleware(['can:bed-type.view','can:bed-type.edit'])->name('property.bed-types.update');

    });
    // activities
    Route::prefix('activities')->group(function () {
        Route::get('/', [ActivityController::class, 'index'])->middleware(['can:activity.view'])->name('activity.index');
        Route::get('/getdata', [ActivityController::class, 'getdata'])->middleware(['can:activity.view'])->name('activity.getdata');
        Route::get('/create', [ActivityController::class, 'create'])->middleware(['can:activity.create'])->name('activity.create');
        Route::post('/store', [ActivityController::class, 'store'])->middleware(['can:activity.create'])->name('activity.store');
        Route::get('/edit/{id}', [ActivityController::class, 'edit'])->middleware(['can:activity.edit'])->name('activity.edit');
        Route::post('/update', [ActivityController::class, 'update'])->middleware(['can:activity.edit'])->name('activity.update');
        Route::put('/update-status', [ActivityController::class, 'updateStatus'])->middleware(['can:activity.edit'])->name('activity.status');
        Route::post('/delete', [ActivityController::class, 'destroy'])->middleware(['can:activity.delete'])->name('activity.delete');
    });
    // partners
    Route::prefix('partners')->group(function () {
        Route::get('/', [PartnerController::class, 'index'])->middleware(['can:partner.view'])->name('partners.index');
        Route::get('/getdata', [PartnerController::class, 'getdata'])->middleware(['can:partner.view'])->name('partners.getdata');
        Route::get('/create', [PartnerController::class, 'create'])->middleware(['can:partner.create'])->name('partners.create');
        Route::post('/store', [PartnerController::class, 'store'])->middleware(['can:partner.create'])->name('partners.store');
        Route::get('/edit/{id}', [PartnerController::class, 'edit'])->middleware(['can:partner.edit'])->name('partners.edit');
        Route::post('/update', [PartnerController::class, 'update'])->middleware(['can:partner.edit'])->name('partners.update');
        Route::put('/update-status', [PartnerController::class, 'updateStatus'])->middleware(['can:partner.edit'])->name('partners.status');
        Route::post('/delete', [PartnerController::class, 'destroy'])->middleware(['can:partner.delete'])->name('partners.delete');
        Route::post('/reorder', [PartnerController::class, 'reorder'])->middleware(['can:partner.edit'])->name('partners.reorder');
        
    });
    // operators
    Route::prefix('operators')->group(function () {
        Route::get('/', [OperatorController::class, 'index'])->middleware(['can:operator.view'])->name('operators.index');
        Route::get('/getdata', [OperatorController::class, 'getdata'])->middleware(['can:operator.view'])->name('operators.getdata');
        Route::get('/create', [OperatorController::class, 'create'])->middleware(['can:operator.create'])->name('operators.create');
        Route::post('/store', [OperatorController::class, 'store'])->middleware(['can:operator.create'])->name('operators.store');
        Route::get('/edit/{id}', [OperatorController::class, 'edit'])->middleware(['can:operator.edit'])->name('operators.edit');
        Route::post('/update', [OperatorController::class, 'update'])->middleware(['can:operator.edit'])->name('operators.update');
        Route::put('/update-status', [OperatorController::class, 'updateStatus'])->middleware(['can:operator.edit'])->name('operators.status');
        Route::post('/delete', [OperatorController::class, 'destroy'])->middleware(['can:operator.delete'])->name('operators.delete');
        // Route::post('/reorder', [PartnerController::class, 'reorder'])->middleware(['can:operator.edit'])->name('operators.reorder');
        
    });
    // careers
    Route::prefix('careers')->group(function () {
        Route::get('/', [CareerController::class, 'index'])->middleware(['can:career.view'])->name('careers.index');
        Route::get('/getdata', [CareerController::class, 'getdata'])->middleware(['can:career.view'])->name('careers.getdata');
        Route::get('/create', [CareerController::class, 'create'])->middleware(['can:career.create'])->name('careers.create');
        Route::post('/store', [CareerController::class, 'store'])->middleware(['can:career.create'])->name('careers.store');
        Route::get('/edit/{id}', [CareerController::class, 'edit'])->middleware(['can:career.edit'])->name('careers.edit');
        Route::post('/update', [CareerController::class, 'update'])->middleware(['can:career.edit'])->name('careers.update');
        Route::put('/update-status', [CareerController::class, 'updateStatus'])->middleware(['can:career.edit'])->name('careers.status');
        Route::post('/delete', [CareerController::class, 'destroy'])->middleware(['can:career.delete'])->name('careers.delete');
        // Route::post('/reorder', [CareerController::class, 'reorder'])->middleware(['can:career.edit'])->name('careers.reorder');
        
    });
    // property types
    Route::prefix('property-type')->group(function () {
        Route::get('/', [PropertyTypeController::class, 'index'])->middleware(['can:property-type.view'])->name('property.types.index');
        Route::get('/getdata', [PropertyTypeController::class, 'getdata'])->middleware(['can:property-type.view'])->name('property.types.getdata');
        Route::get('/create', [PropertyTypeController::class, 'create'])->middleware(['can:property-type.create'])->name('property.types.create');
        Route::post('/store', [PropertyTypeController::class, 'store'])->middleware(['can:property-type.create'])->name('property.types.store');
        Route::get('/edit/{id}', [PropertyTypeController::class, 'edit'])->middleware(['can:property-type.edit'])->name('property.types.edit');
        Route::post('/update', [PropertyTypeController::class, 'update'])->middleware(['can:property-type.edit'])->name('property.types.update');
        Route::put('/update-status', [PropertyTypeController::class, 'updateStatus'])->middleware(['can:property-type.edit'])->name('property.types.status');
        Route::post('/delete', [PropertyTypeController::class, 'destroy'])->middleware(['can:property-type.delete'])->name('property.types.delete');
    });
      // allotments 
      Route::prefix('allotments')->group(function () {
        Route::get('/', [AllotmentController ::class, 'index'])->middleware(['can:allotments.view'])->name('allotments.index');
        Route::get('/getdata', [AllotmentController ::class, 'getdata'])->middleware(['can:allotments.view'])->name('allotments.getdata');
        Route::get('/create', [AllotmentController ::class, 'create'])->middleware(['can:allotments.create'])->name('allotments.create');
        Route::post('/store', [AllotmentController ::class, 'store'])->middleware(['can:allotments.create'])->name('allotments.store');
        Route::get('/edit/{id}', [AllotmentController ::class, 'edit'])->middleware(['can:allotments.edit'])->name('allotments.edit');
        Route::post('/update', [AllotmentController ::class, 'update'])->middleware(['can:allotments.edit'])->name('allotments.update');
        Route::put('/update/status', [AllotmentController ::class, 'updateStatus'])->middleware(['can:allotments.edit'])->name('allotments.change.status');
        Route::post('/delete', [AllotmentController ::class, 'destroy'])->middleware(['can:allotments.delete'])->name('allotments.delete');
    });
    // destinations
    Route::prefix('destinations')->group(function () {
        Route::get('/', [DestinationController::class, 'index'])->middleware(['can:destination.view'])->name('destinations.index');
        Route::get('/getdata', [DestinationController::class, 'getdata'])->middleware(['can:destination.view'])->name('destinations.getdata');
        Route::get('/create', [DestinationController::class, 'create'])->middleware(['can:destination.create'])->name('destinations.create');
        Route::post('/store', [DestinationController::class, 'store'])->middleware(['can:destination.create'])->name('destinations.store');
        Route::get('/edit/{id}', [DestinationController::class, 'edit'])->middleware(['can:destination.edit'])->name('destinations.edit');
        Route::post('/update', [DestinationController::class, 'update'])->middleware(['can:destination.edit'])->name('destinations.update');
        Route::put('/update-status', [DestinationController::class, 'updateStatus'])->middleware(['can:destination.edit'])->name('destinations.status');
        Route::post('/delete', [DestinationController::class, 'destroy'])->middleware(['can:destination.delete'])->name('destinations.delete');
    });
    // destination features
    Route::prefix('destination-features')->group(function () {
        Route::get('/', [DestinationFeatureController::class, 'index'])->middleware(['can:destination-feature.view'])->name('destination.features.index');
        Route::get('/getdata', [DestinationFeatureController::class, 'getdata'])->middleware(['can:destination-feature.view'])->name('destination.features.getdata');
        Route::get('/create', [DestinationFeatureController::class, 'create'])->middleware(['can:destination-feature.create'])->name('destination.features.create');
        Route::post('/store', [DestinationFeatureController::class, 'store'])->middleware(['can:destination-feature.create'])->name('destination.features.store');
        Route::get('/edit/{id}', [DestinationFeatureController::class, 'edit'])->middleware(['can:destination-feature.edit'])->name('destination.features.edit');
        Route::post('/update', [DestinationFeatureController::class, 'update'])->middleware(['can:destination-feature.edit'])->name('destination.features.update');
        Route::put('/update-status', [DestinationFeatureController::class, 'updateStatus'])->middleware(['can:destination-feature.edit'])->name('destination.features.status');
        Route::post('/delete', [DestinationFeatureController::class, 'destroy'])->middleware(['can:destination-feature.delete'])->name('destination.features.delete');
    });
    Route::prefix('default-policy')->group(function () {
        Route::get('/', [PropertyController::class, 'defaultPolicy'])->middleware(['can:hotel-policy.view','can:hotel-policy.create' ])->name('property.policy.index');
        // Route::get('/getdata', [DestinationFeatureController::class, 'getdata'])->middleware(['can:property-type.view'])->name('destination.features.getdata');
        // Route::get('/create', [DestinationFeatureController::class, 'create'])->middleware(['can:property-type.create'])->name('destination.features.create');
        // Route::post('/store', [DestinationFeatureController::class, 'store'])->middleware(['can:property-type.create'])->name('destination.features.store');
        // Route::get('/edit/{id}', [DestinationFeatureController::class, 'edit'])->middleware(['can:property-type.edit'])->name('destination.features.edit');
        Route::post('/update', [PropertyController::class, 'defaultPolicyUpdate'])->middleware(['can:property-type.edit'])->name('property.policy.update');
        // Route::put('/update-status', [DestinationFeatureController::class, 'updateStatus'])->middleware(['can:property-type.edit'])->name('destination.features.status');
        // Route::post('/delete', [DestinationFeatureController::class, 'destroy'])->middleware(['can:property-type.delete'])->name('destination.features.delete');
    });
    // amenities
    Route::prefix('amenities')->group(function () {
        Route::get('/', [AmenitiesController::class, 'index'])->middleware(['can:amenitiy.view'])->name('amenities.index');
        Route::get('/getdata', [AmenitiesController::class, 'getdata'])->middleware(['can:amenitiy.view'])->name('amenities.getdata');
        Route::get('/create', [AmenitiesController::class, 'create'])->middleware(['can:amenitiy.create'])->name('amenities.create');
        Route::post('/store', [AmenitiesController::class, 'store'])->middleware(['can:amenitiy.create'])->name('amenities.store');
        Route::get('/edit/{id}', [AmenitiesController::class, 'edit'])->middleware(['can:amenitiy.edit'])->name('amenities.edit');
        Route::post('/update', [AmenitiesController::class, 'update'])->middleware(['can:amenitiy.edit'])->name('amenities.update');
        Route::put('/update-status', [AmenitiesController::class, 'updateStatus'])->middleware(['can:amenitiy.edit'])->name('amenities.status');
        Route::post('/delete', [AmenitiesController::class, 'destroy'])->middleware(['can:amenitiy.delete'])->name('amenities.delete');
    });
    // facilities
    Route::prefix('facilities')->group(function () {
        Route::get('/', [FacilitiesController::class, 'index'])->middleware(['can:facility.view'])->name('facilities.index');
        Route::get('/getdata', [FacilitiesController::class, 'getdata'])->middleware(['can:facility.view'])->name('facilities.getdata');
        Route::get('/create', [FacilitiesController::class, 'create'])->middleware(['can:facility.create'])->name('facilities.create');
        Route::post('/store', [FacilitiesController::class, 'store'])->middleware(['can:facility.create'])->name('facilities.store');
        Route::get('/edit/{id}', [FacilitiesController::class, 'edit'])->middleware(['can:facility.edit'])->name('facilities.edit');
        Route::post('/update', [FacilitiesController::class, 'update'])->middleware(['can:facility.edit'])->name('facilities.update');
        Route::put('/update-status', [FacilitiesController::class, 'updateStatus'])->middleware(['can:facility.edit'])->name('facilities.status');
        Route::post('/delete', [FacilitiesController::class, 'destroy'])->middleware(['can:facility.delete'])->name('facilities.delete');
        Route::post('/reorder', [FacilitiesController::class, 'reorder'])->middleware(['can:facility.edit'])->name('facilities.reorder');
    });
    // properties
    Route::prefix('properties')->group(function () {
        Route::get('/', [PropertyController::class, 'index'])->middleware(['can:property.view'])->name('properties.index');
        Route::get('/getdata', [PropertyController::class, 'getdata'])->middleware(['can:property.view'])->name('properties.getdata');
        Route::get('/create', [PropertyController::class, 'create'])->middleware(['can:property.create'])->name('properties.create');
        Route::post('/store', [PropertyController::class, 'store'])->middleware(['can:property.create'])->name('properties.store');
        Route::get('/edit/{id}', [PropertyController::class, 'edit'])->middleware(['can:property.edit'])->name('properties.edit');
        Route::post('/update', [PropertyController::class, 'update'])->middleware(['can:property.edit'])->name('properties.update');
        Route::put('/update/status', [PropertyController::class, 'updateStatus'])->middleware(['can:property.edit'])->name('properties.status');
        Route::post('/delete', [PropertyController::class, 'destroy'])->middleware(['can:property.delete'])->name('properties.delete');
        Route::post('/upload-gallery', [PropertyController::class, 'uploadGalleryImages'])->middleware(['can:property.edit'])->name('properties.upload.gallery');
        Route::post('/upload-gallery/{id}', [PropertyController::class, 'deleteGalleryImage'])->middleware(['can:property.edit'])->name('properties.delete.gallery');
        Route::post('/set-backend-proprety', [PropertyController::class, 'setBackendProperty'])->name('properties.set.backend');
    });
    // Blogs
    Route::prefix('blogs')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->middleware(['can:blog.view'])->name('blogs.index');
        Route::get('/getdata', [BlogController::class, 'getdata'])->middleware(['can:blog.view'])->name('blogs.getdata');
        Route::get('/create', [BlogController::class, 'create'])->middleware(['can:blog.create'])->name('blogs.create');
        Route::post('/store', [BlogController::class, 'store'])->middleware(['can:blog.create'])->name('blogs.store');
        Route::get('/edit/{id}', [BlogController::class, 'edit'])->middleware(['can:blog.edit'])->name('blogs.edit');
        Route::post('/update', [BlogController::class, 'update'])->middleware(['can:blog.edit'])->name('blogs.update');
        Route::put('/update/status', [BlogController::class, 'updateStatus'])->middleware(['can:blog.edit'])->name('blogs.status');
        Route::post('/delete', [BlogController::class, 'destroy'])->middleware(['can:blog.delete'])->name('blogs.delete');
        
    });
    // BookingForcast
Route::prefix('bookingforcast')->group(function () {
    Route::get('/', [BookingForcastController::class, 'index'])
        ->middleware(['can:bookingforcast.view'])
        ->name('bookingforcast.index');

    Route::get('/getdata', [BookingForcastController::class, 'getdata'])
        ->middleware(['can:bookingforcast.view'])
        ->name('bookingforcast.getdata');

    Route::get('/selecteDate', [BookingForcastController::class, 'selecteDate'])
        ->middleware(['can:bookingforcast.view'])
        ->name('bookingforcast.selecteDate');
});
    // rooms
    Route::prefix('rooms')->group(function () {
        Route::get('/', [RoomController::class, 'index'])->middleware(['can:room.view'])->name('room.index');
        Route::get('/getdata', [RoomController::class, 'getdata'])->middleware(['can:room.view'])->name('room.getdata');
        Route::get('/create', [RoomController::class, 'create'])->middleware(['can:room.create'])->name('room.create');
        Route::post('/store', [RoomController::class, 'store'])->middleware(['can:room.create'])->name('room.store');
        Route::get('/edit/{id}', [RoomController::class, 'edit'])->middleware(['can:room.edit'])->name('room.edit');
        Route::post('/update', [RoomController::class, 'update'])->middleware(['can:room.edit'])->name('room.update');
        Route::put('/update/status', [RoomController::class, 'updateStatus'])->middleware(['can:room.edit'])->name('room.change.status');
        Route::post('/delete', [RoomController::class, 'destroy'])->middleware(['can:room.delete'])->name('room.delete');
        Route::post('/image-delete/{id}', [RoomController::class, 'deleteGalleryImage'])->middleware(['can:room.edit'])->name('room.delete.gallery');
    });
    // rates
    Route::prefix('rooms/rates')->group(function () {
        Route::get('/', [RateController::class, 'index'])->middleware(['can:room-type.view'])->name('rates.index');
        Route::get('/getdata', [RateController::class, 'getdata'])->middleware(['can:room-type.view'])->name('rates.getdata');
        Route::get('/create', [RateController::class, 'create'])->middleware(['can:room-type.create'])->name('rates.create');
        Route::post('/store', [RateController::class, 'store'])->middleware(['can:room-type.create'])->name('rates.store');
        Route::get('/edit/{id}', [RateController::class, 'edit'])->middleware(['can:room-type.edit'])->name('rates.edit');
        Route::post('/update', [RateController::class, 'update'])->middleware(['can:room-type.edit'])->name('rates.update');
        Route::put('/update/status', [RateController::class, 'updateStatus'])->middleware(['can:room-type.edit'])->name('rates.status');
        Route::post('/delete', [RateController::class, 'destroy'])->middleware(['can:room-type.delete'])->name('rates.delete');
      
    });
    // offers
    Route::prefix('offers')->group(function () {
        Route::get('/', [OfferController::class, 'index'])->middleware(['can:offers.view'])->name('offer.index');
        Route::get('/getdata', [OfferController::class, 'getdata'])->middleware(['can:offers.view'])->name('offer.getdata');
        Route::get('/create', [OfferController::class, 'create'])->middleware(['can:offers.create'])->name('offer.create');
        Route::post('/store', [OfferController::class, 'store'])->middleware(['can:offers.create'])->name('offer.store');
        Route::get('/edit/{id}', [OfferController::class, 'edit'])->middleware(['can:offers.edit'])->name('offer.edit');
        Route::post('/update', [OfferController::class, 'update'])->middleware(['can:offers.edit'])->name('offer.update');
        Route::put('/update/status', [OfferController::class, 'updateStatus'])->middleware(['can:offers.edit'])->name('offer.change.status');
        Route::post('/delete', [OfferController::class, 'destroy'])->middleware(['can:offers.delete'])->name('offer.delete');
    });
    // contact
    Route::prefix('contact')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->middleware(['can:contact.view'])->name('contact.index');
        Route::get('/getdata', [ContactController::class, 'getdata'])->middleware(['can:contact.view'])->name('contact.getdata');
        Route::get('/create', [ContactController::class, 'create'])->middleware(['can:contact.create'])->name('contact.create');
        Route::post('/store', [ContactController::class, 'store'])->middleware(['can:contact.create'])->name('contact.store');
        Route::get('/edit/{id}', [ContactController::class, 'edit'])->middleware(['can:contact.edit'])->name('contact.edit');
        Route::post('/update', [ContactController::class, 'update'])->middleware(['can:contact.edit'])->name('contact.update');
        Route::post('/delete', [ContactController::class, 'destroy'])->middleware(['can:contact.delete'])->name('contact.delete');
    });
    // booking
    Route::prefix('booking')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->middleware(['can:booking.view'])->name('booking.index');
        Route::get('/getdata', [BookingController::class, 'getdata'])->middleware(['can:booking.view'])->name('booking.getdata');
        Route::get('/create', [BookingController::class, 'create'])->middleware(['can:booking.create'])->name('booking.create');
        Route::post('/store', [BookingController::class, 'store'])->middleware(['can:booking.create'])->name('booking.store');
        Route::get('/edit/{id}', [BookingController::class, 'edit'])->middleware(['can:booking.edit'])->name('booking.edit');
        Route::post('/update', [BookingController::class, 'update'])->middleware(['can:booking.edit'])->name('booking.update');
        Route::post('/delete', [BookingController::class, 'destroy'])->middleware(['can:booking.delete'])->name('booking.delete');
    });
    // payment options
    Route::prefix('payment-options')->group(function () {
        Route::get('/', [PaymentOptionController::class, 'index'])->middleware(['can:system-setting.view'])->name('payment-options.index');
        Route::get('/getdata', [PaymentOptionController::class, 'getdata'])->middleware(['can:system-setting.view'])->name('payment-options.getdata');
        Route::get('/create', [PaymentOptionController::class, 'create'])->middleware(['can:system-setting.create'])->name('payment-options.create');
        Route::post('/store', [PaymentOptionController::class, 'store'])->middleware(['can:system-setting.create'])->name('payment-options.store');
        Route::get('/edit/{id}', [PaymentOptionController::class, 'edit'])->middleware(['can:system-setting.edit'])->name('payment-options.edit');
        Route::post('/update', [PaymentOptionController::class, 'update'])->middleware(['can:system-setting.edit'])->name('payment-options.update');
        Route::put('/update/status', [PaymentOptionController::class, 'updateStatus'])->middleware(['can:system-setting.edit'])->name('payment-options.change.status');
        Route::post('/delete', [PaymentOptionController::class, 'destroy'])->middleware(['can:system-setting.delete'])->name('payment-options.delete');
    });
    // taxes
    Route::prefix('taxes')->group(function () {
        Route::get('/', [TaxController::class, 'index'])->middleware(['can:tax.view'])->name('tax.index');
        Route::get('/getdata', [TaxController::class, 'getdata'])->middleware(['can:tax.view'])->name('tax.getdata');
        Route::get('/create', [TaxController::class, 'create'])->middleware(['can:tax.create'])->name('tax.create');
        Route::post('/store', [TaxController::class, 'store'])->middleware(['can:tax.create'])->name('tax.store');
        Route::get('/edit/{id}', [TaxController::class, 'edit'])->middleware(['can:tax.edit'])->name('tax.edit');
        Route::post('/update', [TaxController::class, 'update'])->middleware(['can:tax.edit'])->name('tax.update');
        Route::put('/update/status', [TaxController::class, 'updateStatus'])->middleware(['can:tax.edit'])->name('tax.change.status');
        Route::post('/delete', [TaxController::class, 'destroy'])->middleware(['can:tax.delete'])->name('tax.delete');
    });
    // currency 
    Route::prefix('currency')->group(function () {
        Route::get('/', [CurrencyController::class, 'index'])->middleware(['can:currencies.view'])->name('currencies.index');
        Route::get('/getdata', [CurrencyController::class, 'getdata'])->middleware(['can:currencies.view'])->name('currencies.getdata');
        Route::get('/create', [CurrencyController::class, 'create'])->middleware(['can:currencies.create'])->name('currencies.create');
        Route::post('/store', [CurrencyController::class, 'store'])->middleware(['can:currencies.create'])->name('currencies.store');
        Route::get('/edit/{id}', [CurrencyController::class, 'edit'])->middleware(['can:currencies.edit'])->name('currencies.edit');
        Route::post('/update', [CurrencyController::class, 'update'])->middleware(['can:currencies.edit'])->name('currencies.update');
        Route::put('/update/status', [CurrencyController::class, 'updateStatus'])->middleware(['can:currencies.edit'])->name('currencies.change.status');
        Route::post('/delete', [CurrencyController::class, 'destroy'])->middleware(['can:currencies.delete'])->name('currencies.delete');
    });
    // profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [BackendAuthController::class, 'showProfile'])->name('profile');
        Route::put('/update-user-photo', [BackendAuthController::class, 'uploadProfilePhoto'])->middleware(['can:profile.updatePhoto'])->name('profile.update-photo');
        Route::put('/update-user-info', [BackendAuthController::class, 'updateUserInfo'])->middleware(['can:profile.updateInfo'])->name('profile.update-info');
        Route::put('/change-password', [BackendAuthController::class, 'changePassword'])->middleware(['profile.updatePassword'])->name('profile.update-password');
        Route::post('/disable', [BackendAuthController::class, 'disableProfile'])->middleware(['can:profile.deactivate'])->name('profile.disable');
        Route::post('/delete', [BackendAuthController::class, 'deleteProfile'])->middleware(['can:profile.delete'])->name('profile.delete');
    });
    // settings
    Route::prefix('settings')->group(function () {
        Route::get('/general', [SettingsController::class, 'generalSettings'])->middleware(['can:settings.view'])->name('settings.general');
        Route::post('/general', [SettingsController::class, 'generalSettingsUpdate'])->middleware(['can:settings.edit'])->name('settings.general.update');
        Route::get('/mail', [SettingsController::class, 'mailSettings'])->middleware(['can:settings.view'])->name('settings.mail');
        Route::post('/mail', [SettingsController::class, 'mailSettingsUpdate'])->middleware(['can:settings.edit'])->name('settings.mail.update');
        Route::get('/social-auth', [SettingsController::class, 'socialAuthSettings'])->middleware(['can:settings.view'])->name('settings.social-auth');
        Route::post('/social-auth', [SettingsController::class, 'socialAuthSettingsUpdate'])->middleware(['can:settings.edit'])->name('settings.social-auth.update');
        Route::get('/content-pages', [ContantPageController::class, 'index'])->middleware(['can:settings.view'])->name('settings.content-pages');
        Route::get('/content-pages/get-data', [ContantPageController::class, 'getData'])->middleware(['can:settings.view'])->name('settings.content-pages.get-data');
        Route::get('/content-pages/{id}', [SettingsController::class, 'socialAuthSettings'])->middleware(['can:settings.view'])->name('settings.content-pages.edit');
        Route::post('/content-pages', [SettingsController::class, 'socialAuthSettingsUpdate'])->middleware(['can:settings.edit'])->name('settings.content-pages.update');
    });
    // media library
    Route::prefix('media-library')->group(function () {
        Route::get('/', [MediaLibraryController::class, 'index'])->middleware(['can:media.view'])->name('media.index');
        Route::post('/upload', [MediaLibraryController::class, 'upload'])->middleware(['can:media.create'])->name('media.upload');
        Route::get('/download/{id}', [MediaLibraryController::class, 'download'])->middleware(['can:media.edit'])->name('media.download');
        Route::post('/delete', [MediaLibraryController::class, 'delete'])->middleware(['can:media.delete'])->name('media.delete');
    });
    // rolses & permissions
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->middleware(['can:roles-permissions.view'])->name('settings.roles');
        Route::get('/getdata', [RoleController::class, 'getdata'])->middleware(['can:roles-permissions.view'])->name('settings.roles.getdata');
        Route::get('/create', [RoleController::class, 'create'])->middleware(['can:roles-permissions.create'])->name('settings.roles.create');
        Route::post('/store', [RoleController::class, 'store'])->middleware(['can:roles-permissions.create'])->name('settings.roles.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->middleware(['can:roles-permissions.edit'])->name('settings.roles.edit');
        Route::post('/update', [RoleController::class, 'update'])->middleware(['can:roles-permissions.edit'])->name('settings.roles.update');
        Route::get('/permissions/{id}', [RoleController::class, 'editPermissions'])->middleware(['can:roles-permissions.edit'])->name('settings.roles.permissions');
        Route::post('/permissions/update', [RoleController::class, 'updatePermissions'])->middleware(['can:roles-permissions.edit'])->name('settings.roles.permissions.update');
        Route::post('/delete', [RoleController::class, 'destroy'])->middleware(['can:roles-permissions.delete'])->name('settings.roles.delete');
    });
    // backend users
    Route::prefix('backend-users')->group(function () {
        Route::get('/', [BackendUserController::class, 'index'])->middleware(['can:backend-user.view'])->name('settings.users');
        Route::get('/get/data', [BackendUserController::class, 'getData'])->middleware(['can:backend-user.view'])->name('settings.users.getdata');
        Route::get('/create', [BackendUserController::class, 'create'])->middleware(['can:backend-user.create'])->name('settings.users.create');
        Route::post('/store', [BackendUserController::class, 'store'])->middleware(['can:backend-user.create'])->name('settings.users.store');
        Route::get('/edit/{id}', [BackendUserController::class, 'edit'])->middleware(['can:backend-user.edit'])->name('settings.users.edit');
        Route::post('/update', [BackendUserController::class, 'update'])->middleware(['can:backend-user.edit'])->name('settings.users.update');
        Route::put('/update/status', [BackendUserController::class, 'updateStatus'])->middleware(['can:backend-user.edit'])->name('settings.users.change.status');
        Route::put('/update/password', [BackendUserController::class, 'updatePassword'])->middleware(['can:backend-user.edit'])->name('settings.users.change.password');
        Route::post('/suspend', [BackendUserController::class, 'softDelete'])->middleware(['can:backend-user.delete'])->name('settings.users.delete');
        Route::post('/restore', [BackendUserController::class, 'restore'])->middleware(['can:backend-user.delete'])->name('settings.users.restore');
        Route::post('/delete', [BackendUserController::class, 'delete'])->middleware(['can:backend-user.delete'])->name('settings.users.remove');
    });
    // frontend users
    Route::prefix('front-users')->group(function () {
        Route::get('/', [FrontendUserController::class, 'index'])->middleware(['can:frontend-user.view'])->name('settings.front-user');
        Route::get('/get/data', [FrontendUserController::class, 'getData'])->middleware(['can:frontend-user.view'])->name('settings.front-user.getdata');
        Route::get('/create', [FrontendUserController::class, 'create'])->middleware(['can:frontend-user.create'])->name('settings.front-user.create');
        Route::post('/store', [FrontendUserController::class, 'store'])->middleware(['can:frontend-user.create'])->name('settings.front-user.store');
        Route::get('/edit/{id}', [FrontendUserController::class, 'edit'])->middleware(['can:frontend-user.edit'])->name('settings.front-user.edit');
        Route::post('/update', [FrontendUserController::class, 'update'])->middleware(['can:frontend-user.edit'])->name('settings.front-user.update');
        Route::put('/update/status', [FrontendUserController::class, 'updateStatus'])->middleware(['can:frontend-user.edit'])->name('settings.front-user.change.status');
        Route::put('/update/password', [FrontendUserController::class, 'updatePassword'])->middleware(['can:frontend-user.edit'])->name('settings.front-user.change.password');
        Route::post('/delete', [FrontendUserController::class, 'destroy'])->middleware(['can:frontend-user.delete'])->name('settings.front-user.delete');
    });
       

        
});
