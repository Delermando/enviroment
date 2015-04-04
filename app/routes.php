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

Route::get( '/', function(){
	return "All cats";
});

Route::get( 'cats' , function(){
	$cats = Cat::All();
	return View::make( 'cats.index' )->with( 'cats', $cats );
});

Route::get( 'cats/breeds/{name}', function( $name ){
	$breed = Breed::whereName( $name )->with( 'cats' )->first();
	return View::make( 'cats.index' )
		->with( 'breed', $breed )
		->with( 'cats', $breed->cats );
});

//Route::model('cat', 'Cat');
//Route::get('cats/{cat}', function(Cat $cat) {
//	return View::make('cats.single')
//		->with('cat', $cat);
//});

//Route::get( 'cats/{id}', function( $id ){
//	$cat = Cat::find( $id );
//	return View::make('cats.single')
//		->with('cat', $cat);
//});

Route::get( 'cats/create', function(){
	$cat = new Cat();
	return View::make('cats.edit')
		->with('cat', $cat)
		->with('method','post');
});


Route::post( 'cats', function(){
	$cat = Cat::create(Input::all());
	return Redirect::to('cats/'.$cat->id)
		->with( 'message', 'Successfully created page' );
} );

Route::model('cat', 'Cat');
Route::get( 'cats/{cat}/edit', function(Cat $cat){
	return View::make( 'cats.edit' ) 
		->with( 'cat', $cat )
		->with( 'method', 'put');
});

Route::put( 'cats/{cat}', function($cat){
	$cat->update(Input::all());
	return Redirect::to('cats/'.$cat->id)
		->with('message','Sucessfully updated page!');
});


Route::get( 'cats/{cat}/delete', function(Cat $cat){
	return View::make( 'cats.edit' )
		->with( 'cat', $cat )
		->with( 'method', 'delete' );
});

Route::delete( 'cats/{cat}', function($cat){
	$cat->delete();
	return Redirect::to('cats')
		->with('message', 'Sucessfully deleted page!');
});

Route::get( 'cats2/{id}', function( $id ){
	return "Cat #$id";
})->where( 'id', '[0-9]+' );

Route::get( 'catsRedirect', function(){
	return Redirect::to( 'cats' );
});

Route::get('catsTestView', function(){
	return View::make('about')->with('number_of_cats',9000);
});


View::composer( 'cats.edit', function( $view){
	$breeds = Breed::all();
	if( count($breeds) > 0 )
		$breed_options = array_combine( $breeds->lists('id'), $breeds->lists('name') );
	else
		$breed_options = array( null, 'Unspecified' );

	$view->with( 'breed_options', $breed_options);
});
