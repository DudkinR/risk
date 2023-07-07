<?php
 Route::get('/ses', function(){
      App::setLocale(session('locale'));
     return __('Amount Total').session('locale');
  //   $action = App\Models\Action::find(1);
  //  return $action;
 } )->name('test.ses');
 Route::get('setlocale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});
