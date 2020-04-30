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









// -----------------------------------------------
// ------------------ NASABAH ----------------------
// -----------------------------------------------

$this->middleware(['role:Mahasiswa','auth'], ['only' => [
            'mendaftar'
        ]]);

//TransaksiSampah
Route::group(['prefix' => 'transaksi/sampah'], function()
{
    Route::get('/saya', 'TransaksiSampahController@tampilPerNasabah')->name('transaksiSampahPerNasabah')->middleware(['role:Nasabah','auth']);
    Route::get('/saya/create', 'TransaksiSampahController@createByNasabah')->name('createTransaksiSampahByNasabah')->middleware(['role:Nasabah','auth']);
    Route::put('/saya', 'TransaksiSampahController@storeByNasabah')->name('transaksiSampahByNasabah.store')->middleware(['role:Nasabah','auth']);

});

//TransaksiReward
Route::group(['prefix' => 'transaksi/reward'], function() {
    Route::get('/saya', 'TransaksiRewardController@tampilPerNasabah')->name('transaksiRewardPerNasabah')->middleware(['role:Nasabah','auth']);
    Route::get('/saya/create', 'TransaksiRewardController@createByNasabah')->name('transaksiRewardByNasabah.create')->middleware(['role:Nasabah','auth']);
    Route::put('/saya', 'TransaksiRewardController@storeByNasabah')->name('transaksiRewardByNasabah.store')->middleware(['role:Nasabah','auth']);
});












// -----------------------------------------------
// ------------------ ADMIN ----------------------
// -----------------------------------------------

//User
Route::group(['prefix' => 'user'], function() {
    Route::get('/', 'UserController@index')->name('user')->middleware(['role:Admin|Member','auth']);
    Route::get('/create/{id}', 'UserController@create')->name('user.create')->middleware(['role:Admin|Member','auth']);
    Route::put('/', 'UserController@store')->name('user.store')->middleware(['role:Admin|Member','auth']);

    // Route::get('/nasabah/create', 'UserController@createNasabah')->name('user.createNasabah');
    // Route::put('/nasabah', 'UserController@storeNasabah')->name('user.storeNasabah');


    Route::delete('/delete/{id}', 'UserController@destroy')->name('user.destroy')->middleware(['role:Admin|Member','auth']);

    Route::get('/{id}/edit', 'UserController@edit')->name('user.edit')->middleware(['role:Admin|Member','auth']);
    Route::put('/{id}', 'UserController@update')->name('user.update')->middleware(['role:Admin|Member','auth']);
});


//Sampah
Route::group(['prefix' => 'sampah'], function() {
    Route::get('/', 'SampahController@index')->name('sampah')->middleware(['role:Admin|Member','auth']);
    // Route::get('/search', 'SampahController@search')->name('sampah.search');
    Route::get('/create', 'SampahController@create')->name('sampah.create')->middleware(['role:Member','auth']);
    // Route::get('/{id}', 'SampahController@show')->name('sampah.show');
    Route::put('/', 'SampahController@store')->name('sampah.store')->middleware(['role:Member','auth']);
    Route::delete('/delete/{id}', 'SampahController@destroy')->name('sampah.destroy')->middleware(['role:Admin|Member','auth']);

    Route::get('/{id}/edit', 'SampahController@edit')->name('sampah.edit')->middleware(['role:Admin|Member','auth']);
    Route::put('/{id}', 'SampahController@update')->name('sampah.update')->middleware(['role:Admin|Member','auth']);
});


//Reward
Route::group(['prefix' => 'reward'], function() {
    Route::get('/', 'RewardController@index')->name('reward')->middleware(['role:Admin|Member','auth']);
    // Route::get('/search', 'RewardController@search')->name('reward.search');
    Route::get('/create', 'RewardController@create')->name('reward.create')->middleware(['role:Member','auth']);
    // Route::get('/{id}', 'RewardController@show')->name('reward.show');
    Route::put('/', 'RewardController@store')->name('reward.store')->middleware(['role:Member','auth']);
    Route::delete('/delete/{id}', 'RewardController@destroy')->name('reward.destroy')->middleware(['role:Admin|Member','auth']);

    Route::get('/{id}/edit', 'RewardController@edit')->name('reward.edit')->middleware(['role:Admin|Member','auth']);
    Route::put('/{id}', 'RewardController@update')->name('reward.update')->middleware(['role:Admin|Member','auth']);
});


//TransaksiSampah
Route::group(['prefix' => 'transaksi/sampah'], function() {
    Route::get('/', 'TransaksiSampahController@index')->name('transaksiSampah')->middleware(['role:Admin|Member','auth']);
    // Route::get('/search', 'TransaksiSampahController@search')->name('transaksiSampah.search');
    Route::get('/create', 'TransaksiSampahController@create')->name('transaksiSampah.create')->middleware(['role:Member','auth']);
    // Route::get('/{id}', 'TransaksiSampahController@show')->name('transaksiSampah.show');
    Route::put('/', 'TransaksiSampahController@store')->name('transaksiSampah.store')->middleware(['role:Member','auth']);
    Route::delete('/delete/{id}', 'TransaksiSampahController@destroy')->name('transaksiSampah.destroy')->middleware(['role:Admin|Member|Nasabah','auth']);
    Route::put('/validasi', 'TransaksiSampahController@validasi')->name('transaksiSampah.validasi')->middleware(['role:Admin|Member','auth']);

    Route::get('/{id}/edit', 'TransaksiSampahController@edit')->name('transaksiSampah.edit')->middleware(['role:Admin|Member','auth']);
    Route::put('/{id}', 'TransaksiSampahController@update')->name('transaksiSampah.update')->middleware(['role:Admin|Member','auth']);
});


//TransaksiReward
Route::group(['prefix' => 'transaksi/reward'], function() {
    Route::get('/', 'TransaksiRewardController@index')->name('transaksiReward')->middleware(['role:Admin|Member','auth']);
    // Route::get('/search', 'TransaksiRewardController@search')->name('transaksiReward.search');
    Route::get('/create', 'TransaksiRewardController@create')->name('transaksiReward.create')->middleware(['role:Member','auth']);
    // Route::get('/{id}', 'TransaksiRewardController@show')->name('transaksiReward.show');
    Route::put('/', 'TransaksiRewardController@store')->name('transaksiReward.store')->middleware(['role:Member','auth']);
    Route::delete('/delete/{id}', 'TransaksiRewardController@destroy')->name('transaksiReward.destroy')->middleware(['role:Admin|Member|Nasabah','auth']);
    Route::put('/validasi', 'TransaksiRewardController@validasi')->name('transaksiReward.validasi')->middleware(['role:Admin|Member','auth']);

    Route::get('/{id}/edit', 'TransaksiRewardController@edit')->name('transaksiReward.edit')->middleware(['role:Admin|Member','auth']);
    Route::put('/{id}', 'TransaksiRewardController@update')->name('transaksiReward.update')->middleware(['role:Admin|Member','auth']);
});