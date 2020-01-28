<?php

use Illuminate\Http\Request;

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
Route::post('login', 'GebruikerController@login');
Route::post('/gebruiker/registreerverantwoordelijke', 'GebruikerController@registreerVerantwoordelijke');
Route::post('/vereniging', 'VerenigingController@registreer');

Route::group(['middleware' => 'auth:api'], function(){
    // Tshirt
    Route::get('/tshirt', 'TshirtController@index');
    Route::post('/tshirt', 'TshirtController@create');
    Route::put('/tshirt/{id}', 'TshirtController@updateLidGeslachtEnMaat');

    //Gebruiker
    Route::post('/gebruiker/addlid', 'GebruikerController@addLid');
    Route::delete('/gebruiker/deletelid/{id}', 'GebruikerController@deleteLid');
    Route::get('/gebruiker/getlid/{id}', 'GebruikerController@getLid');
    Route::put('/gebruiker/updatelid/{id}', 'GebruikerController@updateLid');
    Route::post('/gebruiker/registreergebruiker', 'GebruikerController@registreerGebruiker');
    Route::get('/gebruiker/getGebruiker/{id}', 'GebruikerController@getGebruiker');

    // Evenement
    Route::get('/evenement', 'EvenementController@index');
    Route::post('/evenement', 'EvenementController@registreer');
    Route::put('/evenement/{id}', 'EvenementController@updateEvenement');

    // Vereniging
    Route::get('/vereniging', 'VerenigingController@index');
    Route::get('/vereniging/getVereniging/{id}', 'VerenigingController@getVereniging');
    Route::post('/vereniging', 'VerenigingController@registreer');
    Route::get('/vereniging/verenigingmetleden', 'VerenigingController@getVerenigingMetLeden');
    Route::get('/vereniging/verenigingingelogd', 'VerenigingController@getVerenigingVanIngelogdeGebruiker');
    Route::put('/vereniging/{id}', 'VerenigingController@updateVereniging');

    // EvenementVereniging
    Route::get('/evenementVereniging/getVerenigingenByEvenementId/{evenementId}', 'EvenementVerenigingController@getVerenigingenByEvenementId');
    Route::post('/evenementVereniging/postEvenementVereniging', 'EvenementVerenigingController@registreerEvenementVereniging');

    // Rol
    Route::get('/rol', 'RolController@index');

});


Route::get('/evenement/getGebruikersFromEvenement/{id}', 'EvenementController@getGebruikersFromEvenement');
Route::get('/actieveEvenementen','EvenementController@getActieveEvenementen');

