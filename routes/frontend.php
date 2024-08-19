<?php

// use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ChatController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\Frontend\FrontendAuthController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\PropertyController;
use App\Http\Livewire\AllBlogsPageComponent;
use App\Http\Livewire\AllDestinationsPageComponent;
use App\Http\Livewire\AllPartnersComponent;
use App\Http\Livewire\AllPropertiesPageComponent;
use App\Http\Livewire\BookingSuccessComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\ContactPageComponent;
use App\Http\Livewire\CustomerAuthComponent;
use App\Http\Livewire\DestinationDetailsComponent;
use App\Http\Livewire\Home\PropertyCategoryComponent;
use App\Http\Livewire\HomePageComponent;
use App\Http\Livewire\ProfileComponent;
use App\Http\Livewire\PropertyDetailsComponent;
use App\Http\Livewire\PropertyRegisterComponent;
use App\Http\Livewire\PrivacyPolicyComponent;
use App\Models\BedTypeProperty;
use App\Models\Property;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\GeoLocationController;
use App\Http\Livewire\Partners\PartnerDetailsComponent;
use App\Http\Livewire\TremsAndConditionComponent;
use App\Http\Livewire\BlogsDetailsPageComponent;
use App\Http\Livewire\CareersPageComponent;
use App\Http\Livewire\CareersFormPageComponent;
use App\Http\Livewire\AboutUsPageComponent;
use App\Http\Livewire\ForgotPassword;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Livewire\ForgetPassword;
use App\Http\Livewire\ForgetPasswordLink;
use App\Http\Livewire\TermsAndConditions;



/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register frontend routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "frontend" middleware group. Now create something great!
|
*/
// Route::redirect('/reservation/{property}', '/roomista/properties/{property}', 301);

Route::get('get-address-from-ip', [GeoLocationController::class, 'index']);

Route::get('/dashboard', function () {
    return redirect('/admin/dashboard');
});

Route::get('/generate-invoice', [InvoiceController::class, 'generateInvoice']);

Route::get('/', HomePageComponent::class)->name('home');
Route::get('/live-chat', [ChatController::class, 'sendWhatsappMsg'])->name('live-chat');
Route::prefix('roomista')->group(function() {
    Route::get('/properties', AllPropertiesPageComponent::class)->name('all-properties');
    Route::get('/properties/gallery/{id}', [PropertyController::class, 'getGalleryImages'])->name('property-gallery');
    Route::get('/properties/type/{slug}', AllPropertiesPageComponent::class)->name('property-types');
    Route::get('/tourist-destinations-in-sri-lanka', AllDestinationsPageComponent::class)->name('all-destinations');
    Route::get('/destinations/{slug}', DestinationDetailsComponent::class)->name('destination-details');
    Route::get('reservation/{slug}', PropertyDetailsComponent::class)->name('property-details');
    Route::get('partners', AllPartnersComponent::class)->name('all-partners');
    Route::get('checkout', CheckoutComponent::class)->name('checkout');
    Route::get('booking-response/{hash}', BookingSuccessComponent::class)->name('success');
    Route::get('/partners/{slug}',PartnerDetailsComponent::class)->name('partner-details');
});
Route::get('/blogs', AllBlogsPageComponent::class,'index')->name('blogs');
Route::get('/contact', ContactPageComponent::class,'index')->name('contact');
Route::get('/careers', CareersPageComponent::class,'index')->name('careers');
Route::get('/about-us', [PageController::class, 'handlePages'])->name('about');
Route::get('/privacy-policy', [PageController::class, 'handlePages'])->name('privacy');
Route::get('/terms-and-conditions', [PageController::class, 'handlePages'])->name('terms');
Route::get('/faq', [PageController::class, 'handlePages'])->name('faq');
Route::get('/how-it-works', [PageController::class, 'handlePages'])->name('work');

Route::get('/auth/customer', CustomerAuthComponent::class)->middleware(['guest:customers'])->name('front.login');
Route::get('/customer/profile', ProfileComponent::class)->name('profile');
Route::get('/property-register', PropertyRegisterComponent::class)->name('front.property.register');

Route::get('process-payment/{id}', [PageController::class, 'payhereRedirect'])->name('payment-process');

// Route::post('/login', [FrontendAuthController::class, 'makeLogin'])->name('front.make.login');
// Route::get('/register', [FrontendAuthController::class, 'register'])->name('front.register');
// Route::post('/register', [FrontendAuthController::class, 'makeRegister'])->name('front.make.register');

Route::get('/verify-mobile-number', [FrontendAuthController::class, 'otp'])->name('front.otp');
Route::post('/verify-mobile-number', [FrontendAuthController::class, 'makeOtp'])->name('front.make.otp');
Route::post('/resend-otp', [FrontendAuthController::class, 'makeOtp'])->name('front.resend.top');
Route::get('/forgot-password', [FrontendAuthController::class, 'forgotPassword'])->name('front.forgotpassword');
Route::get('/reset-password', [FrontendAuthController::class, 'resetPassword'])->name('front.resetpassword');
Route::post('/forgot-password', [FrontendAuthController::class, 'makeForgotPassword'])->name('front.make.forgotpassword');
Route::post('/forgot-password', [FrontendAuthController::class, 'makeResetPassword'])->name('front.make.forgotpassword');
Route::post('/logout', [FrontendAuthController::class, 'makeLogout'])->name('front.logout');

Route::get('oauth/{driver}', [FrontendAuthController::class, 'redirectToProvider'])->name('social.oauth');
Route::post('oauth/{driver}', [FrontendAuthController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('oauth/{driver}/callback', [FrontendAuthController::class, 'handleProviderCallback'])->name('social.callback');

Route::get('/blog-details', BlogsDetailsPageComponent::class,'index')->name('blog-details');
Route::get('/careers-form/{careerId}', CareersFormPageComponent::class)->name('careers-form');
Route::get('/about-us', AboutUsPageComponent::class,'index')->name('about-us');
Route::get('/privacy-policy', PrivacyPolicyComponent::class,'index')->name('privacy-policy');
Route::get('/terms-and-condition', TremsAndConditionComponent::class,'index')->name('terms-and-condition');

Route::get('forget-password', ForgetPassword::class,'index')->name('forget-password');
Route::post('forget-password', [ForgetPassword::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
// Route::get('reset-password/{token}', [ForgetPassword::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::get('forget-password-link/{token}', ForgetPasswordLink::class)->name('forget-password-link');
Route::post('forget-password-link', [ForgetPasswordLink::class, 'submitResetPasswordForm'])->name('forget-password-link.post');
