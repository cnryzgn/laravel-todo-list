<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');

Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');

Route::post('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');

Route::put('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');
