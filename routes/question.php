<?php

Route::get('/question', [App\Http\Controllers\QuestionController::class, 'index'])->name('question.index');
Route::get('/question/create', [App\Http\Controllers\QuestionController::class, 'create'])->name('question.create');
Route::post('/question/store', [App\Http\Controllers\QuestionController::class, 'store'])->name('question.store');
Route::get('/question/show/{id}', [App\Http\Controllers\QuestionController::class, 'show'])->name('question.show');
Route::get('/question/edit/{id}', [App\Http\Controllers\QuestionController::class, 'edit'])->name('question.edit');
Route::put('/question/update/{id}', [App\Http\Controllers\QuestionController::class, 'update'])->name('question.update');
Route::delete('/question/destroy/{id}', [App\Http\Controllers\QuestionController::class, 'destroy'])->name('question.destroy');
Route::post('/question/addanswers', [App\Http\Controllers\QuestionController::class, 'addanswers'])->name('question.addanswers');
// route any similar
Route::any('/question/similar', [App\Http\Controllers\QuestionController::class, 'similar'])->name('question.similar');
