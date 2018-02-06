<?php

use Illuminate\Http\Request;
Use App\Services\WidgetService;
Use App\Services\TablesService;
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
Route::get('widget', function(){
  $widget_obj = new WidgetService();
  return response()->json($widget_obj->getApiW());
});

Route::get('currency', function(){
  $table_obj = new TablesService();
  $currency_array = $table_obj->getLatestCurrencies();
  return response()->json($currency_array);
});

Route::get('table', function(){
  $table_obj = new TablesService();
  $table_array = $table_obj->TableMaker();
  return response()->json($table_array);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
