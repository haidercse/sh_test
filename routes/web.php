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

 Route::group(['prefix'=>'admin'], function(){
     Route::get('/dashboard',[AdminController::class,'index']);
    
 });
 //user part
 Route::get('/user',[UserController::class,'index'])->name('user.index');
 Route::post('/user',[UserController::class,'store'])->name('user.store');
 Route::get('/get_all_district',[UserController::class,'getAllDistrict'])->name('get_all_district');
 Route::get('/get_all_thana',[UserController::class,'getAllThana'])->name('get_all_thana');