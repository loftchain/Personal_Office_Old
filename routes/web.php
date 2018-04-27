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

//------------------------Root-------------------------------------------------------
Route::group(['middleware' =>  ['guest']], function(){
  Route::get('/', 'HomeController@welcome')->name('root');
});
//-----------------------------------------------------------------------------------

//------------------------Home-------------------------------------------------------
Route::get('/home', 'HomeController@home')->name('home');
//-----------------------------------------------------------------------------------

//------------------------ChangeEmail/ChangePassword---------------------------------
Route::get('/change_email', 'Auth\ChangeEmailController@change_email')->name('change_email');
Route::post('/reset_email', 'Auth\ChangeEmailController@reset_email')->name('reset_email');
Route::get('/change_password', 'Auth\ChangePasswordController@change_password')->name('change_password');
Route::post('/renew_password', 'Auth\ChangePasswordController@renew_password')->name('renew_password');
//-----------------------------------------------------------------------------------

//------------------------Register/Login---------------------------------------------
Route::get('/resend/{email}', 'Auth\RegisterController@resend')->name('resend');
Route::get('/confirmation/{token}', 'Auth\RegisterController@confirmation')->name('confirmation');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::any('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
//-----------------------------------------------------------------------------------

//------------------------StepValidation---------------------------------------------
Route::post('/goToAgreement2', 'Auth\StepValidation\AgreementController@goToAgreement2')->name('goToAgreement2');
Route::post('/store_personal_data', 'Auth\StepValidation\AgreementController@store_personal_data')->name('store_personal_data');
Route::post('/store_documents', 'Auth\StepValidation\AgreementController@store_documents')->name('store_documents');
Route::group(['middleware' =>  ['agreement1']], function(){
	Route::get('/agreement1', 'Auth\StepValidation\Agreement1Controller@agreement1')->name('agreement1');
});
Route::group(['middleware' =>  ['agreement2']], function(){
	Route::get('/agreement2', 'Auth\StepValidation\Agreement2Controller@agreement2')->name('agreement2');
});
//-----------------------------------------------------------------------------------

//------------------------Wallet-----------------------------------------------------
Route::post('/store_wallet', 'WalletController@store_wallet')->name('store_wallet');
Route::post('/edit_wallet', 'WalletController@edit_wallet')->name('edit_wallet');
Route::get('/current_wallets', 'WalletController@current_wallets')->name('current_wallets');
Route::get('/description_view/{currency}', 'WalletController@description_view')->name('description_view');
//-----------------------------------------------------------------------------------

//------------------------Transaction------------------------------------------------
Route::get('/storeTxToDb', 'TransactionController@storeTxToDb')->name('storeTxToDb');
Route::get('/getDataForMyTx', 'TransactionController@getDataForMyTx')->name('getDataForMyTx');
Route::get('/getTxDesktopView', 'TransactionController@getTxDesktopView')->name('getTxDesktopView');
Route::get('/getTdDesktop', 'TransactionController@getTdDesktop')->name('getTdDesktop');
Route::get('/getTxMobileView', 'TransactionController@getTxMobileView')->name('getTxMobileView');
//-----------------------------------------------------------------------------------

//------------------------Language---------------------------------------------------
Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);
//-----------------------------------------------------------------------------------

Auth::routes();


//------------------------Admin---------------------------------------------------


Route::group(['middleware' =>  ['admin']], function(){
	Route::get('/admin/confirmation', 'Admin\AdminController@confirmation')->name('confirmation');
});