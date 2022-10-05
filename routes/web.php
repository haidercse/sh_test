<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return redirect()->route('user.index');
});

 Route::group(['prefix'=>'admin','middleware'=>'auth'], function(){
     Route::get('/dashboard',[AdminController::class,'index']);
     Route::get('/registration_list',[UserController::class,'showRegistrationList'])->name('registration.list');
     Route::get('/registration_list/ajax',[UserController::class,'showRegistrationListAjax'])->name('registration.list.ajax');
     Route::get('/registration_edit/{id}',[UserController::class,'showRegistrationListEdit'])->name('registration.edit');
     Route::post('/registration_update/{id}',[UserController::class,'showRegistrationListUpdate'])->name('registration.update');
    
 });
 
 //user part
 Route::get('/user',[UserController::class,'index'])->name('user.index');
 Route::post('/user',[UserController::class,'store'])->name('user.store');
 Route::get('/get_all_district',[UserController::class,'getAllDistrict'])->name('get_all_district');
 Route::get('/get_all_thana',[UserController::class,'getAllThana'])->name('get_all_thana');
 Route::get('/get_all_exam',[UserController::class,'getAllExam'])->name('get_all_exam');
 Route::get('/get_all_board',[UserController::class,'getAllBoard'])->name('get_all_board');
 Route::get('/get_all_university',[UserController::class,'getAllUniversity'])->name('get_all_university');
 

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
