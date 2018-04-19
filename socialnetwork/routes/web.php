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
use Illuminate\Auth\Middleware\Authenticate;

Route::group(['middleware' => ['web']],function(){

	Route::get('/', function () {
    return view('welcome');
	})->name('login');//dikasih nama login supaya kalau tidak bisa melewati middlware (tidak terautentifikasi) maka halaman akan kembali ke page bernama login



	Route::post('/signup',[
		'uses' => 'UserController@postSignUp',
		'as' => 'signup'
	]);


	Route::post('/signin',[
		'uses' => 'UserController@postSignIn',
		'as' => 'signin'
	]);

	Route::get('/logout',[
		'uses' => 'UserController@getLogout',
		'as' => 'logout'
	])->middleware('auth');


	Route::get('/account',[
		'uses' => 'UserController@getAccount',
		'as' => 'account'
	]);

	Route::post('/updateaccount',[
		'uses' => 'UserController@postSaveAccount',
		'as' => 'account.save'
	]);

	Route::get('/userimage/{filename}',[
		'uses' => 'UserController@getUserImage',
		'as' => 'account.image'
	]);




	Route::get('/dashboard',[
		'uses' => 'PostController@getDashboard',
		'as' => 'dashboard'
	])->middleware('auth');

	Route::post('/create',[
		'uses' => 'PostController@postCreatePost',
		'as' => 'post.create'
	]);

	Route::get('/delete-post/{post_id}',[ //post_id disini sama dengan $post_id dalam method getDeletePost pada controller PostController 
		'uses' => 'PostController@getDeletePost',
		'as' => 'post.delete'
	])->middleware('auth');

	Route::post('/edit',[
		'uses' =>'PostController@postEditPost',
		'as' => 'edit'
	]);

	Route::post('/like',[
		'uses' => 'PostController@postLikePost',
		'as' => 'like'
	]);

	



	
});
