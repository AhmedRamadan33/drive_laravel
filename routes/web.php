<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DriveController ;
use App\Http\Controllers\admin\AdminController ;
use App\Http\Controllers\HomeController ;


Route::get('login', function () {
    return view('auth.login');
});

// Admin routes
Route::post('adminLogin',[AdminController::class,'login'])->name('admin.login');
Route::get('adminLoginPage', [AdminController::class, 'loginPage'])->name('admin.loginPage');
Route::get('adminHomePage', [AdminController::class, 'index'])->name('admin.home')->middleware('auth:admins');

// Auth routes
Auth::routes();

// home routes
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('GoTo401', [HomeController::class, 'GoTo401'])->name('GoTo401');

// ===================== 

Route::middleware(['auth'])->group(function () {

    Route::prefix('drives')->group(function(){
        // go to list page and get data to display it
        Route::get('index',[DriveController::class ,'index'])->name('drives.index') ;
        // go to create page 
        Route::get('create',[DriveController::class ,'create'])->name('drives.create') ;
        // store in database
        Route::post('store',[DriveController::class ,'store'])->name('drives.store') ;
        // show and display More details about data 
        Route::get('show/{id}',[DriveController::class ,'show'])->name('drives.show') ;
        // show and display More details about public Files only 
        Route::get('showPublicFiles/{id}',[DriveController::class ,'showPublicFiles'])->name('drives.showPublicFiles') ;
        // go to edit page 
        Route::get('edit/{id}',[DriveController::class ,'edit'])->name('drives.edit') ;
        // update in database
        Route::post('update/{id}',[DriveController::class ,'update'])->name('drives.update') ;
        // delete function
        Route::get('destroy/{id}',[DriveController::class ,'destroy'])->name('drives.destroy') ;
        // download function
        Route::get('download/{id}',[DriveController::class ,'download'])->name('drives.download') ;
        // Display public files
        Route::get('publicFiles',[DriveController::class ,'publicFiles'])->name('drives.publicFiles') ;
        // switch between status files 
        Route::get('changStatus/{id}',[DriveController::class ,'changStatus'])->name('drives.changStatus') ;
        // Display all Filles for one User only (multi auzirization)
        Route::get('allDrives',[DriveController::class ,'allDrives'])->name('drives.allDrives')->middleware('RuleOne') ;
        
    });
});

