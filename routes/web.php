<?php

if (env('FORCE_HTTPS') === true) {
    URL::forceScheme('https');
}

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


Route::get('/', function () {
    return redirect()->to('decks');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/clear-cache', function(){
    Artisan::call('cache:clear');
});

/**
 * Decks
 */
Route::get('/decks', 'YugiController@view_decks')->name('decks');
Route::view('/decks/register', 'decks_register')->name('decks_register');
Route::post('/decks/register/submit', 'YugiController@register_deck')->name('decks_register_submit');

/**
 * Duels
 */
Route::get('/duels', function(){
    return redirect()->to('duels/select');
})->name('duels');
Route::get('/duels/select', 'YugiController@select_duels')->name('duels_select');
Route::post('/duels/view', 'YugiController@select_duels_submit')->name('duels_select_submit');
Route::post('/duels/view/winner', 'YugiController@duels_submit_winner')->name('duels_submit_winner');
Route::post('/duels/view/undo', 'YugiController@duels_undo')->name('duels_undo');
