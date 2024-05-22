<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/', function () {
    return redirect()->route('login');
})->name('/');




// Guest Users
Route::middleware(['guest','PreventBackHistory'])->group(function()
{
    Route::get('login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'] )->name('login');
    Route::post('login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('signin');
    Route::get('register', [App\Http\Controllers\Admin\AuthController::class, 'showRegister'] )->name('register');
    Route::post('register', [App\Http\Controllers\Admin\AuthController::class, 'register'])->name('signup');

});




// Authenticated users
Route::middleware(['auth','PreventBackHistory'])->group(function()
{

    // Auth Routes
    Route::get('home', fn () => redirect()->route('dashboard'))->name('home');
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [App\Http\Controllers\Admin\AuthController::class, 'Logout'])->name('logout');
    Route::get('change-theme-mode', [App\Http\Controllers\Admin\DashboardController::class, 'changeThemeMode'])->name('change-theme-mode');
    Route::get('show-change-password', [App\Http\Controllers\Admin\AuthController::class, 'showChangePassword'] )->name('show-change-password');
    Route::post('change-password', [App\Http\Controllers\Admin\AuthController::class, 'changePassword'] )->name('change-password');



    // Masters
    Route::resource('wards', App\Http\Controllers\Admin\Masters\WardController::class );




    // Users Roles n Permissions
    Route::resource('users', App\Http\Controllers\Admin\UserController::class );
    Route::get('users/{user}/toggle', [App\Http\Controllers\Admin\UserController::class, 'toggle' ])->name('users.toggle');
    Route::get('users/{user}/retire', [App\Http\Controllers\Admin\UserController::class, 'retire' ])->name('users.retire');
    Route::put('users/{user}/change-password', [App\Http\Controllers\Admin\UserController::class, 'changePassword' ])->name('users.change-password');
    Route::get('users/{user}/get-role', [App\Http\Controllers\Admin\UserController::class, 'getRole' ])->name('users.get-role');
    Route::put('users/{user}/assign-role', [App\Http\Controllers\Admin\UserController::class, 'assignRole' ])->name('users.assign-role');
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class );

    // reports test
    Route::get('vendorWiseReport', [App\Http\Controllers\ReportController::class, 'vendorWiseReport' ])->name('vendorWiseReport');
    Route::get('summaryReport', [App\Http\Controllers\ReportController::class, 'summaryReport' ])->name('summaryReport');
    Route::get('wardWisesummaryReport', [App\Http\Controllers\ReportController::class, 'wardWisesummaryReport' ])->name('wardWisesummaryReport');
    Route::get('vehicleTypeWiseReport', [App\Http\Controllers\ReportController::class, 'vehicleTypeWiseReport' ])->name('vehicleTypeWiseReport');
    Route::get('locationWiseReport', [App\Http\Controllers\ReportController::class, 'locationWiseReport' ])->name('locationWiseReport');
    Route::get('vehicleroundsreport', [App\Http\Controllers\ReportController::class, 'vehicleroundsreport' ])->name('vehicleroundsreport');

    // bar chart
    Route::get('/monthly-collection', [App\Http\Controllers\Admin\DashboardController::class, 'getMonthlyCollectionData'])->name('montly.collection');
    Route::get('/daily-collection', [App\Http\Controllers\Admin\DashboardController::class, 'getDailyCollectionData'])->name('daily.collection');
    Route::get('/getImages/{id}', [App\Http\Controllers\ReportController::class, 'getImages'])->name('getImages');

    // generate PDF
    Route::get('/generate-pdf', [App\Http\Controllers\ExportController::class, 'generatePDF']);


});




Route::get('/php', function(Request $request){
    if( !auth()->check() )
        return 'Unauthorized request';

    Artisan::call($request->artisan);
    return dd(Artisan::output());
});
