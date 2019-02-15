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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware'=>['auth:api']], function(){
    Route::apiResource('user', 'Api\UserController');
    Route::apiResource('cluster', 'Api\ClusterController');
    Route::apiResource('center', 'Api\CenterController');
    Route::apiResource('employee', 'Api\CenterEmployeeController');
    Route::apiResource('kpi_month', 'Api\KPIInfoController');
    Route::apiResource('kpi_daily', 'Api\KPIDailyController');
    Route::apiResource('overseer', 'Api\OverseerController');
    Route::apiResource('client', 'Api\ClientController');
    Route::apiResource('feedback', 'Api\FeedbackController');



    Route::get('getEnum/{table}/{field}', "Api\Helpers@getEnum");
    Route::get('getColumnName/{table}', "Api\Helpers@getColumnName");
    Route::get('loggedUser', 'Api\Helpers@getUser');
});
