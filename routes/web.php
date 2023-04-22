<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\UsersController;

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
Auth::routes();

Route::get("/",function() {
    return view('welcome');
});

Route::middleware(['auth','user-role:user'])->group(function()
{
    Route::get("/users",[HomeController::class, 'index'])->name("users");

    Route::get("/users/{id}",[HomeController::class, 'show'])->name("user");

    Route::get("/profile",[ProfileController::class, 'index'])->name("profile");
    Route::get("/profile/edit",[ProfileController::class, 'edit'])->name("profile.edit");
    Route::post("/profile/update",[ProfileController::class, 'update'])->name("profile.update");

});

Route::middleware(['auth','user-role:admin'])->group(function()
{
    Route::get("/admin/users",[UsersController::class, 'index'])->name("admin.users");

    Route::get("/admin/users/{id}",[UsersController::class, 'show'])->name("admin.user");

    Route::get("/admin/profile",[ProfileController::class, 'index'])->name("admin.profile");
    Route::get("/admin/profile/edit",[ProfileController::class, 'edit'])->name("admin.profile.edit");
    Route::post("/admin/profile/update",[ProfileController::class, 'update'])->name("admin.profile.update");

    Route::get("/admin/create",[UsersController::class, 'create'])->name("admin.create");
    Route::post("/admin/create",[UsersController::class, 'store'])->name("admin.store");

    Route::get("/admin/delete/{id}",[UsersController::class, 'delete'])->name("admin.delete");

    Route::get("/admin/edit/{id}",[UsersController::class, 'edit'])->name("admin.edit");
    Route::post("/admin/update/{id}",[UsersController::class, 'update'])->name("admin.update");

    Route::get("/admin/role/{id}",[UsersController::class, 'role'])->name("admin.role");
});
