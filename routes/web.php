<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    return view('index');
});


Route::get('/', 'IndexController@index');

Route::resource('posts', 'PostsController');

Route::resource('posts.comments', 'PostCommentController');

Route::get('auth', function() {
	$credentials = [
		'email'		=> 'john@example.com',
		'password'	=> 'password'
	];

	if (! Auth::attempt($credentials)) {
		return 'Incorrect username and password combination';
	}

	return redirect('protected');
});

Route::get('auth/logout', function() {
	Auth::logout();

	return 'See you again~';
});
/*
Route::get('login', [
	'as' => 'login',
	'uses' => function() {
	return "You've reached to the login page~";
	}
]);*/

Route::get('protected', [
	'middleware' => 'auth',
	function() {
		return 'Welcome back, ' . Auth::user()->name;
	}
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
