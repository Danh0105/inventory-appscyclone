<?php

use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LocationsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\AdminUserRoleCreate;
use App\Http\Controllers\ManufaturerModelsController;
use App\Http\Controllers\SupplierController;
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


Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('locations', LocationsController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('userrole', UserRoleController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('manufaturer&models', ManufaturerModelsController::class);
    Route::resource('asset', AssetController::class);
    Route::resource('user', UserController::class);
});
Route::get('/', function () {
    return view('Admin.Auth.index');
});
