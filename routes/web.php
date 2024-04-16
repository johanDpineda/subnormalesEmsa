<?php

use App\Http\Controllers\productsController;
use App\Http\Livewire\OrdenForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

//Languages
Route::get('/set_language/{lang}','Controller@set_language')->name('set_language');

//Auth
Route::group(['middleware' => 'auth'], function () {
    //Dashboard
    Route::group(['prefix'=>'admin'],function (){

        //Dashboard
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');

        //Users
        Route::group(['prefix'=>'users'],function (){
            Route::get('/','UserController@index')->name('users.index');
        });

         //Users Caminante
         Route::group(['prefix'=>'userscaminantes'],function (){
            Route::get('/','UserCaminanteController@index')->name('userscaminantes.index');
        });

        //Datos caminante
        Route::group(['prefix'=>'Caminantes'],function (){
            Route::get('/','DatoscaminanteController@index')->name('Caminantes.index');
        });

              //Control Terrenos
              Route::group(['prefix'=>'controlTerrenos'],function (){
                Route::get('/','ControlterrenosController@index')->name('controlTerrenos.index');
            });

             //creacion de zonas subnormales
             Route::group(['prefix'=>'CrearSubNormal'],function (){
                Route::get('/','CrearSubnormalController@index')->name('CrearSubNormal.index');
            });

         //censo
         Route::group(['prefix'=>'censofamilia'],function (){
            Route::get('/','censofamiliaController@index')->name('censofamilia.index');
        });













    });
});







Route::get('/', 'Frontend\FrontendController@index')->name('frontend.index');
