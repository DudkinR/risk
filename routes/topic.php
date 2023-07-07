<?php

Route::get('/topic', [App\Http\Controllers\TopicController::class, 'index'])->name('topic.index');
Route::get('/topic/create', [App\Http\Controllers\TopicController::class, 'create'])->name('topic.create');
Route::post('/topic/store', [App\Http\Controllers\TopicController::class, 'store'])->name('topic.store');
Route::get('/topic/show/{id}', [App\Http\Controllers\TopicController::class, 'show'])->name('topic.show');
Route::get('/topic/edit/{id}', [App\Http\Controllers\TopicController::class, 'edit'])->name('topic.edit');
Route::put('/topic/update/{id}', [App\Http\Controllers\TopicController::class, 'update'])->name('topic.update');
Route::delete('/topic/destroy/{id}', [App\Http\Controllers\TopicController::class, 'destroy'])->name('topic.destroy');
