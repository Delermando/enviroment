<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function(){
	return "All cats";
});

Route::get('cats', function(){
	return "Redirect come to here";
});

Route::get('cats/{id}',function($id){
	return "Cat #$id";
});

Route::get('cats2/{id}',function($id){
	return "Cat #$id";
})->where('id','[0-9]+');

Route::get('catsRedirect',function(){
	return Redirect::to('cats');
});

Route::get('catsTestView', function(){
	return View::make('about')->with('number_of_cats',9000);
});