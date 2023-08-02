<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ModelsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardContoller;
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
// route for index
Route::get('/', function () {
    return view('index');
});
Auth::routes();
// the below routes are for accessing admin pages 
// the middleware is used to authenticate whether the it is admin or not
// the Auth and isAdmin are used as parameters to check. if isAdmin is 1 the routes can be used
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    // routed to admin dashboard
    Route::resource('/dashboard', DashboardContoller::class);
    // routed to services it includes add,edit,delete
    Route::resource('/services', ServiceController::class);
    // routed to bookings it includes edit,delete and view
    Route::resource('/bookings', BookingController::class);
    // routed to brands it includes add,edit,delete
    Route::resource('/brands', BrandController::class);
    // route for admin panel to view users
    Route::get('/users', [UserController::class, 'index']);
     // route for admin panel to delete users
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    // route for admin side models for add,edit,delete
    Route::get('/models/{brand_id}', [ModelsController::class, 'index']);
    Route::get('/models/{brand_id}/create', [ModelsController::class, 'create']);
    Route::post('/models/{brand_id}', [ModelsController::class, 'store']);
    Route::get('/models/{brand_id}/{id}/edit', [ModelsController::class, 'edit']);
    Route::patch('/models/{brand_id}/{id}', [ModelsController::class, 'update']);
    Route::delete('/models/{id}/{brand_id}', [ModelsController::class, 'destroy']);
});

// the below routes are for accessing client pages 
Route::middleware(['auth'])->group(function () {
    // once after login,client redirects to home page
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // routed to view profile
    Route::get('/profile/{id}', [UserController::class, 'show']);
     // routed to edit profile page
    Route::get('/profile/{id}/edit', [UserController::class, 'edit']);
     // routed to updte profile
    Route::patch('/profile/{id}', [UserController::class, 'update']);
    // displaying services list for users
    Route::get('/services', [ServiceController::class, 'showService']);
    // route for user booking
    Route::get('/book_service', [BookingController::class, 'create']);
    // route for booking
    Route::post('/booking', [BookingController::class, 'store']);
    // ajax call to get get models details
    Route::get('getModels/{id}', [BookingController::class, 'getModels']);
    // routed to view boookings made by client
    Route::get('view_user_bookings/',[BookingController::class, 'viewUserBookings']);
        // routed to view particular boooking details
    Route::get('view_booking_details/{booking_id}',[BookingController::class, 'viewBookingDetail']);
});
