<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/auth_user', [UserController::class, 'auth_user'])->name('auth_user');
Route::get('/reg', [UserController::class, 'reg'])->name('reg');
Route::post('/add_user', [UserController::class, 'add_user'])->name('add_user');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


Route::post('/add_expense', [ExpenseController::class, 'add_expense'])->name('add_expense');
Route::get('/add_expenses', [ExpenseController::class, 'add_expenses'])->name('add_expenses');

Route::get('/all_expenses', [ExpenseController::class, 'all_expenses'])->name('all_expenses');
Route::get('/edit_expense/{id}', [ExpenseController::class, 'edit_expense'])->name('edit_expense');
Route::post('/update_expense/{id}', [ExpenseController::class, 'update_expense'])->name('update_expense');
Route::get('/delete_expense/{id}', [ExpenseController::class, 'delete_expense'])->name('delete_expense');
Route::get('/card_expense/{id}', [ExpenseController::class, 'card_expense'])->name('card_expense');
