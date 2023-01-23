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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth','pemohonRole'])->group(function(){
    Route::resource('jualbeli','AkteJualBeliController', ['only' => 'destroy']);
    Route::resource('perseroancommanditer','PerseroanCommanditerController', ['only' => 'destroy']);
    Route::resource('perseroanterbatas','PerseroanTerbatasController', ['only' => 'destroy']);
    // Route::middleware('role:pemohon')->group(function() {
        Route::resource('jualbeli','AkteJualBeliController');
        Route::resource('perseroancommanditer','PerseroanCommanditerController');
        Route::resource('perseroanterbatas','PerseroanTerbatasController');
    // });
});

Route::middleware(['auth','adminRole'])->group(function(){
    Route::resource('admin/jualbeli','AkteJualBeliController', ['only' => 'destroy']);
    Route::resource('admin/perseroancommanditer','PerseroanCommanditerController', ['only' => 'destroy']);
    Route::resource('admin/perseroanterbatas','PerseroanTerbatasController', ['only' => 'destroy']);
    Route::resource('user','UserController');
    Route::get('/admin/data-pesanan/jualbeli', 'DataPesananAkta@jualbeli')->name('datapesanan.jualbeli');
    Route::get('/admin/data-pesanan/komanditer', 'DataPesananAkta@komanditer')->name('datapesanan.komanditer');
    Route::get('/admin/data-pesanan/terbatas', 'DataPesananAkta@terbatas')->name('datapesanan.terbatas');
    Route::get('/admin/data-pesanan/cetak/{id}/{idPesanan}', 'PDFController@generatePDF')->name('datapesanan.cetak');

    Route::POST('/admin/data-pesanan/jual-beli/{id}', 'AkteJualBeliController@ubahStatus')->name('datapesanan.jualbeli.ubah-status');
    Route::POST('/admin/data-pesanan/terbatas/{id}', 'PerseroanTerbatasController@ubahStatus')->name('datapesanan.terbatas.ubah-status');
    Route::POST('/admin/data-pesanan/komanditer/{id}', 'PerseroanCommanditerController@ubahStatus')->name('datapesanan.komanditer.ubah-status');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('daftar-pemohon', function () {
    return view('auth.register_pemohon');
});
Route::post('daftar-pemohon', 'Auth\RegisterController@registerPemohon')->name('daftar-pemohon');

//route encrypt
Route::get('/persero/decyprt/{id}/{status}','PerseroRSA@decrypt', ['only' => 'destroy'])->name('rsa.persero.command.decyprt');
Route::get('/persero/encrypt/{id}/{status}','PerseroRSA@encrypt', ['only' => 'destroy'])->name('rsa.persero.command.encrpty');

Route::get('/jual/decyprt/{id}','JualBeliRSA@decrypt', ['only' => 'destroy'])->name('rsa.jual.command.decyprt');
Route::get('/jual/encrypt/{id}','JualBeliRSA@encrypt', ['only' => 'destroy'])->name('rsa.jual.command.encrpty');

//cetak
// Route::get('/perseroanterbatas/cetak/pdf', 'PerseroanTerbatasController@cetak')->middleware('auth')->name('perseroanterbatas.cetak');
// Route::get('/perseroancommanditer/cetak/pdf', 'PerseroanCommanditerController@cetak')->middleware('auth')->name('perseroancommanditer.cetak');
// Route::get('/jualbeli/cetak/pdf', 'AkteJualBeli@cetak')->middleware('auth')->name('aktejualbeli.cetak');

Route::get('/admin/data-pesanan/jualbeli/cetak/pdf', 'DataPesananAkta@cetakJualBeli')->middleware('auth')->name('jualbeli.cetak');
Route::get('/admin/data-pesanan/komoditer/cetak/pdf', 'DataPesananAkta@cetakCommanditer')->middleware('auth')->name('komoditer.cetak');
Route::get('/admin/data-pesanan/terbatas/cetak/pdf', 'DataPesananAkta@cetakTerbatas')->middleware('auth')->name('terbatas.cetak');
