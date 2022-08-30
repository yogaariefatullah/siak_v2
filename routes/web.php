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
    // return view('template.front.index');
    return view('template.landing_page.index');
    // $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    // dd($hostname);
})->name('/');

Route::get('/cek_email', 'UtilsController@cek_email')->name('cek_email');
Route::get('/cek_modi', 'UtilsController@cek_modi')->name('cek_modi');


Auth::routes();
Route::namespace('Auth')->group(function () {
    // Controllers Within The "App\Http\Controllers\Auth" Namespace
    Route::get('/login', 'LoginController@getLogin')->middleware('guest');
    Route::post('/login', 'LoginController@postLogin')->name('login');
    Route::post('/logout', 'LoginController@logout')->name('logout');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('laporan_lhv_uuid/{id}/{no}/{kategori}/{id_pembeli}', 'PreviewController@hasil_scan_versi2');
Route::get('laporan_lhv/{id}/{no}/{kategori}/{id_pembeli}', 'PreviewController@hasil_scan_lama');
Route::get('laporan_lhv_mn/{id}/{no}/{kategori}/{id_pembeli}', 'PreviewController@hasil_scan_mn');
Route::get('laporan_lhv_vessel/{id}/{volume}', 'PreviewController@hasil_scan_vessel');
Route::get('laporan_lhv_mvp/{id}', 'PreviewController@laporan_lhv_mvp');

Route::get('laporan-lhv/{id_pemasaran}/{tmp_id_detail}', 'PreviewController@hasil_scan_v2');
Route::get('laporan-lhv-vessel/{id}/{volume}', 'PreviewController@hasil_scan_2');
Route::get('laporan-lhv/{id}/{no}/{kategori}/{id_pembeli}', 'PreviewController@hasil_scan_versi2');

Route::get('base64/{id}', 'PreviewController@base64');

Route::group(['namespace' => 'Surveyor', 'prefix' => 'surveyors'], function () {
    Route::name('surveyors.')->middleware('auth:surveyors')->group(function () {

        // Route::group(['prefix' => 'verifikasi', 'as' => 'verifikasi.'], function () {
        //     Route::group(['prefix' => 'produksi', 'as' => 'produksi.'], function () {
        //         Route::get('/', 'VerifikatorProduksiController@index')->name('index');
        //     });
        //     Route::group(['prefix' => 'pkp2b', 'as' => 'pkp2b.'], function () {
        //         Route::get('/', 'VerifikatorProduksiController@index')->name('index');
        //     });
        // });

        Route::get('/dashboard', 'HomeController@index')->name('dashboard.surveyors');
        Route::get('/dashboard-Perusahaan', 'HomeController@index_perusahaan')->name('dashboard');
        Route::get('/Petugas-verifikator', 'PerusahaanSurveyorController@index')->name('petugas.index');
        Route::get('/add-verifikator', 'PerusahaanSurveyorController@add_petugas')->name('petugas.add');
        Route::get('/edit-verifikator', 'PerusahaanSurveyorController@edit')->name('petugas.edit');
        Route::get('/detail-verifikator', 'PerusahaanSurveyorController@detail')->name('petugas.detail');
        Route::get('/data-verifikator', 'PerusahaanSurveyorController@data_petugas')->name('petugas.data_petugas');

        Route::post('/store/post-verifikator', 'PerusahaanSurveyorController@post_petugas')->name('petugas.store');
        Route::post('/update/post-verifikator', 'PerusahaanSurveyorController@post_petugas')->name('petugas.update');

        Route::get('profile-perusahaan', 'PerusahaanSurveyorController@index_profile')->name('profile');
        Route::post('update-profile', 'PerusahaanSurveyorController@updateProfile')->name('updateProfile');

        //Verifikator Perusahaan
        Route::get('/surveyor-muat-stockpile', 'PerusahaanSurveyorController@index_isp')->name('index_isp');
        Route::get('/surveyor-muat-trader', 'PerusahaanSurveyorController@index_trader')->name('index_trader');
        Route::get('/surveyor-muat-batubara', 'PerusahaanSurveyorController@index_muat_bb')->name('index_muat_bb');
        Route::get('/surveyor-titik-serah-batubara', 'PerusahaanSurveyorController@index_tiser_bb')->name('index_tiser_bb');
        Route::get('/surveyor-muat-mineral', 'PerusahaanSurveyorController@index_muat_mn')->name('index_muat_mn');
        Route::get('/surveyor-titik-serah-mineral', 'PerusahaanSurveyorController@index_tiser_mn')->name('index_tiser_mn');

        //BATUBARA
        Route::get('/data-muat-bb', 'DatatableController@list_pemasaran_bb_muat_data')->name('muat.batubara_data');
        Route::get('/data-titik-serah-bb', 'DatatableController@list_pemasaran_bb_tiser_data')->name('tiser.batubara_data');

        // MINERAL
        Route::get('/data-muat-mn', 'DatatableController@list_pemasaran_mn_muat_data')->name('muat.mineral_data');
        Route::get('/data-titik-serah-mn', 'DatatableController@list_pemasaran_mn_tiser_data')->name('tiser.mineral_data');

        //ISP dan TRADER
        Route::get('/data-isp', 'DatatableController@list_pemasaran_bb_stockpile_data')->name('isp_data');
        Route::get('/data-trader', 'DatatableController@list_pemasaran_bb_trader_data')->name('trader_data');

        //Modal
        Route::get('surveyor-muat/batubara/detail_pemasaran', 'SurveyorController@detail_muat_moms')->name('detail_modal_moms');
        Route::get('surveyor-titik-serah/batubara/detail_pemasaran_trader', 'SurveyorController@detail_modal_trader')->name('detail_modal_trader');
        Route::get('surveyor-muat/mineral/detail_pemasaran', 'SurveyorController@detail_muat_moms_mn')->name('detail_muat_moms_mn');

        // Petugas Verifikator
        Route::get('/verifikator-muat-stockpile', 'VerifikatorController@index_isp')->name('petugas.index_isp');
        Route::get('/verifikator-muat-trader', 'VerifikatorController@index_trader')->name('petugas.index_trader');
        Route::get('/verifikator-muat-batubara', 'VerifikatorController@index_muat_bb')->name('petugas.index_muat_bb');
        Route::get('/verifikator-titik-serah-batubara', 'VerifikatorController@index_tiser_bb')->name('petugas.index_tiser_bb');
        Route::get('/verifikator-muat-mineral', 'VerifikatorController@index_muat_mn')->name('petugas.index_muat_mn');
        Route::get('/verifikator-titik-serah-mineral', 'VerifikatorController@index_tiser_mn')->name('petugas.index_tiser_mn');

        Route::get('/verifikator-produksi-batubara', 'VerifikatorController@index_produksi_bb')->name('petugas.index_produksi_bb');
        Route::get('/verifikator-produksi-mineral', 'VerifikatorController@index_produksi_mn')->name('petugas.index_produksi_mn');

        Route::get('/data-verifikator-trader', 'DatatableController@list_verifikator_pemasaran_bb_trader_data')->name('verifikator.trader_data');
        Route::get('/data-verifikator-muat-bb', 'DatatableController@list_verifikator_pemasaran_bb_muat_data')->name('verifikator.muat.bb');
        Route::get('/data-verifikator-muat-bb/selesai', 'DatatableController@list_verifikator_pemasaran_bb_muat_data_selesai')->name('verifikator.muat.bb.final');
        Route::get('/data-verifikator-tiser-bb', 'DatatableController@list_verifikator_pemasaran_bb_tiser_data')->name('verifikator.tiser.bb');

        Route::get('/data-verifikator-muat-mn', 'DatatableController@list_verifikator_pemasaran_mn_muat_data')->name('verifikator.muat.mn');
        Route::get('/data-verifikator-muat-mn/selesai', 'DatatableController@list_verifikator_pemasaran_mn_muat_data_final')->name('verifikator.muat.mn.final');

        Route::get('/data-verifikator-produksi-bb', 'DatatableController@list_pemasaran_bb_produksi_data')->name('verifikator.bb_produksi');
        Route::get('/data-verifikator-produksi-mn', 'DatatableController@list_pemasaran_mn_produksi_data')->name('verifikator.mn_produksi');

        //Utilities
        Route::get('/data-dokumen', 'VerifikatorController@verif_dokumen')->name('verifikator.verif_dokumen');
        Route::post('/reject', 'VerifikatorController@reject_dokumen')->name('dokumen.bb.reject');
        Route::post('/accepted', 'VerifikatorController@verifikasi_dokumen')->name('dokumen.bb.accept');

        Route::get('/data-tongkang/{id}', 'VerifikatorController@verif_tongkang')->name('verifikasi.tongkang.page');
        Route::get('/verifikasi-tongkang', 'VerifikatorController@verif_per_tongkang')->name('verifikator.verifikasi_data_tongkang');
        Route::post('/tongkang/verifikasi', 'VerifikatorController@accepted_tongkang')->name('tongkang.bb.accept');

        Route::get('/data-tongkang-trader/{id}', 'VerifikatorController@verif_tongkang_trader')->name('verifikasi.tongkang.page.trader');
        Route::get('/verifikasi-trader', 'VerifikatorController@verif_pemasaran_trader')->name('verifikator.verif_pemasaran_trader');
        Route::post('/tongkang/verifikasi/trader', 'VerifikatorController@accepted_pemasaran_trader')->name('trader.accept');
        Route::post('/tongkang/reject/trader', 'VerifikatorController@reject_pemasaran_trader')->name('trader.reject');

        Route::get('/data-tongkang-isp/{id}', 'VerifikatorController@verif_tongkang_isp')->name('verifikasi.tongkang.page.isp');

        Route::post('/data-produksi', 'VerifikatorController@data_produksi')->name('data_produksi');
        Route::post('/verif_produksi_bb', 'VerifikatorController@verif_produksi_bb')->name('verif_produksi_bb');
        Route::post('/reject_produksi_bb/{id_pemasaran}', 'VerifikatorController@reject_produksi_bb')->name('reject_produksi_bb');

        Route::post('/data-produksi-mn', 'VerifikatorController@data_produksi_mn')->name('data_produksi_mn');
        Route::post('/verif_produksi_mn', 'VerifikatorController@verif_produksi_mn')->name('verif_produksi_mn');
        Route::post('/reject_produksi_mn/{id_pemasaran}', 'VerifikatorController@reject_produksi_mn')->name('reject_produksi_mn');

        //mineral

        Route::get('/data-dokumen-mineral', 'VerifikatorController@verif_dokumen_mn')->name('verifikator.verif_dokumen_mn');
        Route::post('/reject-mn', 'VerifikatorController@reject_dokumen_mn')->name('dokumen.mn.reject');
        Route::post('/accepted-mn', 'VerifikatorController@verifikasi_dokumen_mn')->name('dokumen.mn.accept');
        Route::post('/accepted-mn/buktibayar', 'VerifikatorController@verifikasi_buktibayar_mn')->name('buktibayar.mn.accept');

        Route::get('/data-tongkang/{id}/mineral', 'VerifikatorController@verif_tongkang_mn')->name('verifikasi.tongkang.page.mn');
        Route::get('/verifikasi-tongkang/mineral', 'VerifikatorController@verif_per_tongkang_mn')->name('verifikator.verifikasi_data_tongkang.mn');
        Route::post('/tongkang/verifikasi/mineral', 'VerifikatorController@accepted_tongkang_mn')->name('tongkang.mn.accept');


        //CETAK & PREVIEW
        Route::get('/lhv-tongkang/{id}', 'CetakController@cetak_lhv')->name('verifikator.print_lhv_tongkang_bb');
        Route::get('/preview', 'CetakController@preview_modal')->name('preview.modal');


        Route::get('/preview-opk', 'CetakController@preview_trader')->name('preview_trader.modal');

        //MINERAL
        Route::get('/lhv-tongkang/{id}/mineral', 'CetakController@cetak_lhv_mn')->name('verifikator.print_lhv_tongkang_mn');
        Route::get('/preview/mineral/', 'CetakController@preview_modal_mn')->name('preview.modal.mn');

        Route::get('/lhv-iup-opk/{id}/trader', 'CetakController@cetak_lhv_trader')->name('verifikator.print_lhv_tongkang_trader');

        //Upload Dokumen LHV
        Route::get('/upload-lhv', 'VerifikatorController@unggah_dokumenlhv_page')->name('upload_dokumen_lhv');
        Route::post('/tongkang/upload', 'VerifikatorController@store_dokumen_lhv')->name('store_dokumen_lhv.bb');

        Route::get('/upload-lhv/mineral', 'VerifikatorController@unggah_dokumenlhv_page_mn')->name('upload_dokumen_lhv.mn');
        Route::post('/tongkang/upload/mineral', 'VerifikatorController@store_dokumen_lhv')->name('store_dokumen_lhv.mn');

        Route::get('/upload-lhv/trader', 'VerifikatorController@upload_modal_trader')->name('upload_dokumen_lhv.trader');
        Route::post('upload_lhv_trader', 'VerifikatorController@upload_lhv_trader')->name('upload_lhv_trader');

        //TITIK SERAH
        Route::get('/verifikasi-cow/{id}', 'VerifikatorController@verifikasi_cow')->name('verifikator.verifikasi_cow');
        Route::get('/certificate-of-weight/{id}', 'CetakController@cetak_cow_bb')->name('verifikator.cetak_cow_bb');
        Route::get('/certificate-of-weight-vessel/{id}', 'CetakController@cetak_lhv_vessel_bb')->name('verifikator.cetak_lhv_vessel_bb');

        Route::post('/verifikasi-cow/store', 'VerifikatorController@verifikasi_cow_store')->name('verifikasi.cow.bb');
        Route::post('/verifikasi-coa/store', 'VerifikatorController@verifikasi_coa_store')->name('verifikasi.coa.bb');

        Route::get('/verifikasi-coa/{id}', 'VerifikatorController@verifikasi_coa')->name('verifikator.verifikasi_coa');
        Route::get('/certificate-of-analitics/{id}', 'CetakController@cetak_coa_bb')->name('verifikator.cetak_coa_bb');

        Route::get('surveyor-muat/batubara/vessel', 'SurveyorController@detail_vessel')->name('detail_vessel');
        Route::post('/cetak-lhv-titik-serah/vessel/', 'CetakController@print_lhv_vessel')->name('lhv_vessel.bb');
    });
});

Route::group(['namespace' => 'Surveyor', 'prefix' => 'surveyors_perusahaan'], function () {
    Route::name('surveyors_perusahaan.')->middleware('auth:surveyors_perusahaan')->group(function () { });
});

Route::group(['namespace' => 'Perusahaan', 'prefix' => 'traders'], function () {
    Route::name('traders.')->middleware('auth:traders')->group(function () {
        Route::post('/negara-pemasaran', 'HomeController@master_negara_pemasaran')->name('master_negara');

        Route::get('/dashboard-bb', 'HomeController@index')->name('dashboard.bb');
        Route::group(['namespace' => 'Batubara'], function () {
            /*START SK*/
            Route::get('/batubara/list-sk', 'SkController@index')->name('list_sk.bb');
            Route::get('/batubara/detail-sk', 'SkController@detail_sk')->name('sk.batubara');
            Route::get('/batubara/tambah-sk', 'SkController@add_sk_page')->name('add_sk.bb');
            Route::get('/batubara/perpanjang-sk', 'SkController@perpanjang_sk_page')->name('perpanjang_sk.bb');

            Route::get('/batubara/perusahaan_tambang', 'SkController@perusahaan_tambang')->name('perusahaan_tambang.bb');
            Route::get('/batubara/perusahaan_trader', 'SkController@perusahaan_trader')->name('perusahaan_trader.bb');
            Route::post('/batubara/post-sk', 'SkController@store_sk')->name('sk.store');
            /*END SK*/

            /*START VERIFIKASI PEMBELIAN*/
            Route::get('/verifikasi-pembelian-bb', 'VerifikasiController@index')->name('verifikasi_pembelian.bb');

            /*DATA*/
            Route::get('verifikasi/batubara/getDataPemasaran', 'VerifikasiController@getDataPemasaran')->name('verifikasi.batubara.data_pemasaran_perusahaan');
            Route::get('verifikasi/batubara/data_pemasaran_trader', 'VerifikasiController@data_pemasaran_trader')->name('verifikasi.batubara.data_pemasaran_trader');
            Route::get('verifikasi/batubara/detail_pemasaran_perusahaan', 'VerifikasiController@detail')->name('verifikasi.batubara.detail_pemasaran_perusahaan');
            Route::get('verifikasi/batubara/detail_pemasaran_trader', 'VerifikasiController@detail_trader')->name('verifikasi.batubara.detail_pemasaran_trader');

            /*ACTION*/
            Route::post('verifikasi/batubara/reject/{id_pemasaran}', 'VerifikasiController@reject')->name('verifikasi.batubara.reject');
            Route::get('verifikasi/batubara/accepted/{id_pemasaran}', 'VerifikasiController@accepted')->name('verifikasi.batubara.accepted');
            Route::get('verifikasi/batubara/accepted_trader/{id_pemasaran}', 'VerifikasiController@accepted_trader')->name('verifikasi.batubara.accepted_trader');
            Route::post('verifikasi/batubara/tolak_trader/{id_pemasaran}', 'VerifikasiController@tolak_trader')->name('verifikasi.batubara.tolak_trader');
            /*END VERIFIKASI PEMBELIAN*/

            /*START PEMBELIAN*/
            Route::get('/pembelian-bb', 'PembelianController@index')->name('pembelian.bb');
            /*DATA*/
            Route::get('pembelian/batubara/getPembelian', 'PembelianController@data_pembelian')->name('pembelian.batubara.data_pembelian');
            Route::get('pembelian/batubara/detail_pemasaran_perusahaan', 'PembelianController@detail')->name('pembelian.batubara.detail_pemasaran_perusahaan');
            Route::get('pembelian/batubara/detail_pemasaran_trader', 'PembelianController@detail_trader')->name('pembelian.batubara.detail_pemasaran_trader');

            /*END PEMBELIAN*/

            /*START PEMASARAN*/
            Route::get('/pemasaran-bb', 'PemasaranController@index')->name('pemasaran.bb');
            Route::get('pemasaran/batubara/getDataPemasaran', 'PemasaranController@data_pemasaran')->name('pemasaran.batubara.data_pemasaran');
            Route::get('pemasaran/batubara/detail_pemasaran', 'PemasaranController@detail_pemasaran')->name('pemasaran.batubara.detail_pemasaran');
            Route::get('pemasaran/batubara/add_pemasaran', 'PemasaranController@add_pemasaran')->name('pemasaran.batubara.add_pemasaran');
            Route::get('pemasaran/batubara/ubah_pemasaran', 'PemasaranController@ubah_pemasaran')->name('pemasaran.batubara.ubah_pemasaran');


            Route::get('pemasaran/batubara/negara_domestik', 'PemasaranController@negara_domestik')->name('pemasaran.negara_domestik');
            Route::get('pemasaran/batubara/negara_ekspor', 'PemasaranController@negara_ekspor')->name('pemasaran.negara_ekspor');

            Route::get('pemasaran/batubara/perusahaan_trader', 'PemasaranController@perusahaan_trader')->name('pemasaran.perusahaan_trader');
            Route::get('pemasaran/batubara/master_pembeli', 'PemasaranController@master_pembeli')->name('pemasaran.master_pembeli');

            Route::post('/batubara/post-pemasaran', 'PemasaranController@post_pemasaran')->name('pemasaran_bb.store');
            Route::post('/batubara/post-update', 'PemasaranController@pos_update')->name('pemasaran_bb.update');
            /*DATA*/

            /*END PEMASARAN*/

            /*START REKAPITULASI*/
            Route::get('/rekapitulasi-bb', 'RekapitulasiController@index')->name('rekapitulasi.bb');
            Route::get('/detail_inventori/{encode}', 'RekapitulasiController@detail_inventori')->name('rekapitulasi.detail_inventori.bb');

            /*END REKAPITULASI*/
        });

        Route::get('/dashboard-mn', 'HomeController@index')->name('dashboard.mn');
        Route::group(['namespace' => 'Mineral'], function () {
            /*START SK*/
            Route::get('/list-sk-mn', 'SkMineralController@index')->name('list_sk.mn');
            Route::get('/mineral/detail-sk', 'SkMineralController@detail_sk')->name('sk.mineral');
            Route::get('/mineral/tambah-sk', 'SkMineralController@add_sk_page')->name('add_sk.mineral');
            Route::get('/mineral/perpanjang-sk', 'SkMineralController@perpanjang_sk_page')->name('perpanjang_sk.mineral');

            Route::get('/mineral/perusahaan_tambang', 'SkMineralController@perusahaan_tambang')->name('perusahaan_tambang.mineral');
            Route::get('/mineral/perusahaan_trader', 'SkMineralController@perusahaan_trader')->name('perusahaan_trader.mineral');
            Route::post('/mineral/post-sk', 'SkMineralController@store_sk')->name('sk.store.mineral');

            /*END SK*/

            /*START VERIFIKASI PEMBELIAN*/
            Route::get('/verifikasi-pembelian-mn', 'VerifikasiMineralController@index')->name('verifikasi_pembelian.mn');

            /*DATA*/
            Route::get('verifikasi/mineral/getDataPemasaran', 'VerifikasiMineralController@getDataPemasaran')->name('verifikasi.mineral.data_pemasaran_perusahaan');
            Route::get('verifikasi/mineral/data_pemasaran_trader', 'VerifikasiMineralController@data_pemasaran_trader')->name('verifikasi.mineral.data_pemasaran_trader');
            Route::get('verifikasi/mineral/detail_pemasaran_perusahaan', 'VerifikasiMineralController@detail')->name('verifikasi.mineral.detail_pemasaran_perusahaan');
            Route::get('verifikasi/mineral/detail_pemasaran_trader', 'VerifikasiMineralController@detail_trader')->name('verifikasi.mineral.detail_pemasaran_trader');

            /*ACTION*/
            Route::post('verifikasi/mineral/reject/{id_pemasaran}', 'VerifikasiMineralController@reject')->name('verifikasi.mineral.reject');
            Route::get('verifikasi/mineral/accepted/{id_pemasaran}', 'VerifikasiMineralController@accepted')->name('verifikasi.mineral.accepted');
            Route::get('verifikasi/mineral/accepted_trader/{id_pemasaran}', 'VerifikasiMineralController@accepted_trader')->name('verifikasi.mineral.accepted_trader');
            Route::post('verifikasi/mineral/tolak_trader/{id_pemasaran}', 'VerifikasiMineralController@tolak_trader')->name('verifikasi.mineral.tolak_trader');
            /*END VERIFIKASI PEMBELIAN*/

            /*START PEMBELIAN*/
            Route::get('/pembelian-mn', 'PembelianMineralController@index')->name('pembelian.mn');
            /*DATA*/
            Route::get('pembelian/mineral/getPembelian', 'PembelianMineralController@data_pembelian')->name('pembelian.mineral.data_pembelian');
            Route::get('pembelian/mineral/detail_pemasaran_perusahaan', 'PembelianMineralController@detail')->name('pembelian.mineral.detail_pemasaran_perusahaan');
            Route::get('pembelian/mineral/detail_pemasaran_trader', 'PembelianMineralController@detail_trader')->name('pembelian.mineral.detail_pemasaran_trader');

            /*END PEMBELIAN*/

            /*START PEMASARAN*/
            Route::get('/pemasaran-mn', 'PemasaranMineralController@index')->name('pemasaran.mn');
            Route::get('pemasaran/mineral/getDataPemasaran', 'PemasaranMineralController@data_pemasaran')->name('pemasaran.mineral.data_pemasaran');
            Route::get('pemasaran/mineral/detail_pemasaran', 'PemasaranMineralController@detail_pemasaran')->name('pemasaran.mineral.detail_pemasaran');
            Route::get('pemasaran/mineral/add_pemasaran', 'PemasaranMineralController@add_pemasaran')->name('pemasaran.mineral.add_pemasaran');
            Route::get('/master_kualitas', 'PemasaranMineralController@master_kualitas')->name('master_kualitas.mineral');
            Route::post('mineral/post-pemasaran', 'PemasaranMineralController@post_pemasaran')->name('pemasaran_mn.store');
            Route::post('mineral/post-update', 'PemasaranMineralController@pos_update')->name('pemasaran_mn.update');

            /*DATA*/

            /*END PEMASARAN*/

            /*START REKAPITULASI*/
            // Route::get('/rekapitulasi-mn', 'RekapitulasiMineralController@index')->name('rekapitulasi.mn');
            // Route::get('/detail_inventori/{encode}', 'RekapitulasiMineralController@detail_inventori')->name('rekapitulasi.detail_inventori.bb');

            /*END REKAPITULASI*/
        });
    });
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::middleware('auth:adminstrator')->group(function () {

        Route::get('/admin-index', 'AdminController@index')->name('admin.index');

        Route::get('/ListSK-All', 'AdminController@ListSK_All')->name('admin.listSK');
        Route::get('/Detail-SK/{id_sk}', 'AdminController@ListSK_Detail');
        Route::post('/Approve-SK', 'AdminController@approve_sk');
        Route::post('/Tolak-SK', 'AdminController@tolak_sk');
        Route::get('/sk_detai_nonaktif/{id_perusahaan}/{id_sk}', 'AdminController@nonactive_treadersk');
        Route::get('/sk_detai_aktif/{id_perusahaan}/{id_sk}', 'AdminController@active_treadersk');
        Route::get('/Update-misverask/{id_perusahaan}/{status}', 'AdminController@update_status_misverask');
        Route::get('/NonActive-Treadersk/{id}/{id_sk}', 'AdminController@nonactive_treadersk');
        Route::get('/Active-Treadersk/{id}/{id_sk}', 'AdminController@active_treadersk');

        Route::get('/List-Pembelian', 'AdminController@List_Pembelian');
        Route::get('/List-Pemasaran', 'AdminController@List_pemasaran');
        Route::get('/List-LHV', 'AdminController@List_LHV');
        Route::post('/Tolak-Perusahaan', 'AdminController@tolak_perusahaan');

        Route::get('/List-Registrasi', 'AdminController@List_Registrasi_Akun')->name('admin.registrasi_treader');
        Route::get('/list_akun', 'AdminController@list_akun')->name('admin.list_akun');

        Route::post('/NonActive-Treader', 'AdminController@nonactive_treader');
        Route::get('/edit_trader/{uuid}', 'AdminController@edit_trader');
        Route::post('/update_trader', 'AdminController@update_trader')->name('admin.update_trader');
        Route::get('/Active-Treader/{id}', 'AdminController@active_treader');

        Route::get('/list_perusahaan_surveyor', 'AdminController@list_perusahaan_surveyor')->name('admin.listps');
        Route::get('/admingetanylistsurveyor', 'AdminController@admingetanylistsurveyor')->name('admin.getanylistsurveyor');
        Route::post('/add_perusahaan_surveyor', 'AdminController@addperusahaansurveyor')->name('admin.addperusahaansurveyor');
        Route::get('/editperusahaansurveyor/{uuid}', 'AdminController@editperusahaansurveyor');
        Route::get('/aktifasi_surveyor/{uuid}', 'AdminController@aktifasi_surveyor');
        Route::get('/nonaktifasi_surveyor/{uuid}', 'AdminController@nonaktifasi_surveyor');

        Route::get('/list_petugas_verifikator', 'AdminController@list_petugas_verifikator')->name('admin.listpetugas');
        Route::get('/admingetanylistverifikator', 'AdminController@admingetanylistverifikator')->name('admin.getanylistverifikator');
        Route::post('/active_disactive_petugas', 'AdminController@active_disactive_petugas')->name('admin.active_disactive_petugas');



        Route::get('/List-Trader', 'AdminController@list_trader')->name('admin.listTrader');
        Route::get('/Update-misvera/{id_perusahaan}/{status}', 'AdminController@update_status_misvera');

        Route::get('/Detail-Pemasaran/{id_pemasaran}', 'AdminController@detail_pemasaran');
        Route::get('/Detail-Pemasaran-tt/{id_pemasaran}', 'AdminController@detail_pemasaran_tt');
        Route::get('/Detail-Provinsi/{id_provinsi}', 'AdminController@detail_provinsi');
        Route::get('/Detail-LHV', 'AdminController@detail_lhv');


        Route::post('/update_perusahaan_surveyor', 'AdminController@updateperusahaansurveyor')->name('admin.updateperusahaansurveyor');
        Route::post('/update_petugas_surveyor', 'AdminController@updatepetugassurveyor')->name('admin.updatepetugassurveyor');
        Route::get('/Get-Status/{id_perusahaan}', 'AdminController@getStatus');
        Route::get('/Get-Statustrader/{id_perusahaan}', 'AdminController@getStatustrader');
        Route::get('/list_master_trader', 'AdminController@list_master_trader')->name('admin.list_master_trader');

        /*bani*/
        /*bani*/
        Route::get('/modal_lhv', 'AdminController@modal_lhv')->name('adm.modal_lhv');

        Route::post('/add_master_trader', 'AdminController@add_master_trader')->name('admin.add_master_trader');
        Route::get('/edit_master_trader/{kode}', 'AdminController@edit_master_trader');
        Route::post('/update_master_trader', 'AdminController@update_master_trader')->name('admin.update_master_trader');

        Route::get('/admingetanylistlhv', 'AdminController@admingetanylistlhv')->name('admin.getanylistlhv');


        Route::get('/getmastertrader', 'AdminController@getmastertrader')->name('admin.getmastertrader');

        //admin mineral
        Route::get('/admin-mineral-index', 'AdminController@indexmineral')->name('admin.mineral.index');
        Route::get('/list-registrasi-mineral', 'AdminController@list_registrasi_akun_mineral')->name('admin.registrasi_treader_mineral');
        Route::get('/listsk-all-mineral', 'AdminController@listsk_all_mineral')->name('admin.listsk.mineral');
        Route::get('/list-pembelian-mineral', 'AdminController@list_pembelian_mineral');
        Route::get('/admin_detail_pembelian/{id}', 'AdminController@getDetail');
        Route::get('/list-pemasaran-mineral', 'AdminController@list_pemasaran_mineral');
        Route::get('/getnotrader', 'AdminController@getnotrader');
    });
});
