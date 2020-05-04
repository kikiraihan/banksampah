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

// Route::get('/login', 'HomeController@login_page')->name('login_page');

Route::get('/home', 'HomeController@index')->name('home');


//FPDF
Route::get('/cetak/nasabahpertransaksi',  'pdfController@nasabahTrans')->name('nasabahTrans');

//WilayahGet
Route::POST('/wilayah/get/{jenis}',  'WilayahIndonesiaController@getWilayah')->name('getWilayah');









// -----------------------------------------------
// ------------------ NASABAH ----------------------
// -----------------------------------------------

// $this->middleware(['role:Mahasiswa','auth'], ['only' => [
//             'mendaftar'
//         ]]);

//TransaksiSampah
Route::group(['prefix' => 'transaksi/sampah/saya'], function()
{
    Route::get('/', 'TransaksiSampahController@tampilPerNasabah')->name('transaksiSampahPerNasabah')->middleware(['role:Nasabah','auth']);
    Route::get('/create', 'TransaksiSampahController@createByNasabah')->name('createTransaksiSampahByNasabah')->middleware(['role:Nasabah','auth']);
    Route::put('/', 'TransaksiSampahController@storeByNasabah')->name('transaksiSampahByNasabah.store')->middleware(['role:Nasabah','auth']);

});

//TransaksiReward
Route::group(['prefix' => 'transaksi/reward/saya'], function() {
    Route::get('/', 'TransaksiRewardController@tampilPerNasabah')->name('transaksiRewardPerNasabah')->middleware(['role:Nasabah','auth']);
    Route::get('/create', 'TransaksiRewardController@createByNasabah')->name('transaksiRewardByNasabah.create')->middleware(['role:Nasabah','auth']);
    Route::put('/', 'TransaksiRewardController@storeByNasabah')->name('transaksiRewardByNasabah.store')->middleware(['role:Nasabah','auth']);
});












// -----------------------------------------------
// ------------------ ADMIN ----------------------
// -----------------------------------------------

//User
Route::group(['prefix' => 'user'], function() {
    Route::get('/', 'UserController@index')->name('user')->middleware(['role:Admin','auth']);
    Route::get('/create/{id}', 'UserController@create')->name('user.create')->middleware(['role:Admin','auth']);
    Route::put('/', 'UserController@store')->name('user.store')->middleware(['role:Admin','auth']);

    // Route::get('/nasabah/create', 'UserController@createNasabah')->name('user.createNasabah');
    // Route::put('/nasabah', 'UserController@storeNasabah')->name('user.storeNasabah');


    Route::delete('/delete/{id}', 'UserController@destroy')->name('user.destroy')->middleware(['role:Admin','auth']);

    Route::get('/{id}/edit', 'UserController@edit')->name('user.edit')->middleware(['role:Admin','auth']);
    Route::put('/{id}', 'UserController@update')->name('user.update')->middleware(['role:Admin','auth']);
});


//Sampah
Route::group(['prefix' => 'sampah'], function() {
    Route::get('/', 'SampahController@index')->name('sampah')->middleware(['role:Admin|Pengepul','auth']);
    // Route::get('/search', 'SampahController@search')->name('sampah.search');
    Route::get('/create', 'SampahController@create')->name('sampah.create')->middleware(['role:Pengepul','auth']);
    // Route::get('/{id}', 'SampahController@show')->name('sampah.show');
    Route::put('/', 'SampahController@store')->name('sampah.store')->middleware(['role:Pengepul','auth']);
    Route::delete('/delete/{id}', 'SampahController@destroy')->name('sampah.destroy')->middleware(['role:Admin|Pengepul','auth']);

    Route::get('/{id}/edit', 'SampahController@edit')->name('sampah.edit')->middleware(['role:Admin|Pengepul','auth']);
    Route::put('/{id}', 'SampahController@update')->name('sampah.update')->middleware(['role:Admin|Pengepul','auth']);
});


//Reward
Route::group(['prefix' => 'reward'], function() {
    Route::get('/', 'RewardController@index')->name('reward')->middleware(['role:Admin|Challengger','auth']);
    // Route::get('/search', 'RewardController@search')->name('reward.search');
    Route::get('/create', 'RewardController@create')->name('reward.create')->middleware(['role:Pengepul','auth']);
    // Route::get('/{id}', 'RewardController@show')->name('reward.show');
    Route::put('/', 'RewardController@store')->name('reward.store')->middleware(['role:Challengger','auth']);
    Route::delete('/delete/{id}', 'RewardController@destroy')->name('reward.destroy')->middleware(['role:Admin|Challengger','auth']);

    Route::get('/{id}/edit', 'RewardController@edit')->name('reward.edit')->middleware(['role:Admin|Challengger','auth']);
    Route::put('/{id}', 'RewardController@update')->name('reward.update')->middleware(['role:Admin|Challengger','auth']);
});


//TransaksiSampah
Route::group(['prefix' => 'transaksi/sampah'], function() {
    Route::get('/', 'TransaksiSampahController@index')->name('transaksiSampah')->middleware(['role:Admin|Pengepul','auth']);
    // Route::get('/search', 'TransaksiSampahController@search')->name('transaksiSampah.search');
    Route::get('/create', 'TransaksiSampahController@create')->name('transaksiSampah.create')->middleware(['role:Pengepul','auth']);
    // Route::get('/{id}', 'TransaksiSampahController@show')->name('transaksiSampah.show');
    Route::put('/', 'TransaksiSampahController@store')->name('transaksiSampah.store')->middleware(['role:Pengepul','auth']);
    Route::delete('/delete/{id}', 'TransaksiSampahController@destroy')->name('transaksiSampah.destroy')->middleware(['role:Admin|Pengepul|Nasabah','auth']);
    Route::put('/validasi', 'TransaksiSampahController@validasi')->name('transaksiSampah.validasi')->middleware(['role:Nasabah|Pengepul','auth']);
    // Route::put('/validasi/batal', 'TransaksiSampahController@validasiBatal')->name('transaksiSampah.validasi.batal')->middleware(['role:Nasabah|Pengepul','auth']);

    Route::get('/{id}/edit', 'TransaksiSampahController@edit')->name('transaksiSampah.edit')->middleware(['role:Admin|Pengepul','auth']);
    Route::put('/{id}', 'TransaksiSampahController@update')->name('transaksiSampah.update')->middleware(['role:Admin|Pengepul','auth']);
});


//TransaksiReward
Route::group(['prefix' => 'transaksi/reward'], function() {
    Route::get('/', 'TransaksiRewardController@index')->name('transaksiReward')->middleware(['role:Admin|Challengger','auth']);
    // Route::get('/search', 'TransaksiRewardController@search')->name('transaksiReward.search');
    Route::get('/create', 'TransaksiRewardController@create')->name('transaksiReward.create')->middleware(['role:Challengger','auth']);
    // Route::get('/{id}', 'TransaksiRewardController@show')->name('transaksiReward.show');
    Route::put('/', 'TransaksiRewardController@store')->name('transaksiReward.store')->middleware(['role:Challengger','auth']);
    Route::delete('/delete/{id}', 'TransaksiRewardController@destroy')->name('transaksiReward.destroy')->middleware(['role:Admin|Challengger|Nasabah','auth']);
    Route::put('/validasi', 'TransaksiRewardController@validasi')->name('transaksiReward.validasi')->middleware(['role:Admin|Challengger','auth']);

    Route::get('/{id}/edit', 'TransaksiRewardController@edit')->name('transaksiReward.edit')->middleware(['role:Admin|Challengger','auth']);
    Route::put('/{id}', 'TransaksiRewardController@update')->name('transaksiReward.update')->middleware(['role:Admin|Challengger','auth']);
});