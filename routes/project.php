<?php

Route::get('/project', [App\Http\Controllers\ProjectController::class, 'index'])->name('project.index');
Route::get('/project/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('project.create');
Route::post('/project/store', [App\Http\Controllers\ProjectController::class, 'store'])->name('project.store');
Route::get('/project/show/{id}', [App\Http\Controllers\ProjectController::class, 'show'])->name('project.show');
Route::get('/project/edit/{id}', [App\Http\Controllers\ProjectController::class, 'edit'])->name('project.edit');
Route::put('/project/update/{id}', [App\Http\Controllers\ProjectController::class, 'update'])->name('project.update');
Route::delete('/project/destroy/{id}', [App\Http\Controllers\ProjectController::class, 'destroy'])->name('project.destroy');
//Идентификация рисков: Команда проекта проводит анализ и идентификацию рисков, связанных с заменой насосного агрегата. Это может включать такие факторы, как технические проблемы, задержки в поставке оборудования, недостаток ресурсов и другие потенциальные проблемы.
Route::any('/project/risk/{id}/{topic}', [App\Http\Controllers\ProjectController::class, 'risk'])->name('project.risk');
//Оценка вероятности: Каждый идентифицированный риск оценивается по его вероятности возникновения. Это может быть основано на исторических данных, экспертной оценке или других релевантных источниках информации.
Route::any('/project/count_risk/{id}', [App\Http\Controllers\ProjectController::class, 'count_risk'])->name('project.count_risk');
//Оценка воздействия: Для каждого риска определяется его потенциальное воздействие на проект. Это может быть выражено в виде финансовых потерь, задержек в графике, снижении производительности и других факторов, которые могут негативно сказаться на результате проекта.
Route::any('/project/reaction/{id}', [App\Http\Controllers\ProjectController::class, 'reaction'])->name('project.reaction');
//Разработка мер управления рисками: Для каждого идентифицированного риска разрабатываются меры управления рисками. Это может включать планы предотвращения риска, планы реагирования на риск, установку контрольных точек для раннего обнаружения риска и другие стратегии и действия.
Route::any('/project/action/{id}', [App\Http\Controllers\ProjectController::class, 'action'])->name('project.action');
//Мониторинг и управление рисками: Команда проекта регулярно мониторит и контролирует риски, связанные с заменой насосного агрегата. Это включает отслеживание изменений в вероятности и воздействии рисков, проведение регулярных анализов и обновление стратегий управления рисками при необходимости.
Route::any('/project/monitoring/{id}', [App\Http\Controllers\ProjectController::class, 'monitoring'])->name('project.monitoring');
//Коммуникация и отчетность: Команда проекта поддерживает открытую коммуникацию и регулярно предоставляет отчеты о рисках и мерах по их управлению. Это позволяет заинтересованным сторонам быть в курсе ситуации и принимать решения на основе актуальной информации.
Route::any('/project/raport/{id}', [App\Http\Controllers\ProjectController::class, 'raport'])->name('project.raport');
//Категоризация рисков: Риски могут быть категоризированы по их важности и приоритету. Это позволяет определить, какие риски требуют более пристального внимания и управления.
Route::any('/project/cat/{id}', [App\Http\Controllers\ProjectController::class, 'cat'])->name('project.cat');
