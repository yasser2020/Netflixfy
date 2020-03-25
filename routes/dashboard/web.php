<?php

Route::prefix('dashboard')
->name('dashboard.')->
middleware(['auth','role:super_admin|administrator'])->
group(function(){
    //welcome route
     Route::get('/','welcomeController@index')->name('welcome');
     Route::resource('categories','CategoryController')->except('show');
     //movie route
     Route::resource('movies','MovieController');
     //role route
     Route::resource('roles','RoleController')->except('show');
     Route::resource('users','UserController')->except('show');
     Route::get('/setting/social_login','SettingController@social_login')->name('setting.social_login');
     Route::get('/setting/social_links','SettingController@social_links')->name('setting.social_links');
     Route::post('/settings','SettingController@store')->name('settings.store');
    });
