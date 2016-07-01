<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'web'],function(){

    Route::auth();

    Route::get('login/facebook', 'Auth\AuthController@redirectToFacebook');
    Route::get('login/facebook/callback', 'Auth\AuthController@getFacebookCallback');

    Route::get('/register', 'Auth\AuthController@getRegister');
    Route::post('/register', 'Auth\AuthController@postRegister');

    Route::get('/home', 'HomeController@index');
    Route::group(['prefix'=>'admin'], function(){
        Route::resource('/user','UserController');
        Route::resource('/posts','PostController');
    });

    //Managing Post
    // show all posts
    Route::get('posts','PostController@index');
    // New Posts form
    Route::get('new-post','PostController@create');
    // save new posts
    Route::post('new-post','PostController@store');
    // edit posts form
    Route::get('edit/{slug}','PostController@edit');
    // update posts
    Route::post('update','PostController@update');
    // delete posts
    Route::get('delete/{id}','PostController@destroy');
    // display user's all posts
    Route::get('my-all-posts','UserController@user_posts_all');
    // display user's drafts
    Route::get('my-drafts','UserController@user_posts_draft');
    // add comment
    Route::post('comment/add','CommentController@store');
    // delete comment
    Route::post('comment/delete/{id}','CommentController@distroy');

    // User Profile
    Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');
    // display list of posts
    Route::get('user/{id}/posts','UserController@user_posts')->where('id', '[0-9]+');
    // display single posts
    Route::get('/{slug}',['as' => 'posts', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');
    
});
