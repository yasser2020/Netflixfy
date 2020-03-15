<?php

Route::prefix('dashboard')
->name('dashboard.')->
middleware(['auth','role:super_admin|admin'])->
group(function(){
    //welcome route
     Route::get('/','welcomeController@index')->name('welcome');
     Route::resource('categories','CategoryController')->except('show');
     //role route
     Route::resource('roles','RoleController')->except('show');
     Route::resource('users','UserController')->except('show');
});
