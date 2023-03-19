<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;



Route::middleware('role:admin')->name('admin.')->group(function (){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
    Route::resource('/roles',RoleController::class);
    Route::resource('/permissions',PermissionController::class);
    Route::resource('/users',UserController::class);
});
