<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('articles', 'App\Http\Controllers\Api\ArticleController@savedata');
Route::get('articles', 'App\Http\Controllers\Api\ArticleController@retrievedata');
Route::put('articles/{id}', 'App\Http\Controllers\Api\ArticleController@updatedata');
Route::delete('articles/{id}', 'App\Http\Controllers\Api\ArticleController@destroy');
Route::post('contacts', 'ContactController@store')->name('contacts');
Route::get('books', 'App\Http\Controllers\Api\BookController@getAllBooks');
Route::get('books/{id}', 'App\Http\Controllers\Api\BookController@getBook');
Route::post('books', 'App\Http\Controllers\Api\BookController@createBook');
Route::put('books/{id}', 'App\Http\Controllers\Api\BookController@updateBook');
Route::delete('books/{id}','App\Http\Controllers\Api\BookController@deleteBook');

//Payment
Route::post('payment', 'App\Http\Controllers\Api\ArticleController@paymentAT');
//Route::resource('contacts', ContactController::class);