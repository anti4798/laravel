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

	// return redirect('protected');
	Event::fire('user.login', [Auth::user()]);

	// var_dump('Event fired and continue to next line...');

	return;
});

Event::listen('user.login', function($user) {
    // var_dump('"user.log" event catched and passed data is:');
	// var_dump($user->toArray());
	$user->last_login = (new DateTime)->format('Y-m-d H:i:s');

	return $user->save();
});

Route::get('auth/logout', function() {
	Auth::logout();

	return 'See you again~';
});

// Route::get('auth/login', function() {
// 	return "You've reached to the login page~";
// });

Route::get('protected', function() {
	return 'Welcome back, ' . Auth::user()->name;
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('auth/login', 'Auth\LoginController@getLogin');


// Route::get('posts', function(\Illuminate\Http\Request $request) {
// 	// $posts = App\Post::with('user')->paginate(10);
// 	// $posts = App\Post::get();
// 	// $posts->load('user');
// 	//return view('posts.index', compact('posts'));

// 	$rule = [
// 		'title' => ['required'],
// 		'body' => ['required', 'min:10']
// 	];

// 	$validator = Validator::make($request->all(), $rule);

// 	if ($validator->fails()) {
// 		return redirect('posts/create')->withErrors($validator)->withInput();
// 	}

// 	return 'Valid & proceed to next job ~';
// });

Route::resource('posts', 'PostsController');

// Route::get('posts/create', function() {
// 	return view('posts.create');
// });

Route::get('mail', function() {
	$to = 'anti4798@nayuntech.com';
	$subject = 'This is Gmail Test in Laravel';
	$data = [
		'title' => 'Hi There',
		'body' => 'This is the body of an email message',
		'user' => App\User::find(1)
	];
	
	return Mail::send('emails.welcome', $data, function($message) use($to, $subject) {
		$message->to($to)->subject($subject);
	});
});

Route::get('/errorPage', function() {
	throw new Exception('Some bad thing happened');
});

// DB::listen(function($event){
//     var_dump($event->sql);
// });