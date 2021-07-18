<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', 'App\Http\Controllers\CalendarController@show');
//祝日設定
Route::get('/holiday_setting', 'App\Http\Controllers\Calendar\HolidaySettingController@form')
    ->name("holiday_setting");
Route::get('/holiday_setting/edit', 'App\Http\Controllers\Calendar\HolidaySettingController@edit')
    ->name("edit_holiday_setting");
Route::post('/holiday_setting', 'App\Http\Controllers\Calendar\HolidaySettingController@update')
    ->name("update_holiday_setting");
//臨時営業設定
Route::get('/extra_holiday_setting', 'App\Http\Controllers\Calendar\ExtraHolidaySettingController@form')
    ->name("extra_holiday_setting");

Route::get('/extra_holiday_setting/edit/{date_key}', 'App\Http\Controllers\Calendar\ExtraHolidaySettingController@edit')
    ->name("edit_extra_holiday_setting");

Route::get('/extra_holiday_setting/delete/{id}', 'App\Http\Controllers\Calendar\ExtraHolidaySettingController@delete')
    ->name("edit_extra_holiday_delete");

Route::post('/extra_holiday_setting','App\Http\Controllers\Calendar\ExtraHolidaySettingController@update')
    ->name("update_extra_holiday_setting");

Route::post('/ajax_holiday_setting','App\Http\Controllers\CalendarController@ajax')
    ->name("ajax_extra_holiday_setting");

Route::post('/schedule_setting','App\Http\Controllers\Calendar\ExtraHolidaySettingController@schedule_store')
    ->name("schedule_setting");

Route::post('/schedule_update','App\Http\Controllers\Calendar\ExtraHolidaySettingController@schedule_update')
    ->name("schedule_update");


Route::post('/schedule_delete/','App\Http\Controllers\Calendar\ExtraHolidaySettingController@schedule_delete')
    ->name("schedule_delete");

Route::post('/ajax_delete/','App\Http\Controllers\CalendarController@ajax_delete')
    ->name("ajax_delete");

Route::post('/ajax_store/','App\Http\Controllers\CalendarController@ajax_store')
    ->name("ajax_store");

Route::post('/ajax_update/','App\Http\Controllers\CalendarController@ajax_update')
    ->name("ajax_update");

Route::post('/ajax_cancel/','App\Http\Controllers\CalendarController@ajax_cancel')
        ->name("ajax_cancel");
