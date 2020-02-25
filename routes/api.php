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
Route::get('/tshirt', 'TshirtController@index');
Route::post('/gebruiker/resetpassword', 'GebruikerController@resetPassword');

//Voor mobile
Route::get('/evenement/getGebruikersFromEvenement/{id}', 'EvenementController@getGebruikersFromEvenement');
Route::get('/actieveEvenementen', 'EvenementController@getActieveEvenementen');
Route::post('/postTijdsregistratie', 'TijdsregistratieController@postTijdsregistratie');
Route::post('/postUpdateTijdsregistratie', 'TijdsregistratieController@postUpdateTijdsregistratie');
Route::post('/postTablet', 'TabletController@updateTablet');
Route::post('/postMultTikkingen', 'TijdsregistratieController@postMultipleTijdsregistraties');
//Voor lora
Route::post('/tijdsregistratie/loraTijdsregistratie/{string}', 'TijdsregistratieController@loraTijdsregistratie');

Route::group(['middleware' => 'auth:api'], function () {
    // Tshirt
//    Route::get('/tshirt', 'TshirtController@index');
    Route::put('/tshirt/{id}', 'TshirtController@updateLidGeslachtEnMaat');

    //Gebruiker
    Route::get('/gebruiker', 'GebruikerController@index');
    Route::post('/gebruiker/addlid', 'GebruikerController@addLid');
    Route::post('/gebruiker/addlidadmin/{verenigingId}', 'GebruikerController@addLidAdmin');
    Route::delete('/gebruiker/deletelid/{id}', 'GebruikerController@deleteLid');
    Route::get('/gebruiker/getlid/{id}', 'GebruikerController@getLid');
    Route::put('/gebruiker/updatelid/{id}', 'GebruikerController@updateLid');
    Route::post('/gebruiker/registreergebruiker', 'GebruikerController@registreerGebruiker');
    Route::get('/gebruiker/getGebruiker/{id}', 'GebruikerController@getGebruiker');
    Route::get('/gebruiker/getVrijwilligersByVereniging/{id}', 'GebruikerController@getVrijwilligersByVereniging');
    Route::get('/gebruiker/ingelogdegebruiker', 'GebruikerController@detailIngelogdeGebruiker');
    Route::get('/gebruiker/getKernleden', 'GebruikerController@getKernleden');
    Route::put('/gebruiker/updateingelogdegebruiker', 'GebruikerController@updateIngelogdeGebruiker');
    Route::get("/gebruiker/getAdmins", "GebruikerController@getAdmins");
    Route::post('/gebruiker/import', 'GebruikerController@importArrayGebruikers');
    Route::get('/gebruiker/delete/{userId}', 'GebruikerController@makeAnonymous');

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
    Route::get('/vereniging/verenigingbyidmetledentshirt/{id}', 'VerenigingController@getVerenigingByIdMetLedenTshirt');
    Route::get('/vereniging/getGeacepteerdeVerenigingen', 'VerenigingController@getGeacepteerdeVerenigingen');

    // inAanvraag behandelen
    Route::get('/vereniging/inAanvraag', 'VerenigingController@getVerenigingenInAanvraag');
    Route::get('/vereniging/accept/{id}/{verid}', 'VerenigingController@acceptVereniging');
    Route::delete('/vereniging/deny/{id}', 'VerenigingController@denyVereniging');

    // EvenementVereniging
    Route::get('/evenementVereniging/getVerenigingenByEvenementId/{evenementId}', 'EvenementVerenigingController@getVerenigingenByEvenementId');
    Route::post('/evenementVereniging/postEvenementVereniging', 'EvenementVerenigingController@registreerEvenementVereniging');
    Route::post('/evenementvereniging/deleteverenigingfromevenement', 'EvenementVerenigingController@deleteVerenigingFromEvenement');

    // Rol
    Route::get('/rol', 'RolController@index');
    Route::get('/rol/getRol','RolController@getRol');
    Route::get('/rol/getRolIdWhereNaam/{naam}','RolController@getRolIdWhereNaam');

    // Tijdsregistratie
    Route::get('/tijdsregistratie', 'TijdsregistratieController@index');
    Route::post('/tijdsregistratie', 'TijdsregistratieController@addTijdsregistratie');
    Route::put('/tijdsregistratie/{id}', 'TijdsregistratieController@updateTijdsregistratie');


    // Taak
    Route::get('/taak', 'TaakController@index');
    Route::post('/taak', 'TaakController@addTaak');
    Route::put('/taak/{id}', 'TaakController@updateTaak');
    Route::delete('/taak/deleteTaak/{id}', 'TaakController@deleteTaak');

    // Taakgroep
    Route::get('/taakgroep', 'TaakgroepController@index');

    // Subtaak
    Route::get('/subtaak', 'SubtaakController@index');

    //Tablet status
    Route::get('/tablet', 'TabletController@index');
});




