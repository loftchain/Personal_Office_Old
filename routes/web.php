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
Route::group(['middleware' => ['kyc']], function (){
    Route::get('/home', 'HomeController@home')->name('home');
});
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

//------------------------Forgot Your password---------------------------------------------
Route::post('/sendResetLink', 'Auth\ForgotPasswordController@sendResetLinkEmailCustom')->name('sendResetLinkEmail');

//-----------------------------------------------------------------------------------

//------------------------StepValidation---------------------------------------------
Route::post('/goToAgreement2', 'Auth\StepValidation\AgreementController@goToAgreement2')->name('goToAgreement2');
Route::post('/store_personal_data', 'Auth\StepValidation\AgreementController@store_personal_data')->name('store_personal_data');
Route::post('/store_documents', 'Auth\StepValidation\AgreementController@store_documents')->name('store_documents');
Route::group(['middleware' =>  ['agreement1']], function(){
	Route::get('/agreement', 'Auth\StepValidation\Agreement1Controller@agreement1')->name('agreement');
});
//-----------------------------------------------------------------------------------

//------------------------Wallet-----------------------------------------------------
Route::post('/store_wallet', 'WalletController@store_wallet')->name('store_wallet');
Route::post('/edit_wallet', 'WalletController@edit_wallet')->name('edit_wallet');
Route::get('/send_usd_proposal', 'WalletController@send_usd_proposal')->name('send_usd_proposal');
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

//Referral
Route::group(['prefix' => 'referral', 'as' => 'referral.'], function (){
    Route::get('check/wallet', 'ReferralController@checkWallet')->name('check.wallet');
    Route::get('check', 'ReferralController@checkReferrals')->name('check');
});

//------------------------Language---------------------------------------------------
Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);
//-----------------------------------------------------------------------------------

Auth::routes();


//------------------------Admin---------------------------------------------------


Route::group(['middleware' =>  ['admin']], function(){
	Route::get('/admin/confirmation/{user_id}', 'Admin\AdminController@confirmation')->name('confirmation');
	Route::get('/admin/return_to_step2/{user_id}', 'Admin\AdminController@return_to_step2')->name('return_to_step2');
	Route::get('/admin/confirm_view/{data}', 'Admin\AdminController@confirm_view')->name('confirm_view');
	Route::get('/admin/get_user_info', 'Admin\AdminController@get_user_info')->name('get_user_info');
	Route::get('/admin/getFile/{fileName}', 'Admin\AdminController@getFile')->name('getFile');
	Route::get('/getDataForAdminTx', 'Admin\AdminController@getDataForAdminTx')->name('getDataForAdminTx');
	Route::post('/admin/transaction/update', 'Admin\TransactionController@updateSend')->name('transaction.update');
    Route::get('/admin/referrals', 'Admin\ReferralController@index')->name('referral');
    Route::post('/admin/referrals/update', 'Admin\ReferralController@update')->name('referral.update');
    Route::get('/admin/kyc', 'Admin\KycController@index')->name('kyc');
});

//------------------------KYC---------------------------------------------------

Route::group(['prefix' => 'kyc', 'as' => 'kyc.', 'middleware' => 'isKyc'], function (){
    Route::get('/', 'KycController@index')->name('index');
    Route::get('user/update', 'KycController@userUpdate')->name('user.update');
    Route::post('store', 'KycController@store')->name('store');
    Route::post('upload/img', 'KycController@uploadImg')->name('upload.img');
});