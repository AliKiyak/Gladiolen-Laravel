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
Route::post('/tshirt', 'TshirtController@create');
Route::put('/tshirt/{id}', 'TshirtController@updateLidGeslachtEnMaat');
// GebruikerController Routes
Route::post('/gebruiker/registreerverantwoordelijke', 'GebruikerController@registreerVerantwoordelijke');
Route::post('/addlid', 'GebruikerController@addLid');
Route::delete('/deletelid/{id}', 'GebruikerController@deleteLid');
Route::get('/getlid/{id}', 'GebruikerController@getLid');
Route::put('/updatelid/{id}', 'GebruikerController@updateLid');
Route::get('/gebruikers', 'GebruikerController@index');
Route::post('/registreergebruiker', 'GebruikerController@registreerGebruiker');
Route::get('gebruiker/getGebruiker/{id}', 'GebruikerController@getGebruiker');
Route::get('gebruiker/getKernleden', 'GebruikerController@getKernleden');

// EvenementController Routes
Route::get('/evenement', 'EvenementController@index');
Route::post('/evenement', 'EvenementController@registreer');
Route::put('/evenement/{id}', 'EvenementController@updateEvenement');


// VerenigingController Routes
Route::get('/verenigings', 'VerenigingController@index');
Route::get('/vereniging/getVereniging/{id}', 'VerenigingController@getVereniging');
Route::post('/vereniging', 'VerenigingController@registreer');
Route::get('/vereniging/verenigingmetleden', 'VerenigingController@getVerenigingMetLeden');
Route::get('/vereniging/verenigingingelogd', 'VerenigingController@getVerenigingVanIngelogdeGebruiker');
Route::put('/vereniging/{id}', 'VerenigingController@updateVereniging');

// EvenementVerenigingController Routes
Route::get('/evenementVereniging/getVerenigingenByEvenementId/{evenementId}', 'EvenementVerenigingController@getVerenigingenByEvenementId');
Route::post('/evenementVereniging/postEvenementVereniging', 'EvenementVerenigingController@registreerEvenementVereniging');

// RolController Routes
Route::get('/rols', 'RolController@index');
