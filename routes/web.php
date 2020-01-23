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
    $gebruikers = \App\Gebruiker::with('rol')->get();
    dd($gebruikers);
});

// TshirtController Routes
Route::get('/tshirts', 'TshirtController@index');

// GebruikerController Routes
Route::post('/gebruiker', 'GebruikerController@registreer');
Route::post('/addlid', 'GebruikerController@addLid');
Route::delete('/deletelid/{id}', 'GebruikerController@deleteLid');
Route::get('/getlid/{id}', 'GebruikerController@getLid');
Route::put('/updatelid/{id}', 'GebruikerController@updateLid');
Route::get('/gebruikers', 'GebruikerController@index');
Route::post('/registreergebruiker', 'GebruikerController@registreerGebruiker');
// EvenementController Routes
Route::get('/evenement', 'EvenementController@index');
Route::post('/evenement', 'EvenementController@registreer');

// VerenigingController Routes
Route::get('/verenigings', 'VerenigingController@index');
Route::post('/vereniging', 'VerenigingController@registreer');
Route::get('/eigenleden', 'VerenigingController@getLedenVanEigenVereniging');

// RolController Routes
Route::get('/rols', 'RolController@index');
