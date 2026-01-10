<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\managercontroller;
use App\Http\Controllers\drivercontroller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

//Auth::routes();

Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// صفحة المدير
Route::get('/manger', function () {
    return view('manger.mdashboard');
})->middleware('auth')->name('manger.dashboard');

Route::get('/login',[LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login',[LoginController::class, 'login']);
Route::post('/logout',[LoginController::class, 'logout']);
Route::post('/logout', function () {
    return redirect('/')->with('success', 'Logged out successfully!');
})->name('logout');

Route::get('/test-edit/{id}', function ($id) {
    return "<h1>Editing Bus #{$id}</h1>";
});

Route::get('/driver/dashboard',function()
{
    return view('driver.dashboard');
}
)->middleware('auth')->name('driver.dashboard');  /* هون الاسم هي بحطوا اختياري لو بدي و بسمي يلي بدي ياه يعني لما اجي اكتب اسم صفحة بكتبها بهاد المفتاح*/ 

Route::get('/manger/mdashboard',function()
{
    return view('manger.mdashboard');
}
)->middleware('auth')->name('manger.mdashboard'); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
