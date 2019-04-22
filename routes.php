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

Route::get('/', 'HomeController@index');
Route::post('/login-form', 'HomeController@login');
Route::get('/logout-form', 'HomeController@logout');
Route::get('/list-articles-ajax', 'ArticleController@list_articles_ajax');
Route::get('/single-article/{id?}', 'ArticleController@single_article');
Route::get('/create-article', 'CrudController@create_article');
Route::post('/create-article-ajax', 'CrudController@create_ajax');
Route::get('/find-article/{id}', 'ArticleController@findArticle');
Route::get('/delete-article', 'ArticleController@delete_article_view');
Route::get('/list-article-user', 'ArticleController@list_article_user');
Route::get('/update-article', 'ArticleController@update_article');
Route::post('/update-custom-article/{id}', 'CrudController@update');
Route::get('/list-users/{id}', 'ArticleController@user_list');
Route::delete('delete-article-ajaxx/{id}', 'CrudController@delete_article_ajax');
Route::get('/delete-image/{id}/{pom}', 'CrudController@delete_image');
Route::post('/create-article', 'CrudController@create');

Route::get('/pagin', function(){
	return View::make('paginator');
});