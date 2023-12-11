<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeAdminController;
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
Route::get('/', function () {
    return redirect('/login');
});
// USER //////////////
//Tampilan Home
Route::get('/homeUser', [App\Http\Controllers\HomeUserController::class, 'indexUser'])->middleware(['auth','user'])->name('homeUser');

//Dasboard
Route::get('/homeUser/dashboard', [App\Http\Controllers\HomeUserController::class, 'dashboardUser'])
    ->middleware(['auth','user'])
    ->name('dashboardUser');

//Car List
Route::get('/homeUser/car-list', [App\Http\Controllers\HomeUserController::class, 'carListUser'])
    ->middleware(['auth','user'])
    ->name('carListUser');
//Payments
Route::get('/homeUser/payments', [App\Http\Controllers\HomeUserController::class, 'paymentsUserView'])
    ->middleware(['auth','user'])
    ->name('paymentsUserView');
Route::post('/homeUser/payments', [App\Http\Controllers\HomeUserController::class, 'paymentsUser'])
    ->middleware(['auth','user'])
    ->name('paymentsUser');


//Driver List
// untuk umum
Route::get('/homeUser/driver-list', [App\Http\Controllers\HomeUserController::class, 'driverListUser'])
    ->middleware(['auth','user'])
    ->name('driverListUser');


//Edit Profile
Route::get('/homeUser/edit-profile', [App\Http\Controllers\HomeUserController::class, 'editProfileView'])
    ->middleware(['auth','user'])
    ->name('editProfileView');

Route::post('/homeUser/edit-profile', [App\Http\Controllers\HomeUserController::class, 'editProfile'])
    ->middleware(['auth','user'])
    ->name('editProfile');


//Delete Profile
// tidak jadi dipakai
// Route::post('/homeUser/delete-profile', [App\Http\Controllers\HomeUserController::class, 'deleteProfile'])
//     ->middleware(['auth', 'user'])
//     ->name('deleteProfile');

// MANAGEMENT USER    
//Tampilan Car Management
Route::get('/homeUser/car-management', [App\Http\Controllers\CarController::class, 'tampilDataCarsUser'])
    ->middleware(['auth', 'user'])
    ->name('carManageUser');

    





//Tampilan driver Management
Route::get('/homeUser/driver-management', [App\Http\Controllers\DriverController::class, 'tampilDataDriverUser'])
->middleware(['auth', 'user'])
->name('driver-manage');

//Create 
Route::get('/homeUser/driver-management/create-driver-management', [App\Http\Controllers\DriverController::class, 'createView'])
    ->middleware(['auth', 'user'])
    ->name('createView');
Route::post('/homeUser/driver-management/create-driver-management', [App\Http\Controllers\DriverController::class, 'create'])
->middleware(['auth', 'user'])
->name('createDriverManage');

//Edit
Route::get('/homeUser/driver-management/edit-driver-management/{id}', [App\Http\Controllers\DriverController::class, 'editView'])
    ->middleware(['auth', 'user'])
    ->name('editDriverView');

Route::post('/homeUser/driver-management/edit-driver-management/{id}', [App\Http\Controllers\DriverController::class, 'edit'])
    ->middleware(['auth', 'user'])
    ->name('editDriverManage');

//Delete
Route::get('/homeUser/driver-management/delete-driver-management/{id}', [App\Http\Controllers\DriverController::class, 'delete'])
    ->middleware(['auth', 'user'])
    ->name('deleteDriverManage');

//Tampilan payment Management
Route::get('/homeUser/payment-management', [App\Http\Controllers\PaymentController::class, 'tampilDataPaymentUser'])
->middleware(['auth', 'user'])
->name('paymentManageUser');
// CREATE
Route::get('/homeUser/payment-management/create-payment-management', [App\Http\Controllers\PaymentController::class, 'createView'])
    ->middleware(['auth', 'user'])
    ->name('createPaymentManage');
Route::post('/homeUser/payment-management/create-payment-management', [App\Http\Controllers\PaymentController::class, 'create'])
    ->middleware(['auth', 'user'])
    ->name('createPaymentManage');

Route::get('/homeUser/car-management/delete-car-management/{id}', [App\Http\Controllers\PaymentController::class, 'delete'])
->middleware(['auth', 'user'])
->name('deleteCarManageUser');

//PENYEWAAN
//untuk yg ingin menyewa dengan driver
Route::get('/homeUser/car-list-{idCar}/driver-list', [App\Http\Controllers\OrderController::class, 'sewaDriver'])
    ->middleware(['auth','user'])
    ->name('sewaDriver');

Route::get('/homeUser/car-list-{idCar}/driver-list-0/form-penyewaan', [App\Http\Controllers\OrderController::class, 'viewFormPenyewaanWithSim'])
->middleware(['auth','user'])
->name('viewFormPenyewaanWithSim');
Route::get('/homeUser/car-list-{idCar}/driver-list-{idDriver}/form-penyewaan', [App\Http\Controllers\OrderController::class, 'viewFormPenyewaanNoSim'])
->middleware(['auth','user'])
->name('viewFormPenyewaanNoSim');
Route::post('/homeUser/car-list-{idCar}/driver-list-{idDriver}/form-penyewaan', [App\Http\Controllers\OrderController::class, 'createOrder'])
->middleware(['auth','user'])
->name('formPenyewaan');
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////


// ADMIN /////////////

//Tampilan Home 
Route::get('/homeAdmin', [App\Http\Controllers\HomeAdminController::class, 'indexAdmin'])->middleware(['auth','admin'])->name('homeAdmin');
//Dasboard
Route::get('/homeAdmin/dashboard', [App\Http\Controllers\HomeAdminController::class, 'dashboardAdmin'])
    ->middleware(['auth','admin'])
    ->name('dashboardAdmin');

//Car List
Route::get('/homeAdmin/car-list', [App\Http\Controllers\HomeAdminController::class, 'carListAdmin'])
    ->middleware(['auth','admin'])
    ->name('carListAdmin');
//Driver List
Route::get('/homeAdmin/driver-list', [App\Http\Controllers\HomeAdminController::class, 'driverListAdmin'])
    ->middleware(['auth','admin'])
    ->name('driverListAdmin');
//Payments
Route::get('/homeAdmin/payments', [App\Http\Controllers\HomeAdminController::class, 'paymentsAdmin'])
    ->middleware(['auth','admin'])
    ->name('paymentsAdmin');

//User profile
Route::get('/homeAdmin/user-profile', [App\Http\Controllers\HomeAdminController::class, 'userProfileList'])
    ->middleware(['auth','admin'])
    ->name('userProfileList');

// MANAGEMENT ADMIN    
//Tampilan Car Management
Route::get('/homeAdmin/car-management', [App\Http\Controllers\CarController::class, 'tampilDataCarsAdmin'])
    ->middleware(['auth', 'admin'])
    ->name('carManageAdmin');

    
//Create 
Route::get('/homeAdmin/car-management/create-car-management', [App\Http\Controllers\CarController::class, 'createView'])
    ->middleware(['auth', 'admin'])
    ->name('createView');
Route::post('/homeAdmin/car-management/create-car-management', [App\Http\Controllers\CarController::class, 'create'])
    ->middleware(['auth', 'admin'])
    ->name('createCarManage');
//Edit
Route::get('/homeAdmin/car-management/edit-car-management/{id}', [App\Http\Controllers\CarController::class, 'editView'])
    ->middleware(['auth', 'admin'])
    ->name('editCarView');

Route::post('/homeAdmin/car-management/edit-car-management/{id}', [App\Http\Controllers\CarController::class, 'edit'])
    ->middleware(['auth', 'admin'])
    ->name('editCarManage');
    

Route::get('/homeAdmin/car-management/edit-status-car-management/{id}', [App\Http\Controllers\CarController::class, 'editStatusCarView'])
->middleware(['auth', 'admin'])
->name('editStatusCarView');


Route::post('/homeAdmin/car-management/edit-status-car-management/{id}', [App\Http\Controllers\CarController::class, 'editStatusCar'])
    ->middleware(['auth', 'admin'])
    ->name('editStatusCarManage');

//Delete
Route::get('/homeAdmin/car-management/delete-car-management/{id}', [App\Http\Controllers\CarController::class, 'delete'])
    ->middleware(['auth', 'admin'])
    ->name('deleteCarManageAdmin');

//Tampilan driver Management
Route::get('/homeAdmin/driver-management', [App\Http\Controllers\DriverController::class, 'tampilDataDriverAdmin'])
->middleware(['auth', 'admin'])
->name('driverManageAdmin');

//Create 
Route::get('/homeAdmin/driver-management/create-driver-management', [App\Http\Controllers\DriverController::class, 'createView'])
    ->middleware(['auth', 'admin'])
    ->name('createView');
Route::post('/homeAdmin/driver-management/create-driver-management', [App\Http\Controllers\DriverController::class, 'create'])
->middleware(['auth', 'admin'])
->name('createDriverManage');

//Edit
Route::get('/homeAdmin/driver-management/edit-driver-management/{id}', [App\Http\Controllers\DriverController::class, 'editView'])
    ->middleware(['auth', 'admin'])
    ->name('editDriverView');

Route::post('/homeAdmin/driver-management/edit-driver-management/{id}', [App\Http\Controllers\DriverController::class, 'edit'])
    ->middleware(['auth', 'admin'])
    ->name('editDriverManage');
 // edit status driver
Route::get('/homeAdmin/driver-management/edit-status-driver-management/{id}', [App\Http\Controllers\DriverController::class, 'editStatusDriverView'])
    ->middleware(['auth', 'admin'])
    ->name('editStatusDriverView');

Route::post('/homeAdmin/driver-management/edit-status-driver-management/{id}', [App\Http\Controllers\DriverController::class, 'editStatusDriver'])
    ->middleware(['auth', 'admin'])
    ->name('editStatusDriverManage');

//Delete
Route::get('/homeAdmin/driver-management/delete-driver-management/{id}', [App\Http\Controllers\DriverController::class, 'delete'])
    ->middleware(['auth', 'admin'])
    ->name('deleteDriverManage');

//Tampilan payment Management
Route::get('/homeAdmin/payment-management', [App\Http\Controllers\PaymentController::class, 'tampilDataPaymentAdmin'])
->middleware(['auth', 'admin'])
->name('paymentManageAdmin');

Route::get('/homeAdmin/payment-management/edit-status-payment-management/{id}', [App\Http\Controllers\PaymentController::class, 'editStatusPaymentView'])
    ->middleware(['auth', 'admin'])
    ->name('editStatusPaymentView');

Route::post('/homeAdmin/payment-management/edit-status-payment-management/{id}', [App\Http\Controllers\PaymentController::class, 'editStatusPayment'])
    ->middleware(['auth', 'admin'])
    ->name('editStatusPaymentManage');





