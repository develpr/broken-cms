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

Route::get('/', function()
{
	return View::make('home');
});

Route::resource('api/v1/contents', 'ContentController');
Route::resource('api/v1/pages', 'PageController');

Route::get('/500', function(){
	return View::make('login');
});


Route::get('/logout', function(){
	Auth::logout();
	return Redirect::to('/');
});

Route::post('/login', function(){
	if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password'))))
	{
		return Redirect::to('/');
	}
});

Route::get('/page/{page}/{slug?}', function($page, $slug = ''){

	$api = new ApiConnector();

	$page = $api->get('/api/v1/pages/' . $page . '?slug=' . $slug);

	$contents = array();

	if($api->getStatusCode() != '404')
		$contents = $api->get('/api/v1/contents?page_id=' . $page->id);
	else
		return Redirect::to('/');

	if(Auth::check())
		return View::make('page-edit')->with(array('page' => $page, 'contents' => $contents));
	else
		return View::make('page')->with(array('page' => $page, 'contents' => $contents));

});
