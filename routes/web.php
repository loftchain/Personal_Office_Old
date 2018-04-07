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

Route::group(['middleware' =>  ['guest']], function(){

  Route::get('/', 'HomeController@welcome')->name('root');

});


Route::any('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Route::get('/home', 'HomeController@welcome')->name('home');

Route::get('/change_email', 'Auth\ChangeEmailController@change_email')->name('change_email');
Route::get('/change_password', 'Auth\ChangePasswordController@change_password')->name('change_password');

Route::get('/resend/{email}', 'Auth\RegisterController@resend')->name('resend');
Route::get('/confirmation/{token}', 'Auth\RegisterController@confirmation')->name('confirmation');

Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/goToAgreement2', 'Auth\StepValidation\AgreementController@goToAgreement2')->name('goToAgreement2');
Route::post('/reset_email', 'Auth\ChangeEmailController@reset_email')->name('reset_email');
Route::post('/renew_password', 'Auth\ChangePasswordController@renew_password')->name('renew_password');
Route::post('/store_personal_data', 'Auth\StepValidation\AgreementController@store_personal_data')->name('store_personal_data');
Route::post('/store_wallet', 'WalletController@store_wallet')->name('store_wallet');
Route::post('/edit_wallet', 'WalletController@edit_wallet')->name('edit_wallet');
Route::get('/current_wallets', 'WalletController@current_wallets')->name('current_wallets');

Auth::routes();


Route::group(['middleware' =>  ['agreement1']], function(){
  Route::get('/agreement1', 'Auth\StepValidation\Agreement1Controller@agreement1')->name('agreement1');
});

Route::group(['middleware' =>  ['agreement2']], function(){
  Route::get('/agreement2', 'Auth\StepValidation\Agreement2Controller@agreement2')->name('agreement2');
});

Route::group(['middleware' =>  ['guest']], function() {
  Route::get('/successRegister', 'Auth\RegisterController@successRegister')->name('successRegister');
});

Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);
