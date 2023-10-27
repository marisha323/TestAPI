<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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
    return view('welcome');
})->name('home');
Route::group(['middleware'=>'guest'],function (){
    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::post('/register',[AuthController::class,'registerPost'])->name('register');
    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/login',[AuthController::class,'loginPost'])->name('login');

});

Route::group(['middleware'=>'auth'],function (){
    Route::get('/home',[HomeController::class,'index']);
    Route::delete('/logout',[AuthController::class,'logout'])->name('logout');
});

Route::middleware(['auth','user-access:admin'])->group(function ()
{
    Route::get('/admin/home',[HomeController::class,'adminHome'])->name('admin.home');
});

Route::middleware(['auth','user-access:manager'])->group(function ()
{
    Route::get('/manager/home',[HomeController::class,'managerHome'])->name('manager.home');
});
