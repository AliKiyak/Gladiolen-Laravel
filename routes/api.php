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
Route::post('/tshirt', 'TshirtController@create');
Route::post('/vereniging', 'VerenigingController@registreer');

//Voor mobile
Route::get('/evenement/getGebruikersFromEvenement/{id}', 'EvenementController@getGebruikersFromEvenement');
Route::get('/actieveEvenementen', 'EvenementController@getActieveEvenementen');
Route::post('/postTijdsregistratie', 'TijdsregistratieController@postTijdsregistratie');
Route::post('/postUpdateTijdsregistratie','TijdsregistratieController@postUpdateTijdsregistratie');



Route::group(['middleware' => 'auth:api'], function () {
    // Tshirt
    Route::get('/tshirt', 'TshirtController@index');
    Route::put('/tshirt/{id}', 'TshirtController@updateLidGeslachtEnMaat');

    //Gebruiker
    Route::get('/gebruiker', 'GebruikerController@index');
    Route::post('/gebruiker/addlid', 'GebruikerController@addLid');
    Route::delete('/gebruiker/deletelid/{id}', 'GebruikerController@deleteLid');
    Route::get('/gebruiker/getlid/{id}', 'GebruikerController@getLid');
    Route::put('/gebruiker/updatelid/{id}', 'GebruikerController@updateLid');
    Route::post('/gebruiker/registreergebruiker', 'GebruikerController@registreerGebruiker');
    Route::get('/gebruiker/getGebruiker/{id}', 'GebruikerController@getGebruiker');
    Route::get('/gebruiker/ingelogdegebruiker', 'GebruikerController@detailIngelogdeGebruiker');
    Route::get('gebruiker/getKernleden', 'GebruikerController@getKernleden');

    // Evenement
    Route::get('/evenement', 'EvenementController@index');
    Route::post('/evenement', 'EvenementController@registreer');
    Route::put('/evenement/{id}', 'EvenementController@updateEvenement');

    // Vereniging
    Route::get('/vereniging', 'VerenigingController@index');
    Route::get('/vereniging/getVereniging/{id}', 'VerenigingController@getVereniging');
    Route::get('/vereniging/verenigingmetleden', 'VerenigingController@getVerenigingMetLeden');
    Route::get('/vereniging/verenigingingelogd', 'VerenigingController@getVerenigingVanIngelogdeGebruiker');
    Route::put('/vereniging/{id}', 'VerenigingController@updateVereniging');
    Route::get('/vereniging/verenigingbyidmetleden/{id}', 'VerenigingController@getVerenigingByIdMetLeden');

    // EvenementVereniging
    Route::get('/evenementVereniging/getVerenigingenByEvenementId/{evenementId}', 'EvenementVerenigingController@getVerenigingenByEvenementId');
    Route::post('/evenementVereniging/postEvenementVereniging', 'EvenementVerenigingController@registreerEvenementVereniging');
    Route::post('/evenementvereniging/deleteverenigingfromevenement', 'EvenementVerenigingController@deleteVerenigingFromEvenement');
    // Rol
    Route::get('/rol', 'RolController@index');

    // Tijdsregistratie
    Route::get('/tijdsregistratie', 'TijdsregistratieController@index');
    Route::post('/tijdsregistratie', 'TijdsregistratieController@addTijdsregistratie');
    Route::put('/tijdsregistratie/{id}', 'TijdsregistratieController@updateTijdsregistratie');
});




