<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ToDoListController;
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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('dashboard',[ToDoListController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('create',[ToDoListController::class,'create'])->name('create');
Route::post('create',[ToDoListController::class,'store'])->name('store');
Route::get('edit/{id}', [ToDoListController::class, 'showEditPage'])->name('editpage');
Route::post('edit/{id}', [ToDoListController::class, 'edit'])->name('edit');
Route::any('delete/{id}', [ToDoListController::class, 'delete'])->name('delete');
Route::post('status/{id}',[ToDoListController::class,'statusChange'])->name('statusChange');

Route::get('completed', [ToDoListController::class, 'completedTasks'])->name('tasks.completed');
Route::get('pending', [ToDoListController::class, 'pendingTasks'])->name('tasks.pending');

Route::get('showpage/{id}', [ToDoListController::class, 'showpage'])->name('showpage');
Route::get('showData/{id}', [ToDoListController::class, 'showDataSigle'])->name('showDataSigle');
