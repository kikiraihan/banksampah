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



//-----------------------------------------------
//------------- LANDING PAGE --------------------
//-----------------------------------------------
Route::get('/',  'LandingPageController@index')->name('landing_page');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//FPDF
Route::get('/cetak/nasabahpertransaksi',  'pdfController@nasabahTrans')->name('nasabahTrans');









// -----------------------------------------------
// ------------------ NASABAH ----------------------
// -----------------------------------------------

//TransaksiSampah
Route::group(['prefix' => 'transaksi/sampah'], function()
{
    Route::get('/saya', 'TransaksiSampahController@tampilPerNasabah')->name('transaksiSampahPerNasabah');
});

//TransaksiReward
Route::group(['prefix' => 'transaksi/reward'], function() {
    Route::get('/saya', 'TransaksiRewardController@tampilPerNasabah')->name('transaksiRewardPerNasabah');
});












// -----------------------------------------------
// ------------------ ADMIN ----------------------
// -----------------------------------------------

//User
Route::group(['prefix' => 'user'], function() {
    Route::get('/', 'UserController@index')->name('user');
    Route::get('/create/{id}', 'UserController@create')->name('user.create');
    Route::put('/', 'UserController@store')->name('user.store');

    // Route::get('/nasabah/create', 'UserController@createNasabah')->name('user.createNasabah');
    // Route::put('/nasabah', 'UserController@storeNasabah')->name('user.storeNasabah');


    Route::delete('/delete/{id}', 'UserController@destroy')->name('user.destroy');

    Route::get('/{id}/edit', 'UserController@edit')->name('user.edit');
    Route::put('/{id}', 'UserController@update')->name('user.update');
});


//Sampah
Route::group(['prefix' => 'sampah'], function() {
    Route::get('/', 'SampahController@index')->name('sampah');
    // Route::get('/search', 'SampahController@search')->name('sampah.search');
    Route::get('/create', 'SampahController@create')->name('sampah.create');
    // Route::get('/{id}', 'SampahController@show')->name('sampah.show');
    Route::put('/', 'SampahController@store')->name('sampah.store');
    Route::delete('/delete/{id}', 'SampahController@destroy')->name('sampah.destroy');

    Route::get('/{id}/edit', 'SampahController@edit')->name('sampah.edit');
    Route::put('/{id}', 'SampahController@update')->name('sampah.update');
});


//Reward
Route::group(['prefix' => 'reward'], function() {
    Route::get('/', 'RewardController@index')->name('reward');
    // Route::get('/search', 'RewardController@search')->name('reward.search');
    Route::get('/create', 'RewardController@create')->name('reward.create');
    // Route::get('/{id}', 'RewardController@show')->name('reward.show');
    Route::put('/', 'RewardController@store')->name('reward.store');
    Route::delete('/delete/{id}', 'RewardController@destroy')->name('reward.destroy');

    Route::get('/{id}/edit', 'RewardController@edit')->name('reward.edit');
    Route::put('/{id}', 'RewardController@update')->name('reward.update');
});


//TransaksiSampah
Route::group(['prefix' => 'transaksi/sampah'], function() {
    Route::get('/', 'TransaksiSampahController@index')->name('transaksiSampah');
    // Route::get('/search', 'TransaksiSampahController@search')->name('transaksiSampah.search');
    Route::get('/create', 'TransaksiSampahController@create')->name('transaksiSampah.create');
    // Route::get('/{id}', 'TransaksiSampahController@show')->name('transaksiSampah.show');
    Route::put('/', 'TransaksiSampahController@store')->name('transaksiSampah.store');
    Route::delete('/delete/{id}', 'TransaksiSampahController@destroy')->name('transaksiSampah.destroy');

    Route::get('/{id}/edit', 'TransaksiSampahController@edit')->name('transaksiSampah.edit');
    Route::put('/{id}', 'TransaksiSampahController@update')->name('transaksiSampah.update');
});


//TransaksiReward
Route::group(['prefix' => 'transaksi/reward'], function() {
    Route::get('/', 'TransaksiRewardController@index')->name('transaksiReward');
    // Route::get('/search', 'TransaksiRewardController@search')->name('transaksiReward.search');
    Route::get('/create', 'TransaksiRewardController@create')->name('transaksiReward.create');
    // Route::get('/{id}', 'TransaksiRewardController@show')->name('transaksiReward.show');
    Route::put('/', 'TransaksiRewardController@store')->name('transaksiReward.store');
    Route::delete('/delete/{id}', 'TransaksiRewardController@destroy')->name('transaksiReward.destroy');

    Route::get('/{id}/edit', 'TransaksiRewardController@edit')->name('transaksiReward.edit');
    Route::put('/{id}', 'TransaksiRewardController@update')->name('transaksiReward.update');
});