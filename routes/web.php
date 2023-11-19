<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetReturnController;
use App\Http\Controllers\CategoryAssetController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Models\Employee;
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
    return view('auth.login');
});

Route::get('/dashboard2', function () {
    return view('dashboard2');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/update-password', [ProfileController::class, 'update_password'])->name('update.password');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('index.user');
    Route::get('/users', [UserController::class, 'index'])->name('index.user');
    Route::get('/users/{id}/show', [UserController::class, 'show'])->name('show.user');
    Route::get('/users/create', [UserController::class, 'create'])->name('create.user');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('edit.user');
    Route::post('/users', [UserController::class, 'store'])->name('store.user');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('update.user');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('destroy.user');

    // Department
    Route::get('/department', [DepartmentController::class, 'index'])->name('index.department');
    Route::post('/department', [DepartmentController::class, 'store'])->name('store.department');
    Route::put('/department/{id}', [DepartmentController::class, 'update'])->name('update.department');
    Route::delete('/department/{id}', [DepartmentController::class, 'destroy'])->name('destroy.department');

    // Job
    Route::get('/job', [JobController::class, 'index'])->name('index.job');
    Route::post('/job', [JobController::class, 'store'])->name('store.job');
    Route::put('/job/{id}', [JobController::class, 'update'])->name('update.job');
    Route::delete('/job/{id}', [JobController::class, 'destroy'])->name('destroy.job');

    // Employee
    Route::get('/employee', [EmployeeController::class, 'index'])->name('index.employee');
    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('create.employee');
    Route::get('/employee/{id}/show', [EmployeeController::class, 'show'])->name('show.employee');
    Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit'])->name('edit.employee');
    Route::post('/employee', [EmployeeController::class, 'store'])->name('store.employee');
    Route::put('/employee/{id}', [EmployeeController::class, 'update'])->name('update.employee');
    Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('destroy.employee');

    // Vendors
    Route::get('/vendor', [VendorController::class, 'index'])->name('index.vendor');
    Route::get('/vendor/create', [VendorController::class, 'create'])->name('create.vendor');
    Route::get('/vendor/{id}/edit', [VendorController::class, 'edit'])->name('edit.vendor');
    Route::post('/vendor', [VendorController::class, 'store'])->name('store.vendor');
    Route::put('/vendor/{id}', [VendorController::class, 'update'])->name('update.vendor');
    Route::delete('/vendor/{id}', [VendorController::class, 'destroy'])->name('destroy.vendor');

    // Location
    Route::get('/location', [LocationController::class, 'index'])->name('index.location');
    Route::post('/location', [LocationController::class, 'store'])->name('store.location');
    Route::put('/location/{id}', [LocationController::class, 'update'])->name('update.location');
    Route::delete('/location/{id}', [LocationController::class, 'destroy'])->name('destroy.location');

    // Category Asset
    Route::get('/category', [CategoryAssetController::class, 'index'])->name('index.category');
    Route::post('/category', [CategoryAssetController::class, 'store'])->name('store.category');
    Route::put('/category/{id}', [CategoryAssetController::class, 'update'])->name('update.category');
    Route::delete('/category/{id}', [CategoryAssetController::class, 'destroy'])->name('destroy.category');

    // Asset
    Route::get('/asets', [AssetController::class, 'index'])->name('index.asset');
    Route::get('/asets/{id}/show', [AssetController::class, 'show'])->name('show.asset');
    Route::get('/asets/create', [AssetController::class, 'create'])->name('create.asset');
    Route::get('/asets/{id}/edit', [AssetController::class, 'edit'])->name('edit.asset');
    Route::post('/asets', [AssetController::class, 'store'])->name('store.asset');
    Route::put('/asets/{id}', [AssetController::class, 'update'])->name('update.asset');
    Route::delete('/asets/{id}', [AssetController::class, 'destroy'])->name('destroy.asset');

    // Loan
    Route::get('/loan', [LoanController::class, 'index'])->name('index.loan');
    Route::get('/loan/{id}/show', [LoanController::class, 'show'])->name('show.loan');
    Route::get('/loan/create', [LoanController::class, 'create'])->name('create.loan');
    Route::get('/loan/{id}/edit', [LoanController::class, 'edit'])->name('edit.loan');
    Route::post('/loan', [LoanController::class, 'store'])->name('store.loan');
    Route::put('/loan/{id}', [LoanController::class, 'update'])->name('update.loan');
    Route::delete('/loan/{id}', [LoanController::class, 'destroy'])->name('destroy.loan');

    // Asset Return
    Route::get('/return', [AssetReturnController::class, 'index'])->name('index.return');
    Route::get('/return/{id}/show', [AssetReturnController::class, 'show'])->name('show.return');
    Route::get('/return/create', [AssetReturnController::class, 'create'])->name('create.return');
    Route::get('/return/{id}/edit', [AssetReturnController::class, 'edit'])->name('edit.return');
    Route::post('/return', [AssetReturnController::class, 'store'])->name('store.return');
    Route::put('/return/{id}', [AssetReturnController::class, 'update'])->name('update.return');
    Route::delete('/return/{id}', [AssetReturnController::class, 'destroy'])->name('destroy.return');
});


require __DIR__ . '/auth.php';
