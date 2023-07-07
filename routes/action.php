<?php

Route::get('/action', [App\Http\Controllers\ActionController::class, 'index'])->name('action.index');
Route::get('/action/create', [App\Http\Controllers\ActionController::class, 'create'])->name('action.create');
Route::post('/action/store', [App\Http\Controllers\ActionController::class, 'store'])->name('action.store');
Route::get('/action/show/{id}', [App\Http\Controllers\ActionController::class, 'show'])->name('action.show');
Route::get('/action/edit/{id}', [App\Http\Controllers\ActionController::class, 'edit'])->name('action.edit');
Route::put('/action/update/{id}', [App\Http\Controllers\ActionController::class, 'update'])->name('action.update');
Route::delete('/action/destroy/{id}', [App\Http\Controllers\ActionController::class, 'destroy'])->name('action.destroy');
Route::post('/action/addanswers', [App\Http\Controllers\ActionController::class, 'addanswers'])->name('action.addanswers');
