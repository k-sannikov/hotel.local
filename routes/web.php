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

Route::redirect('/', '/orders');

Auth::routes(['register' => false]);

//Группа данных для модуля заказы
$orders = [
    'namespace' => 'Hotel\Admin\Order',
    'middleware' => ['auth', 'can:user,admin'],
];

//Группа маршрутов для пользователя admin и user
Route::group($orders, function () {
    Route::get('/orders', 'OrderController@index')->name('orders.index');
    Route::get('/orders/create', 'OrderController@create')->name('orders.create');
    Route::post('/orders', 'OrderController@store')->name('orders.store');
    // Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
    Route::get('/orders/{order}/edit', 'OrderController@edit')->name('orders.edit');
    Route::match(['put', 'patch'], '/orders/{order}', 'OrderController@update')->name('orders.update');
    Route::delete('/orders/{order}', 'OrderController@destroy')->name('orders.destroy');
});

//Группа данных для настроек
$settings = [
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Hotel\Admin\Settings',
    'middleware' => ['auth', 'can:admin'],
];

//Группа маршрутов для модуля настроек
Route::group($settings, function () {
    Route::get('/settings', 'SettingsController@index')
        ->name('settings.index');

    Route::post('/settings', 'SettingsController@store')
        ->name('settings.store');

    Route::get('/settings/{setting}/edit', 'SettingsController@edit')
        ->name('settings.edit');

    Route::match(['put', 'patch'], '/settings/{setting}', 'SettingsController@update')
        ->name('settings.update');

    Route::delete('/settings/{setting}', 'SettingsController@destroy')
        ->name('settings.destroy');


    Route::post('/settings/user', 'UserSettingsController@store')
        ->name('settings.user.store');

    Route::get('/settings/user/{user}/edit', 'UserSettingsController@edit')
        ->name('settings.user.edit');

    Route::match(['put', 'patch'], '/settings/user/{user}', 'UserSettingsController@update')
        ->name('settings.user.update');

    Route::delete('/settings/user/{user}', 'UserSettingsController@destroy')
        ->name('settings.user.destroy');
});

//Группа данных для настроек
$report = [
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Hotel\Admin\Report',
    'middleware' => ['auth', 'can:admin'],
];

//Группа маршрутов для модуля отчетов
Route::group($report, function () {
    Route::get('/report', 'ReportController@index')->name('report.index');
    Route::post('/report', 'ReportController@generate')->name('report.generate');
});
