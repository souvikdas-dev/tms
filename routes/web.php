<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTaskController;
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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tasks', TaskController::class);

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get("/users/{user}/tasks", [UserTaskController::class, 'index'])->name('user.tasks');
});

Route::get('test', [TaskController::class, 'demo'])->name('test');



require __DIR__ . '/auth.php';
