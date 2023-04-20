<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','user-role:user'])->group(function()
{
    Route::get("/home",[HomeController::class, 'userHome'])->name("home");
});

Route::middleware(['auth','user-role:admin'])->group(function()
{
    Route::get("/admin/home",[HomeController::class, 'adminHome'])->name("admin.home");
});
