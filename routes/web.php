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

use App\Http\Controllers\SavedMovieController;

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'movie'], function () {
    Route::get('/{movie}', 'MovieController@show')->name('movie');
    Route::post('/{movie}', 'CommentController@store');
    Route::delete('/{movie}/{comment}/delete', 'CommentController@destroy');

    Route::post('/{movie}/save', 'SavedMovieController@store');
    Route::delete('/{movie}/unsave', 'SavedMovieController@destroy');
});

Route::group(['prefix' => 'home'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/{movie}', 'SavedMovieController@store');
    Route::delete('/{movie}', 'SavedMovieController@destroy');
});




Route::group(['middleware' => ['guest']], function () {
    Route::post('/register', 'MemberController@store');
    Route::get('/register', 'MemberController@create');
    Route::post('/login', 'MemberController@login');
    Route::get('/login', function(){
        return view('login');
    })->name('login');

});
// Route::get('/login', 'MemberController@login');

Route::post('/logout', 'MemberController@logout');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['admin']], function () {
        Route::prefix('/manage')->group(function () {
            Route::group(['prefix' => 'genres'], function(){
                Route::get('/', 'GenreController@index')->name('genreMaster');
                Route::get('/add', 'GenreController@create');
                Route::post('/add', 'GenreController@store');
                Route::get('/{genre}', 'GenreController@show');

                Route::get('/{genre}/edit', 'GenreController@edit');
                Route::put('/{genre}', 'GenreController@update');

                Route::delete('/{genre}','GenreController@destroy');
            });

            Route::group(['prefix' => 'members'], function(){
                Route::get('/', 'MemberController@index')->name('memberMaster');
                Route::get('/add', 'MemberController@createByAdmin');
                Route::post('/add', 'MemberController@storeByAdmin');
                Route::get('/{member}', 'MemberController@show');

                Route::get('/{member}/edit', 'MemberController@edit');
                Route::put('/{member}', 'MemberController@update');

                Route::delete('/{member}', 'MemberController@destroy');
            });

            Route::group(['prefix' => 'movies'], function () {
                Route::get('/', 'MovieController@index')->name('movieMaster');
                Route::get('/add', 'MovieController@create');
                Route::post('/add', 'MovieController@store');
                Route::get('/{movie}', 'MovieController@show');

                Route::get('/{movie}/edit', 'MovieController@edit');
                Route::put('/{movie}', 'MovieController@update');

                Route::delete('/{movie}', 'MovieController@destroy');
            });
        });
    });



    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'MemberController@show_self')->name('profile');
        Route::get('/edit', 'MemberController@edit_self');
        Route::put('/', 'MemberController@update_self');
    });
    Route::group(['middleware' => ['member']], function () {
        Route::group(['prefix' => 'inbox'], function () {
            Route::get('/', 'MessageController@index')->name('inbox');
            Route::delete('/{message}', 'MessageController@destroy');
        });

        Route::group(['prefix' => 'saved'], function () {
            Route::get('/', 'SavedMovieController@index')->name('saved');
            Route::delete('/{movie}', 'SavedMovieController@destroy');
        });
    });


    Route::group(['prefix' => 'member'], function () {
        Route::get('/{member}', 'MemberController@show')->name('member');
        Route::post('/{member}', 'MessageController@store');

        Route::get('/{member}/edit', 'MemberController@edit_self');
        Route::post('/{member}/edit', 'MemberController@update_self');
    });


});






