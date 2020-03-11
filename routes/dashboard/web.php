<?php

Route::prefix('dashboard')->name('dashboard.')->group(function(){
    //welcome route
     Route::get('/','welcomeController@index')->name('welcome');
     Route::resource('categories','CategoryController');
});
