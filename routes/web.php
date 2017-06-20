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

Route::get('/', function () {
    return view('welcome');
});

/*
Route::get('/import/summoner', function () {
    return view('import.importSummoner');
});
*/
Route::get('/import/summoners/challenger', 'ImportJsonController@importChallengers');
Route::get('/import/summoners/master', 'ImportJsonController@importMasters');

Route::get('/test', 'SummonerController@store');