<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



route::prefix('/TPA')->controller(\App\Http\Controllers\TPA_Controller::class)->name('TPA.')->group(function(){
    /** ACCEUIL */
    Route::get('/','Acceuil')->name('acceuil');
    Route::get('/acceuil','Acceuil')->name('acceuil');
    Route::get('/acceuil-part-{part}','Acceuil_part')->name('acceuil_part');
    Route::get('/acceuil-pro-{pro}-{part}','Acceuil_pro')->name('acceuil_pro');


     /** CONNEXIONS */
    Route::get('/login','login')->name('login');
    Route::post('/login','login_process')->name('login_process');
    Route::get('/login-pro-{part}','login_pro')->name('login_pro');
    Route::post('/login-pro-{part}','login_pro_process')->name('login_pro_process');
    Route::delete('/logout','logout')->name('logout');


    /** INSCRIPTION */
    Route::get('/inscription','inscription')->name('inscription');
    Route::post('/inscription','inscription_process')->name('inscription_process');
    Route::get('/inscription-pro-{part}','inscription_pro')->name('inscription_pro');
    Route::post('/inscription-pro-{part}','inscription_pro_process')->name('inscription_pro_process');


    /** EXPERIENCES */
    Route::get('/experience-{pro}',[\App\Http\Controllers\TPA_Controller::class,'experience'])->name('experience');
    Route::post('/experience-{pro}',[\App\Http\Controllers\TPA_Controller::class,'exp_process'])->name('experience_process');
    Route::get('/experience-edit-{pro}-{exp}','experience_edit')->name('experience_edit');
    Route::post('/experience-edit-{pro}-{exp}','experience_edit_process')->name('experience_edit_process');


    /**  MISSIONS */
    Route::get('/mission-{pro}-{part}','mission')->name('mission');
    Route::post('/mission-{pro}-{part}','mission_process')->name('mission_process');
    Route::get('/mission-edit-{pro}-{part}-{exp}','mission_edit')->name('mission_edit');
    Route::post('/mission-edit-{pro}-{part}-{exp}','mission_edit_process')->name('mission_edit_process');


    /** MES OFFRES  */
    Route::get('mes-offres-{part}','mes_offres')->name('mes_offres');
    Route::get('mes-offres-recues-{pro}','mes_offres_recues')->name('mes_offres_recues');

    /** LISTE ET
     *
     *
     * SHOW
     */

    Route::get('/liste-pro-{part}-{fonction}','liste_pro')->name('liste_pro');

    /** PROFESSIONEL */
    Route::get('/pro_show-{pro}-{part}','pro_show')->name('pro_show');

    /** MISSION */
    Route::get('/mission_show','mission_show')->name('mission_show');

    /** EXPERIENCE*/
    Route::get('/experience_show','experience_show')->name('experience_show');

    /** EXPERIENCE */
    Route::get('/part_show-{pro}-{part}','part_show')->name('part_show');





});
//php composer.phar require --dev barryvdh/laravel-ide-helper --with-all-dependencies
//php composer.phar require barryvdh/laravel-debugbar --dev
