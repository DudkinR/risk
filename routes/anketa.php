<?php

Route::get('/anketa', [App\Http\Controllers\AnketaController::class, 'index'])->name('anketa.index');
Route::get('/anketa/create', [App\Http\Controllers\AnketaController::class, 'create'])->name('anketa.create');
Route::post('/anketa/store', [App\Http\Controllers\AnketaController::class, 'store'])->name('anketa.store');
Route::get('/anketa/show/{id}', [App\Http\Controllers\AnketaController::class, 'show'])->name('anketa.show');
Route::get('/anketa/edit/{id}', [App\Http\Controllers\AnketaController::class, 'edit'])->name('anketa.edit');
Route::put('/anketa/update/{id}', [App\Http\Controllers\AnketaController::class, 'update'])->name('anketa.update');
Route::delete('/anketa/destroy/{id}', [App\Http\Controllers\AnketaController::class, 'destroy'])->name('anketa.destroy');
