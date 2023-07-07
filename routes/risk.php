<?php

Route::get('/risk', [App\Http\Controllers\RiskController::class, 'index'])->name('risk.index');
Route::get('/risk/create', [App\Http\Controllers\RiskController::class, 'create'])->name('risk.create');
Route::post('/risk/store', [App\Http\Controllers\RiskController::class, 'store'])->name('risk.store');
Route::get('/risk/show/{id}', [App\Http\Controllers\RiskController::class, 'show'])->name('risk.show');
Route::get('/risk/edit/{id}', [App\Http\Controllers\RiskController::class, 'edit'])->name('risk.edit');
Route::put('/risk/update/{id}', [App\Http\Controllers\RiskController::class, 'update'])->name('risk.update');
Route::delete('/risk/destroy/{id}', [App\Http\Controllers\RiskController::class, 'destroy'])->name('risk.destroy');
Route::post('/risk/addquestions', [App\Http\Controllers\RiskController::class, 'addquestions'])->name('risk.addquestions');
Route::post('/risk/addquestion', [App\Http\Controllers\RiskController::class, 'addquestion'])->name('risk.addquestion');

