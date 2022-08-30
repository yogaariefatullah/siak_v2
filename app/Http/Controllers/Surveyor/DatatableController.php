<?php

namespace App\Http\Controllers\Surveyor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Models\ProfileSurveyor;
use Validator;

class DatatableController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:surveyors');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function list_pemasaran_bb_stockpile_data()
    {
        $db_2 = \DB::connection('pgsql2');
        $tmp_data = [];
        $query = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->where('id_surveyor', Auth::guard('surveyors')->user()->uuid)
            ->where('jenis_laporan', 'provisional')
            // ->where('date', '>=', '2020-01-01 00:00:00')
            ->where('kategori_pembeli', 5)
            ->where('pemasaran_bb.deleted_at', '=', null)
            ->get();

        $xxxx = json_decode($query, true);

        //dd($query);
        $no = 1;
        for ($i = 0; $i < count($xxxx); $i++) {
            $getfile = '';
            $getfile2 = '';
            if ($xxxx[$i]['status_surveyor'] != 2) {
                $act = '<center>';
                $act .= '<button onclick="return showDetail(\'' . $xxxx[$i]['id_pemasaran_bb'] . '\')" class="btn btn-icon btn-primary" title="Lihat detail"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;';
                $act .= '</center>';
            }
            $tmp_data[$i]['no'] = $i + 1;
            $tmp_data[$i]['id_pemasaran_bb'] = $xxxx[$i]['id_pemasaran_bb'];
            $tmp_data[$i]['tanggal'] = tgl_indo(date('Y-m-d', strtotime($xxxx[$i]['date'])));
            $tmp_data[$i]['id_transaksi'] = $xxxx[$i]['id_transaksi'];
            $tmp_data[$i]['penjual'] = get_nama_perusahaan_moms($xxxx[$i]['pelapor']);
            $tmp_data[$i]['pembeli'] = get_nama_stockpile($xxxx[$i]['id_masterpembeli']);
            $tmp_data[$i]['jenis_laporan'] = $xxxx[$i]['jenis_laporan'];
            $tmp_data[$i]['action'] = $act;
        }
        return Datatables::of($tmp_data)
            ->make(true);
    }

    public function list_pemasaran_bb_trader_data()
    {
        $db_2 = \DB::connection('pgsql2');
        $tmp_data = [];
        $query = DB::table('pemasaran_bb')
            ->where('id_surveyor', Auth::guard('surveyors')->user()->uuid)
            ->where('jenis_laporan', 'provisional')
            // ->where('date', '>=', '2020-01-01 00:00:00')
            ->where('pemasaran_bb.deleted_at', '=', null)
            ->get();
        // dd($query,Auth::guard('surveyors')->user()->uuid);
        $xxxx = json_decode($query, true);

        //dd($query);
        $no = 1;
        for ($i = 0; $i < count($xxxx); $i++) {
            $getfile = '';
            $getfile2 = '';
            if ($xxxx[$i]['status_surveyor'] != 2) {
                $act = '<center>';
                $act .= '<button onclick="return showDetail(\'' . $xxxx[$i]['id_pemasaran_bb'] . '\')" class="btn btn-icon btn-primary" title="Lihat detail"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;';
                $act .= '</center>';
            }
            $tmp_data[$i]['no'] = $i + 1;
            $tmp_data[$i]['id_pemasaran_bb'] = $xxxx[$i]['id_pemasaran_bb'];
            $tmp_data[$i]['tanggal'] = tgl_indo(date('Y-m-d', strtotime($xxxx[$i]['date'])));
            $tmp_data[$i]['id_transaksi'] = $xxxx[$i]['id_transaksi'];
            $tmp_data[$i]['penjual'] = get_nama_trader($xxxx[$i]['pelapor']);
            $tmp_data[$i]['pembeli'] = (get_nama_master_pembeli_moms($xxxx[$i]['id_masterpembeli']) != '-') ? get_nama_master_pembeli_moms($xxxx[$i]['id_masterpembeli']) : get_nama_trader($xxxx[$i]['id_masterpembeli']);
            $tmp_data[$i]['jenis_laporan'] = $xxxx[$i]['jenis_laporan'];
            $tmp_data[$i]['action'] = $act;
        }
        return Datatables::of($tmp_data)
            ->make(true);
    }

    public function list_pemasaran_bb_muat_data(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        $jenis_pembeli = $request->jenis_pembeli;
        $tmp_data = [];
        $query = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->where('id_surveyor', Auth::guard('surveyors')->user()->uuid)
            ->where('jenis_laporan', 'provisional')
            // ->where('date', '>=', '2020-01-01 00:00:00')
            ->where('kategori_pembeli', $jenis_pembeli)
            ->where('pemasaran_bb.deleted_at', '=', null)
            ->get();

        $xxxx = json_decode($query, true);

        //dd($query);
        $no = 1;
        for ($i = 0; $i < count($xxxx); $i++) {
            $getfile = '';
            $getfile2 = '';
            if ($xxxx[$i]['status_surveyor'] != 2) {
                $act = '<center>';
                $act .= '<button onclick="return showDetail(\'' . $xxxx[$i]['id_pemasaran_bb'] . '\')" class="btn btn-icon btn-primary" title="Lihat detail"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;';
                $act .= '</center>';
            }
            $tmp_data[$i]['no'] = $i + 1;
            $tmp_data[$i]['id_pemasaran_bb'] = $xxxx[$i]['id_pemasaran_bb'];
            $tmp_data[$i]['tanggal'] = tgl_indo(date('Y-m-d', strtotime($xxxx[$i]['date'])));
            $tmp_data[$i]['id_transaksi'] = $xxxx[$i]['id_transaksi'];
            $tmp_data[$i]['jenis_pemasaran'] = get_jenis_pemasaran_id($xxxx[$i]['jenis_pemasaran']);
            $tmp_data[$i]['penjual'] = get_nama_perusahaan_moms($xxxx[$i]['pelapor']);
            if ($xxxx[$i]['kategori_pembeli'] == 1) {
                $tmp_data[$i]['pembeli'] = get_nama_trader($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 2) {
                $tmp_data[$i]['pembeli'] = get_nama_master_pembeli_moms($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 3) {
                $tmp_data[$i]['pembeli'] = get_nama_perusahaan_moms($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 5) {
                $tmp_data[$i]['pembeli'] = get_nama_stockpile($xxxx[$i]['id_masterpembeli']);
            } else {
                $tmp_data[$i]['pembeli'] = '-';
            }

            $tmp_data[$i]['jenis_laporan'] = $xxxx[$i]['jenis_laporan'];
            $tmp_data[$i]['action'] = $act;
        }
        return Datatables::of($tmp_data)
            ->make(true);
    }

    public function list_pemasaran_bb_tiser_data(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        $jenis_pembeli = $request->jenis_pembeli;
        $tmp_data = [];
        $query = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->where('id_surveyor_ts', Auth::guard('surveyors')->user()->uuid)
            ->where('status_surveyor', 1)
            // ->where('date', '>=', '2020-01-01 00:00:00')
            ->where('kategori_pembeli', $jenis_pembeli)
            ->where('pemasaran_bb.deleted_at', '=', null)
            ->get();

        $xxxx = json_decode($query, true);

        //dd($query);
        $no = 1;
        for ($i = 0; $i < count($xxxx); $i++) {
            $getfile = '';
            $getfile2 = '';
            if ($xxxx[$i]['status_surveyor'] != 2) {
                $act = '<center>';
                $act .= '<button onclick="return showDetail(\'' . $xxxx[$i]['id_pemasaran_bb'] . '\')" class="btn btn-icon btn-primary" title="Lihat detail"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;';
                $act .= '</center>';
            }
            $tmp_data[$i]['no'] = $i + 1;
            $tmp_data[$i]['id_pemasaran_bb'] = $xxxx[$i]['id_pemasaran_bb'];
            $tmp_data[$i]['tanggal'] = tgl_indo(date('Y-m-d', strtotime($xxxx[$i]['date'])));
            $tmp_data[$i]['id_transaksi'] = $xxxx[$i]['id_transaksi'];
            $tmp_data[$i]['jenis_pemasaran'] = get_jenis_pemasaran_id($xxxx[$i]['jenis_pemasaran']);
            $tmp_data[$i]['penjual'] = get_nama_perusahaan_moms($xxxx[$i]['pelapor']);

            if ($xxxx[$i]['kategori_pembeli'] == 1) {
                $tmp_data[$i]['pembeli'] = get_nama_trader($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 2) {
                $tmp_data[$i]['pembeli'] = get_nama_master_pembeli_moms($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 3) {
                $tmp_data[$i]['pembeli'] = get_nama_perusahaan_moms($xxxx[$i]['id_masterpembeli']);
            } else {
                $tmp_data[$i]['pembeli'] = '-';
            }

            $tmp_data[$i]['jenis_laporan'] = $xxxx[$i]['jenis_laporan'];
            $tmp_data[$i]['action'] = $act;
        }
        return Datatables::of($tmp_data)
            ->make(true);
    }

    public function list_pemasaran_mn_muat_data(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        $jenis_pembeli = $request->jenis_pembeli;
        $tmp_data = [];
        $query = $db_2->table('pemasaran_mn')
            ->join('final_pemasaran_mn', 'pemasaran_mn.id_pemasaran_mn', 'final_pemasaran_mn.id_pemasaran_mn')
            ->where('id_surveyor', Auth::guard('surveyors')->user()->uuid)
            ->where('jenis_laporan', 'provisional')
            ->where('date', '>=', '2020-02-01 00:00:00')
            ->where('kategori_pembeli', $jenis_pembeli)
            ->where('pemasaran_mn.deleted_at', '=', null)
            ->get();

        $xxxx = json_decode($query, true);

        //dd($query);
        $no = 1;
        for ($i = 0; $i < count($xxxx); $i++) {
            $getfile = '';
            $getfile2 = '';
            if ($xxxx[$i]['status_surveyor'] != 2) {
                $act = '<center>';
                $act .= '<button onclick="return showDetailMn(\'' . $xxxx[$i]['id_pemasaran_mn'] . '\')" class="btn btn-icon btn-primary" title="Lihat detail"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;';
                $act .= '</center>';
            }
            $tmp_data[$i]['no'] = $i + 1;
            $tmp_data[$i]['id_pemasaran_mn'] = $xxxx[$i]['id_pemasaran_mn'];
            $tmp_data[$i]['tanggal'] = tgl_indo(date('Y-m-d', strtotime($xxxx[$i]['date'])));
            $tmp_data[$i]['id_transaksi'] = $xxxx[$i]['id_transaksi'];
            $tmp_data[$i]['jenis_pemasaran'] = get_jenis_pemasaran_id($xxxx[$i]['jenis_penjualan']);
            $tmp_data[$i]['penjual'] = get_nama_perusahaan_moms($xxxx[$i]['pelapor']);

            if ($xxxx[$i]['kategori_pembeli'] == 1) {
                $tmp_data[$i]['pembeli'] = get_nama_trader($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 2) {
                $tmp_data[$i]['pembeli'] = get_nama_master_pembeli_moms($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 3) {
                $tmp_data[$i]['pembeli'] = get_nama_perusahaan_moms($xxxx[$i]['id_masterpembeli']);
            } else {
                $tmp_data[$i]['pembeli'] = '-';
            }

            $tmp_data[$i]['jenis_laporan'] = $xxxx[$i]['jenis_laporan'];
            $tmp_data[$i]['action'] = $act;
        }
        return Datatables::of($tmp_data)
            ->make(true);
    }

    public function list_pemasaran_mn_tiser_data(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        $jenis_pembeli = $request->jenis_pembeli;
        $tmp_data = [];
        $query = $db_2->table('pemasaran_mn')
            ->join('final_pemasaran_mn', 'pemasaran_mn.id_pemasaran_mn', 'final_pemasaran_mn.id_pemasaran_mn')
            ->where('id_surveyor', Auth::guard('surveyors')->user()->uuid)
            ->where('jenis_laporan', 'provisional')
            ->where('status_surveyor', 1)
            ->where('date', '>=', '2020-02-01 00:00:00')
            //tambahan alados
            ->where('jenis_pemasaran', '325404be-6885-4fac-ac8f-fedbc28e0efd')
            ->where('kategori_pembeli', $jenis_pembeli)
            ->where('pemasaran_mn.deleted_at', '=', null)
            ->get();

        $xxxx = json_decode($query, true);

        $no = 1;
        for ($i = 0; $i < count($xxxx); $i++) {
            $getfile = '';
            $getfile2 = '';
            if ($xxxx[$i]['status_surveyor'] != 2) {
                $act = '<center>';
                $act .= '<button onclick="return showDetailMn(\'' . $xxxx[$i]['id_pemasaran_mn'] . '\')" class="btn btn-icon btn-primary" title="Lihat detail"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;';
                $act .= '</center>';
            }
            $tmp_data[$i]['no'] = $i + 1;
            $tmp_data[$i]['id_pemasaran_bb'] = $xxxx[$i]['id_pemasaran_mn'];
            $tmp_data[$i]['tanggal'] = tgl_indo(date('Y-m-d', strtotime($xxxx[$i]['date'])));
            $tmp_data[$i]['id_transaksi'] = $xxxx[$i]['id_transaksi'];
            $tmp_data[$i]['jenis_pemasaran'] = get_jenis_pemasaran_id($xxxx[$i]['jenis_penjualan']);
            $tmp_data[$i]['penjual'] = get_nama_perusahaan_moms($xxxx[$i]['pelapor']);

            if ($xxxx[$i]['kategori_pembeli'] == 1) {
                $tmp_data[$i]['pembeli'] = get_nama_trader($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 2) {
                $tmp_data[$i]['pembeli'] = get_nama_master_pembeli_moms($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 3) {
                $tmp_data[$i]['pembeli'] = get_nama_perusahaan_moms($xxxx[$i]['id_masterpembeli']);
            } else {
                $tmp_data[$i]['pembeli'] = '-';
            }

            $tmp_data[$i]['jenis_laporan'] = $xxxx[$i]['jenis_laporan'];
            $tmp_data[$i]['action'] = $act;
        }

        return Datatables::of($tmp_data)
            ->make(true);
    }

    protected function validate_url_file($id_perusahaan, $jenis_file, $file)
    {
        $getfile = '';
        $data = [];
        if ($jenis_file == 'buktibayar') {
            $url = 'https://moms.esdm.go.id/uploads/Dokumen-Bayar/' . $file;
            $file_headers = @get_headers($url);
            if ($file_headers[0] == 'HTTP/1.1 200 OK') {
                $urlfile = "https://moms.esdm.go.id/uploads/Dokumen-Bayar/";
                $getfile = $urlfile . '' . $file;
            } else {
                $urlfile = "https://moms.esdm.go.id/uploads/Dokumen-Bayar/" . $id_perusahaan . "/";
                $getfile = $urlfile . '' . $file;
            }
            $data['file'] = $getfile;
        } elseif ($jenis_file == 'invoice') {
            $url = 'https://moms.esdm.go.id/mn/uploads/dokumen_invoice/' . $file;
            $file_headers = @get_headers($url);
            if ($file_headers[0] == 'HTTP/1.1 200 OK') {
                $urlfile = "https://moms.esdm.go.id/mn/uploads/dokumen_invoice/";
                $getfile = $urlfile . '' . $file;
            } else {
                $urlfile = "https://moms.esdm.go.id/mn/uploads/dokumen_invoice/" . $id_perusahaan . "/";
                $getfile = $urlfile . '' . $file;
            }
            $data['file'] = $getfile;
        } elseif ($jenis_file == 'buktibayar_mn') {
            $url = 'https://moms.esdm.go.id/mn/uploads/Dokumen-Bayar/' . $file;
            $file_headers = @get_headers($url);
            if ($file_headers[0] == 'HTTP/1.1 200 OK') {
                $urlfile = "https://moms.esdm.go.id/mn/uploads/Dokumen-Bayar/";
                $getfile = $urlfile . '' . $file;
            } else {
                $urlfile = "https://moms.esdm.go.id/mn/uploads/Dokumen-Bayar/" . $id_perusahaan . "/";
                $getfile = $urlfile . '' . $file;
            }
            $data['file'] = $getfile;
        } else {
            $url = 'https://moms.esdm.go.id/uploads/dokumen_shipping/' . $file;
            $file_headers = @get_headers($url);
            if ($file_headers[0] == 'HTTP/1.1 200 OK') {
                $urlfile = "https://moms.esdm.go.id/uploads/dokumen_shipping/";
                $getfile = $urlfile . '' . $file;
            } else {
                $urlfile = "https://moms.esdm.go.id/uploads/dokumen_shipping/" . $id_perusahaan . "/";
                $getfile = $urlfile . '' . $file;
            }
            $data['file'] = $getfile;
        }
        return $data;
    }

    public function list_verifikator_pemasaran_bb_trader_data()
    {
        $db_2 = \DB::connection('pgsql2');
        $tmp_data = [];
        $query = DB::table('pemasaran_bb')
            ->where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)
            ->where('jenis_laporan', 'provisional')
            // ->where('date', '>=', '2020-01-01 00:00:00')
            ->where('pemasaran_bb.deleted_at', '=', null)
            ->where(function ($q) {
                $lokasi1 = Auth::guard('surveyors')->user()->provinsi_satu;
                $lokasi2 = Auth::guard('surveyors')->user()->provinsi_dua;
                $q->where('lokasi_pelabuhan', $lokasi1)
                    ->orWhere('lokasi_pelabuhan', $lokasi2);
            })
            ->orderby('date', 'desc')
            ->get();

        $xxxx = json_decode($query, true);
        $no = 1;
        for ($i = 0; $i < count($xxxx); $i++) {
            $getfile = '';
            $getfile2 = '';
            $act = '<center>';
            if ($xxxx[$i]['status_surveyor'] != 2) {
                $act .= '<button onclick="return showDetail(\'' . $xxxx[$i]['id_pemasaran_bb'] . '\')" class="btn btn-icon btn-primary" title="Lihat detail"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;';
            }
            if ($xxxx[$i]['status_surveyor'] == 1) {
                $url = route('surveyors.verifikator.print_lhv_tongkang_trader',base64_encode($xxxx[$i]['id_pemasaran_bb']));
                $act .= '<a href="' . $url . '" rel="noopener noreferrer" target="_blank" class="btn btn-icon btn-success" title="Cetak LHV"><i class="fa fa-print"></i></a>&nbsp;&nbsp;';
                $act .= '<a onclick="return unggah_dokumen(\'' . $xxxx[$i]['id_pemasaran_bb'] . '\')" class="btn btn-icon btn-warning" title="Unggah dokumen lhv" ><i class="fa fa-upload"></i></a>&nbsp;&nbsp;';
            } else {
                if ($xxxx[$i]['status_konfirmasi'] == true) {
                    $url = route('surveyors.verifikasi.tongkang.page.trader', base64_encode($xxxx[$i]['id_pemasaran_bb']));
                    $act .= '<a href="' . $url . '" class="btn btn-icon btn-success" title="Verifikasi Lengkap !"><i class="fas fa-clipboard-check"></i></a>&nbsp;&nbsp;';
                }
            }
            $act .= '</center>';
            $tmp_data[$i]['no'] = $i + 1;
            $tmp_data[$i]['id_pemasaran_bb'] = $xxxx[$i]['id_pemasaran_bb'];
            $tmp_data[$i]['tanggal'] = tgl_indo(date('Y-m-d', strtotime($xxxx[$i]['date'])));
            $tmp_data[$i]['id_transaksi'] = $xxxx[$i]['id_transaksi'];
            $tmp_data[$i]['penjual'] = get_nama_trader($xxxx[$i]['pelapor']);
            $tmp_data[$i]['pembeli'] = (get_nama_master_pembeli_moms($xxxx[$i]['id_masterpembeli']) != '-') ? get_nama_master_pembeli_moms($xxxx[$i]['id_masterpembeli']) : get_nama_trader($xxxx[$i]['id_masterpembeli']);
            $tmp_data[$i]['jenis_laporan'] = $xxxx[$i]['jenis_laporan'];
            $tmp_data[$i]['action'] = $act;
        }

        return Datatables::of($tmp_data)
            ->make(true);
    }

    public function list_verifikator_pemasaran_bb_muat_data(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        $jenis_pembeli = $request->jenis_pembeli;
        $trader = ($jenis_pembeli == 1) ? TRUE : NULL;
        $tmp_data = [];
        $query = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->leftjoin('rkab', 'rkab.id_perusahaan', 'pemasaran_bb.pelapor')
            ->where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)
            ->where('jenis_laporan', 'provisional')
            // ->where('date', '>=', '2020-01-01 00:00:00')
            ->where('kategori_pembeli', $jenis_pembeli)
            ->where('pemasaran_bb.deleted_at', '=', null)
            ->when($trader, function ($query) {
                return $query->where('status_konfirmasi', true);
            })
            ->wherenull('status_surveyor')
            ->where(function ($q) {
                $lokasi1 = Auth::guard('surveyors')->user()->provinsi_satu;
                $lokasi2 = Auth::guard('surveyors')->user()->provinsi_dua;
                $q->where('lokasi_pelabuhan', $lokasi1)
                    ->orWhere('lokasi_pelabuhan', $lokasi2);
            })
            ->where(function ($q) {
                $tahun = date("Y");
                $q->where('rkab.tahun', $tahun)->where('rkab.status', '!=', '1')->where('rkab.approve', true)
                    ->orwhere('rkab.tahun', $tahun)->where('rkab.status', '3')->where('rkab.approve', null)
                    ->orwhere('rkab.tahun', $tahun)->where('rkab.status', '3')->where('rkab.approve', false);
            })
            ->orderby('date', 'desc')
            ->get();


        $xxxx = json_decode($query, true);
        $no = 1;
        for ($i = 0; $i < count($xxxx); $i++) {
            $getfile = '';
            $getfile2 = '';
            $act = '<center>';
            if ($xxxx[$i]['status_surveyor'] != 2) {
                if (empty($xxxx[$i]['status_buktibayar'])) {
                    $dok_buktibayar = $this->validate_url_file($xxxx[$i]['pelapor'], 'buktibayar', $xxxx[$i]['dokumen_buktibayar']);
                    $dok_shipping = $this->validate_url_file($xxxx[$i]['pelapor'], 'shipping', $xxxx[$i]['dokumen_baru']);
                    $act .= '<button onclick="return verifdokumenbayar(\'' . $xxxx[$i]['id_pemasaran_bb'] . '\',\'' . $dok_shipping['file'] . '\',\'' . $dok_buktibayar['file'] . '\')" class="btn btn-icon btn-warning  btn-sm" title="Verifikasi Dokumen Pembayaran"><i class="fas fa-copy"></i></button>&nbsp;&nbsp;';
                } else {
                    $url = route('surveyors.verifikasi.tongkang.page', base64_encode($xxxx[$i]['id_pemasaran_bb']));
                    $act .= '<a href="' . $url . '" class="btn btn-icon btn-icon-white bg-color-greenDark btn-sm" title="Verifikasi Lengkap !"><i class="fa fas fa-file-invoice"></i></a>&nbsp;&nbsp;';
                    $act .= '<a href="' . route('surveyors.upload_dokumen_lhv', ['id_pemasaran' => base64_encode($xxxx[$i]['id_pemasaran_bb'])]) . '" class="btn btn-icon btn-icon-white bg-color-purple btn-sm" title="Unggah dokumen lhv" ><i class="fa fa-upload"></i></a>&nbsp;&nbsp;';
                }
            }
            $act .= '<button onclick="return showDetail(\'' . $xxxx[$i]['id_pemasaran_bb'] . '\')" class="btn btn-icon btn-primary" title="Lihat detail"><i class="fa fa-eye"></i></button>';
            $act .= '</center>';
            $tmp_data[$i]['action'] = $act;
            $tmp_data[$i]['no'] = $i + 1;
            $tmp_data[$i]['id_pemasaran_bb'] = $xxxx[$i]['id_pemasaran_bb'];
            $tmp_data[$i]['tanggal'] = tgl_indo(date('Y-m-d', strtotime($xxxx[$i]['date'])));
            $tmp_data[$i]['id_transaksi'] = $xxxx[$i]['id_transaksi'];
            $tmp_data[$i]['jenis_pemasaran'] = get_jenis_pemasaran_id($xxxx[$i]['jenis_pemasaran']);
            $tmp_data[$i]['penjual'] = get_nama_perusahaan_moms($xxxx[$i]['pelapor']);

            if ($xxxx[$i]['kategori_pembeli'] == 1) {
                $tmp_data[$i]['pembeli'] = get_nama_trader($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 2) {
                $tmp_data[$i]['pembeli'] = get_nama_master_pembeli_moms($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 3) {
                $tmp_data[$i]['pembeli'] = get_nama_perusahaan_moms($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 5) {
                $tmp_data[$i]['pembeli'] = get_nama_stockpile($xxxx[$i]['id_masterpembeli']);
            } else {
                $tmp_data[$i]['pembeli'] = '-';
            }

            $tmp_data[$i]['jenis_laporan'] = $xxxx[$i]['jenis_laporan'];
        }
        return Datatables::of($tmp_data)
            ->make(true);
    }

    public function list_verifikator_pemasaran_bb_muat_data_selesai(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        $jenis_pembeli = $request->jenis_pembeli;
        $tmp_data = [];
        $query = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->leftjoin('rkab', 'rkab.id_perusahaan', 'pemasaran_bb.pelapor')
            ->where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)
            ->where('jenis_laporan', 'provisional')
            // ->where('date', '>=', '2020-01-01 00:00:00')
            ->where('kategori_pembeli', $jenis_pembeli)
            ->where('pemasaran_bb.deleted_at', '=', null)
            ->where('status_surveyor', 1)
            ->where(function ($q) {
                $lokasi1 = Auth::guard('surveyors')->user()->provinsi_satu;
                $lokasi2 = Auth::guard('surveyors')->user()->provinsi_dua;
                $q->where('lokasi_pelabuhan', $lokasi1)
                    ->orWhere('lokasi_pelabuhan', $lokasi2);
            })
            ->where(function ($q) {
                $tahun = date("Y");
                $q->where('rkab.tahun', $tahun)->where('rkab.status', '!=', '1')->where('rkab.approve', true)
                    ->orwhere('rkab.tahun', $tahun)->where('rkab.status', '3')->where('rkab.approve', null)
                    ->orwhere('rkab.tahun', $tahun)->where('rkab.status', '3')->where('rkab.approve', false);
            })
            ->orderby('date', 'desc')
            ->get();

        $xxxx = json_decode($query, true);
        $no = 1;
        for ($i = 0; $i < count($xxxx); $i++) {
            $getfile = '';
            $getfile2 = '';
            $act = '<center>';
            if ($xxxx[$i]['status_surveyor'] != 2) {
                if (empty($xxxx[$i]['status_buktibayar'])) {
                    $dok_buktibayar = $this->validate_url_file($xxxx[$i]['pelapor'], 'buktibayar', $xxxx[$i]['dokumen_buktibayar']);
                    $dok_shipping = $this->validate_url_file($xxxx[$i]['pelapor'], 'shipping', $xxxx[$i]['dokumen_baru']);
                    $act .= '<button onclick="return verifdokumenbayar(\'' . $xxxx[$i]['id_pemasaran_bb'] . '\',\'' . $dok_shipping['file'] . '\',\'' . $dok_buktibayar['file'] . '\')" class="btn btn-icon btn-warning  btn-sm" title="Verifikasi Dokumen Pembayaran"><i class="fas fa-copy"></i></button>&nbsp;&nbsp;';
                } else {
                    $url = route('surveyors.verifikasi.tongkang.page', base64_encode($xxxx[$i]['id_pemasaran_bb']));
                    $act .= '<a href="' . $url . '" class="btn btn-icon btn-icon-white bg-color-greenDark btn-sm" title="Cetak Ulang"><i class="fa fas fa-eye"></i></a>&nbsp;&nbsp;';
                    $act .= '<a href="' . route('surveyors.upload_dokumen_lhv', ['id_pemasaran' => base64_encode($xxxx[$i]['id_pemasaran_bb'])]) . '" class="btn btn-icon btn-icon-white bg-color-purple btn-sm" title="Unggah dokumen lhv" ><i class="fa fa-upload"></i></a>&nbsp;&nbsp;';
                }
            }
            $act .= '<button onclick="return showDetail(\'' . $xxxx[$i]['id_pemasaran_bb'] . '\')" class="btn btn-icon btn-primary" title="Lihat detail"><i class="fa fa-eye"></i></button>';
            $act .= '</center>';
            $tmp_data[$i]['action'] = $act;
            $tmp_data[$i]['no'] = $i + 1;
            $tmp_data[$i]['id_pemasaran_bb'] = $xxxx[$i]['id_pemasaran_bb'];
            $tmp_data[$i]['tanggal'] = tgl_indo(date('Y-m-d', strtotime($xxxx[$i]['date'])));
            $tmp_data[$i]['id_transaksi'] = $xxxx[$i]['id_transaksi'];
            $tmp_data[$i]['jenis_pemasaran'] = get_jenis_pemasaran_id($xxxx[$i]['jenis_pemasaran']);
            $tmp_data[$i]['penjual'] = get_nama_perusahaan_moms($xxxx[$i]['pelapor']);

            if ($xxxx[$i]['kategori_pembeli'] == 1) {
                $tmp_data[$i]['pembeli'] = get_nama_trader($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 2) {
                $tmp_data[$i]['pembeli'] = get_nama_master_pembeli_moms($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 3) {
                $tmp_data[$i]['pembeli'] = get_nama_perusahaan_moms($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 5) {
                $tmp_data[$i]['pembeli'] = get_nama_stockpile($xxxx[$i]['id_masterpembeli']);
            } else {
                $tmp_data[$i]['pembeli'] = '-';
            }

            $tmp_data[$i]['jenis_laporan'] = $xxxx[$i]['jenis_laporan'];
        }
        return Datatables::of($tmp_data)
            ->make(true);
    }

    public function list_verifikator_pemasaran_bb_tiser_data(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        $jenis_pembeli = $request->jenis_pembeli;
        $tmp_data = [];
        $query = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->where('id_surveyor_ts', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)
            ->where('status_surveyor', 1)
            ->where('jenis_laporan', 'provisional')
            ->where('pemasaran_bb.deleted_at', '=', null)
            ->where('date', '>=', '2020-12-31 00:00:00')
            ->where('kategori_pembeli', $jenis_pembeli)
            ->where(function ($q) {
                $lokasi1 = Auth::guard('surveyors')->user()->provinsi_satu;
                $lokasi2 = Auth::guard('surveyors')->user()->provinsi_dua;
                $q->where('lokasi_pelabuhan_ts', $lokasi1)
                    ->orWhere('lokasi_pelabuhan_ts', $lokasi2);
            })
            ->orderby('date', 'desc')
            ->get();
        $actcow = '';
        $actcoa = '';

        $xxxx = json_decode($query, true);
        $no = 1;
        for ($i = 0; $i < count($xxxx); $i++) {
            $actcow = '<center>';
            $actcoa = '<center>';

            if ($xxxx[$i]['status_cow'] == 1) {
                $actcow .= '<button onclick="return show(\'' . base64_encode(get_final_bb_row($xxxx[$i]['id_transaksi'])) . '\')" class="btn btn-primary btn-icon btn-sm" title="Lihat detail"><i class="fa fa-search-plus"></i></button>&nbsp;&nbsp;';

                $actcow .= '<a target="_blank" rel="noopener noreferrer" href="' . route('surveyors.verifikator.cetak_cow_bb', base64_encode($xxxx[$i]['id_transaksi'])) . '" class="btn btn-icon btn-warning btn-sm" title="Cetak COW"><i class="fa fa-print"></i></a>&nbsp;&nbsp;';
                if ($xxxx[$i]['jenis_pemasaran'] == 'f322e38c-8c68-4f1f-8db4-c1cdec6c659e' || $xxxx[$i]['jenis_pemasaran'] =='62bbb3c7-a839-4a46-bf2e-2ae73963ab42') {
                    $actcow .= '<a onclick="return cetak_vessel(\'' . base64_encode(get_final_bb_row($xxxx[$i]['id_transaksi'])) . '\')" class="btn btn-icon bg-color-greenDark btn-icon-white btn-sm" title="Cetak LHV Vessel"><i class="fa fa-print"></i></a>&nbsp;&nbsp;';
                    if ($xxxx[$i]['status_cow'] == 1 && !empty($xxxx[$i]['status_cetak_cow'])) {
                        $actcow .= '<a onclick="return upload_dokumen_cow(\'' . $xxxx[$i]['id_transaksi'] . '\',\'' . $xxxx[$i]['id_pemasaran_bb'] . '\')" class="btn btn-icon btn-secondary btn-sm" title="Upload Dokumen COW"><i class="fa fa-upload"></i></a>&nbsp;&nbsp;';
                    }
                } else {
                    if ($xxxx[$i]['status_cow'] == 1 && !empty($xxxx[$i]['status_cetak_cow'])) {
                        $actcow .= '<a onclick="return upload_dokumen_cow(\'' . $xxxx[$i]['id_transaksi'] . '\',\'' . $xxxx[$i]['id_pemasaran_bb'] . '\')" class="btn btn-icon btn-secondary btn-sm" title="Upload Dokumen COW"><i class="fa fa-upload"></i></a>&nbsp;';
                    }
                }
            } else {
                $actcow .= '<a href="' . route('surveyors.verifikator.verifikasi_cow', base64_encode($xxxx[$i]['id_pemasaran_bb'])) . '"  class="btn btn-icon btn-success btn-sm" title="Verifikasi COW"><i class="fas fa-clipboard-check"></i></a>&nbsp;&nbsp;';
                $actcow .= '<button onclick="return show(\'' . base64_encode($xxxx[$i]['id_pemasaran_bb']) . '\')" class="btn btn-primary btn-icon btn-sm" title="Lihat detail"><i class="fa fa-search-plus"></i></button>&nbsp;&nbsp;';
            }

            if ($xxxx[$i]['status_coa'] == 1) {
                // $actcow .= '<button onclick="return show(\'' . base64_encode(get_final_bb_row($xxxx[$i]['id_transaksi'])) . '\')" class="btn btn-primary btn-icon btn-sm" title="Lihat detail"><i class="fa fa-search-plus"></i></button>&nbsp;&nbsp;';
                $actcoa .= '<a target="_blank" rel="noopener noreferrer" href="' . route('surveyors.verifikator.cetak_coa_bb', base64_encode($xxxx[$i]['id_transaksi'])) . '" class="btn btn-icon btn-warning btn-sm" title="Cetak COA"><i class="fa fa-print"></i></a>&nbsp;&nbsp;';
                if ($xxxx[$i]['status_coa'] == 1 && !empty($xxxx[$i]['status_cetak_coa'])) {
                    $actcoa .= '<a onclick="return upload_dokumen_coa(\'' . $xxxx[$i]['id_transaksi'] . '\',\'' . $xxxx[$i]['id_pemasaran_bb'] . '\')" class="btn btn-icon btn-success btn-sm" title="Upload Dokumen COA"><i class="fa fa-upload"></i></a>&nbsp;';
                }
            } else {
                // $actcow .= '<button onclick="return show(\'' . base64_encode(get_final_bb_row($xxxx[$i]['id_transaksi'])) . '\')" class="btn btn-primary btn-icon btn-sm" title="Lihat detail"><i class="fa fa-search-plus"></i></button>&nbsp;&nbsp;';
                $actcoa .= '<a href="' . route('surveyors.verifikator.verifikasi_coa', base64_encode($xxxx[$i]['id_pemasaran_bb'])) . '" class="btn btn-icon btn-success btn-sm" title="Verifikasi COA"><i class="fas fa-clipboard-list"></i></a>&nbsp;';
            }
            $actcow .= '</center>';
            $actcoa .= '</center>';

            $tmp_data[$i]['no'] = $i + 1;
            $tmp_data[$i]['id_pemasaran_bb'] = $xxxx[$i]['id_pemasaran_bb'];
            $tmp_data[$i]['tanggal'] = tgl_indo(date('Y-m-d', strtotime($xxxx[$i]['date'])));
            $tmp_data[$i]['id_transaksi'] = $xxxx[$i]['id_transaksi'];
            if ($xxxx[$i]['kategori_pembeli'] == 1) {
                $tmp_data[$i]['pembeli'] = get_nama_trader($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 2) {
                $tmp_data[$i]['pembeli'] = get_nama_master_pembeli_moms($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 3) {
                $tmp_data[$i]['pembeli'] = get_nama_perusahaan_moms($xxxx[$i]['id_masterpembeli']);
            } else {
                $tmp_data[$i]['pembeli'] = '-';
            }

            $tmp_data[$i]['penjual'] = get_nama_perusahaan_moms($xxxx[$i]['pelapor']);

            $tmp_data[$i]['jenis_laporan'] = $xxxx[$i]['nama_kapal'];
            $tmp_data[$i]['action'] = $actcow;
            $tmp_data[$i]['actions'] = $actcoa;
        }

        return Datatables::of($tmp_data)
            ->rawColumns(['actions', 'action'])
            ->make(true);
    }

    public function list_verifikator_pemasaran_mn_muat_data(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        $jenis_pembeli = $request->jenis_pembeli;
        $trader = ($jenis_pembeli == 1) ? TRUE : NULL;
        $tmp_data = [];
        $lokasi2 = (Auth::guard('surveyors')->user()->provinsi_dua  == '-') ? null : Auth::guard('surveyors')->user()->provinsi_dua;

        $query = $db_2->table('pemasaran_mn')
            ->join('final_pemasaran_mn', 'pemasaran_mn.id_pemasaran_mn', 'final_pemasaran_mn.id_pemasaran_mn')
            ->where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)
            ->where('jenis_laporan', 'provisional')
            // ->where('date', '>=', '2020-01-01 00:00:00')
            ->where('kategori_pembeli', $jenis_pembeli)
            ->wherenull('pemasaran_mn.deleted_at')
            ->wherenull('status_surveyor')
            ->when($trader, function ($query) {
                return $query->where('status_konfirmasi', true);
            })
            ->where(function ($q) {
                $lokasi1 = Auth::guard('surveyors')->user()->provinsi_satu;
                $lokasi2 = Auth::guard('surveyors')->user()->provinsi_dua;
                $q->where('lokasi_pelabuhan', $lokasi1)
                    ->orWhere('lokasi_pelabuhan', $lokasi2);
            })
            ->get();
        $xxxx = json_decode($query, true);
        $no = 1;
        for ($i = 0; $i < count($xxxx); $i++) {
            if ($xxxx[$i]['status_surveyor'] != 2) {
                $act = '<center>';
                if (empty($xxxx[$i]['status_invoice'])) {
                    #VERIFIKASI DOKUMEN INVOICE
                    $tipe_dok = 'invoice';
                    $act .= '<button onclick="return verif_invoice(\'' . $xxxx[$i]['id_pemasaran_mn'] . '\',\'' . $tipe_dok . '\')" class="btn btn-icon btn-secondary btn-sm" title="Verifikasi Dokumen Invoice"><i class="fas fa-copy"></i></button>&nbsp;&nbsp;';
                } else {
                    #VERIFIKASI BUKTI BAYAR
                    if (empty($xxxx[$i]['status_buktibayar'])) {
                        $tipe_dok = 'bukti_bayar';
                        $act .= '<button onclick="return verif_bukti_bayar(\'' . $xxxx[$i]['id_pemasaran_mn'] . '\',\'' . $tipe_dok . '\')" class="btn btn-icon btn-warning btn-sm" title="Verifikasi Dokumen Pembayaran"><i class="fas fa-copy"></i></button>&nbsp;&nbsp;';
                    } else {
                        $url = route('surveyors.verifikasi.tongkang.page.mn', base64_encode($xxxx[$i]['id_pemasaran_mn']));
                        $act .= '<a href="' . $url . '" class="btn btn-icon btn-icon-white bg-color-greenDark btn-sm" title="Verifikasi Lengkap !"><i class="fa fas fa-file-invoice"></i></a>&nbsp;&nbsp;';
                        $act .= '<a href="' . route('surveyors.upload_dokumen_lhv.mn', ['id_pemasaran' => base64_encode($xxxx[$i]['id_pemasaran_mn'])]) . '" class="btn btn-icon btn-icon-white bg-color-purple btn-sm" title="Unggah dokumen lhv" ><i class="fa fa-upload"></i></a>&nbsp;&nbsp;';
                    }
                }
                $act .= '<button onclick="return showDetailMn(\'' . $xxxx[$i]['id_pemasaran_mn'] . '\')" class="btn btn-icon btn-primary" title="Lihat detail"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;';
                $act .= '</center>';
            }
            $tmp_data[$i]['no'] = $i + 1;
            $tmp_data[$i]['id_pemasaran_mn'] = $xxxx[$i]['id_pemasaran_mn'];
            $tmp_data[$i]['tanggal'] = tgl_indo(date('Y-m-d', strtotime($xxxx[$i]['date'])));
            $tmp_data[$i]['id_transaksi'] = $xxxx[$i]['id_transaksi'];
            $tmp_data[$i]['penjual'] = get_nama_perusahaan_moms($xxxx[$i]['pelapor']);
            if ($xxxx[$i]['kategori_pembeli'] == 1) {
                $tmp_data[$i]['pembeli'] = get_nama_trader($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 2) {
                $tmp_data[$i]['pembeli'] = get_nama_master_pembeli_moms($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 3) {
                $tmp_data[$i]['pembeli'] = get_nama_perusahaan_moms($xxxx[$i]['id_masterpembeli']);
            } else {
                $tmp_data[$i]['pembeli'] = '-';
            }
            $tmp_data[$i]['jenis_laporan'] = $xxxx[$i]['jenis_laporan'];
            $tmp_data[$i]['action'] = $act;
        }
        return Datatables::of($tmp_data)
            ->make(true);
    }

    public function list_verifikator_pemasaran_mn_muat_data_final(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        $jenis_pembeli = $request->jenis_pembeli;
        $trader = ($jenis_pembeli == 1) ? TRUE : NULL;
        $tmp_data = [];
        $query = $db_2->table('pemasaran_mn')
            ->join('final_pemasaran_mn', 'pemasaran_mn.id_pemasaran_mn', 'final_pemasaran_mn.id_pemasaran_mn')
            ->where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)
            ->where('jenis_laporan', 'provisional')
            ->where('date', '>=', '2020-02-01 00:00:00')
            ->where('kategori_pembeli', $jenis_pembeli)
            ->wherenull('pemasaran_mn.deleted_at')
            ->where('status_surveyor', 1)
            ->when($trader, function ($query) {
                return $query->where('status_konfirmasi', true);
            })
            ->where(function ($q) {
                $lokasi1 = Auth::guard('surveyors')->user()->provinsi_satu;
                $lokasi2 = Auth::guard('surveyors')->user()->provinsi_dua;
                $q->where('lokasi_pelabuhan', $lokasi1)
                    ->orWhere('lokasi_pelabuhan', $lokasi2);
            })
            ->get();
        $xxxx = json_decode($query, true);
        $no = 1;
        for ($i = 0; $i < count($xxxx); $i++) {

            if ($xxxx[$i]['status_surveyor'] != 2) {
                $act = '<center>';
                if (empty($xxxx[$i]['status_invoice'])) {
                    #VERIFIKASI DOKUMEN INVOICE
                    $dok_shipping = $this->validate_url_file($xxxx[$i]['pelapor'], 'invoice', $xxxx[$i]['dokumen_invoice']);
                    $act .= '<button onclick="return verif_invoice(\'' . $xxxx[$i]['id_pemasaran_mn'] . '\',\'' . $dok_shipping['file'] . '\')" class="btn btn-icon btn-secondary btn-sm" title="Verifikasi Dokumen Invoice"><i class="fas fa-copy"></i></button>&nbsp;&nbsp;';
                } else {
                    #VERIFIKASI BUKTI BAYAR
                    if (empty($xxxx[$i]['dokumen_buktibayar'])) {
                        $dokumen_buktibayar = $this->validate_url_file($xxxx[$i]['pelapor'], 'buktibayar_mn', $xxxx[$i]['dokumen_buktibayar']);
                        $act .= '<button onclick="return verif_bukti_bayar(\'' . $xxxx[$i]['id_pemasaran_mn'] . '\',\'' . $dokumen_buktibayar['file'] . '\')" class="btn btn-icon btn-warning btn-sm" title="Verifikasi Dokumen Pembayaran"><i class="fas fa-copy"></i></button>&nbsp;&nbsp;';
                    } else {
                        // $url = route('surveyors.verifikasi.tongkang.page', base64_encode($xxxx[$i]['id_pemasaran_mn']));
                        // $act .= '<a href="' . $url . '" class="btn btn-icon btn-icon-white bg-color-greenDark btn-sm" title="Verifikasi Lengkap !"><i class="fa fas fa-file-invoice"></i></a>&nbsp;&nbsp;';
                        $act .= '<a href="' . route('surveyors.upload_dokumen_lhv.mn', ['id_pemasaran' => base64_encode($xxxx[$i]['id_pemasaran_mn'])]) . '" class="btn btn-icon btn-icon-white bg-color-purple btn-sm" title="Unggah dokumen lhv" ><i class="fa fa-upload"></i></a>&nbsp;&nbsp;';
                    }
                }
                $act .= '<button onclick="return showDetailMn(\'' . $xxxx[$i]['id_pemasaran_mn'] . '\')" class="btn btn-icon btn-primary" title="Lihat detail"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;';
                $act .= '</center>';
            }
            $tmp_data[$i]['no'] = $i + 1;
            $tmp_data[$i]['id_pemasaran_mn'] = $xxxx[$i]['id_pemasaran_mn'];
            $tmp_data[$i]['tanggal'] = tgl_indo(date('Y-m-d', strtotime($xxxx[$i]['date'])));
            $tmp_data[$i]['id_transaksi'] = $xxxx[$i]['id_transaksi'];
            $tmp_data[$i]['penjual'] = get_nama_perusahaan_moms($xxxx[$i]['pelapor']);

            if ($xxxx[$i]['kategori_pembeli'] == 1) {
                $tmp_data[$i]['pembeli'] = get_nama_trader($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 2) {
                $tmp_data[$i]['pembeli'] = get_nama_master_pembeli_moms($xxxx[$i]['id_masterpembeli']);
            } else if ($xxxx[$i]['kategori_pembeli'] == 3) {
                $tmp_data[$i]['pembeli'] = get_nama_perusahaan_moms($xxxx[$i]['id_masterpembeli']);
            } else {
                $tmp_data[$i]['pembeli'] = '-';
            }

            $tmp_data[$i]['jenis_laporan'] = $xxxx[$i]['jenis_laporan'];
            $tmp_data[$i]['action'] = $act;
        }
        return Datatables::of($tmp_data)
            ->make(true);
    }

    public function list_pemasaran_bb_produksi_data()
    {
        $db_2 = \DB::connection('pgsql2');
        $tmp_data = [];
        $surveyor = Auth::guard('surveyors')->user()->id_perusahaan_surveyor;
        $id_surveyor = ($surveyor == null) ? $id_surveyor = Auth::guard('surveyors')->user()->uuid : $id_surveyor = $surveyor;

        $query = $db_2->table('produksi_batubara_realisasi')
            ->leftJoin('blok', function ($join) {
                $join->on('produksi_batubara_realisasi.id_blok', '=', 'blok.id_blok');
            })
            ->leftJoin('perusahaan', function ($join) {
                $join->on('produksi_batubara_realisasi.id_perusahaan', '=', 'perusahaan.id_perusahaan');
            })
            ->leftJoin('master_jenis_pencatatan', function ($join) {
                $join->on('master_jenis_pencatatan.id_jenis_pencatatan', '=', 'produksi_batubara_realisasi.jenis_pencatatan');
            })
            ->leftJoin('master_jenis_produksi', function ($join) {
                $join->on('master_jenis_produksi.id_jenis_produksi', '=', 'produksi_batubara_realisasi.jenis_produksi');
            })
            ->where('produksi_batubara_realisasi.id_surveyor', $id_surveyor)
            ->where('tanggal_transaksi', '>', date('2021-08-01 00:00:00'))
            // ->whereBetween('tanggal_transaksi', [date('2021-08-01 00:00:00'), date('Y-m-d H:i:s')])
            ->whereNull('produksi_batubara_realisasi.deleted_at')
            ->where('produksi_batubara_realisasi.status_kirim', true)
            ->where(function ($q) {
                $q->wherenull('produksi_batubara_realisasi.is_edit')
                    ->orwhere('produksi_batubara_realisasi.is_edit', false);
            })
            ->where('produksi_batubara_realisasi.status_surveyor', 0)
            ->get();

        $xxxx = json_decode($query, true);
        $no = 1;
        for ($i = 0; $i < count($xxxx); $i++) {
            if ($xxxx[$i]['status_surveyor'] == 1) {
                $act = '<center><a onclick="return verifikasi(\'' . $xxxx[$i]['id_produksi_bb'] . '\')" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Verifikasi Lengkap !"><i class="fa fa-check"></i></a>&nbsp;
                        </center>';
            } else {
                $act = '<center><a onclick="return verifikasi(\'' . $xxxx[$i]['id_produksi_bb'] . '\')" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Verifikasi Lengkap !"><i class="fa fa-check"></i></a>&nbsp;
                        </center>';
            }
            $tmp_data[$i]['no'] = $i + 1;
            $tmp_data[$i]['id_produksi_bb'] = $xxxx[$i]['id_produksi_bb'];
            $tmp_data[$i]['tanggal_transaksi'] = tgl_indo(date('Y-m-d', strtotime($xxxx[$i]['tanggal_transaksi'])));
            $tmp_data[$i]['no_ref'] = $xxxx[$i]['no_ref'];
            $perusahaan = $db_2->table('perusahaan')->select('nama')->where('id_perusahaan', $xxxx[$i]['id_perusahaan'])->get();
            $tmp_data[$i]['penjual'] = $perusahaan[0]->nama;
            $tmp_data[$i]['action'] = $act;
        }
        return Datatables::of($tmp_data)
            ->make(true);
    }
    public function list_pemasaran_mn_produksi_data()
    {
        $db_2 = \DB::connection('pgsql2');
        $tmp_data = [];
        $surveyor = Auth::guard('surveyors')->user()->id_perusahaan_surveyor;
        $id_surveyor = ($surveyor == null) ? $id_surveyor = Auth::guard('surveyors')->user()->uuid : $id_surveyor = $surveyor;

        $query = $db_2->table('produksi_mineral_realisasi')
            ->leftJoin('blok', function ($join) {
                $join->on('produksi_mineral_realisasi.id_blok', '=', 'blok.id_blok');
            })
            ->leftJoin('perusahaan', function ($join) {
                $join->on('produksi_mineral_realisasi.id_perusahaan', '=', 'perusahaan.id_perusahaan');
            })
            ->leftJoin('master_jenis_pencatatan', function ($join) {
                $join->on('master_jenis_pencatatan.id_jenis_pencatatan', '=', 'produksi_mineral_realisasi.jenis_pencatatan');
            })
            ->leftJoin('master_jenis_produksi', function ($join) {
                $join->on('master_jenis_produksi.id_jenis_produksi', '=', 'produksi_mineral_realisasi.jenis_produksi');
            })
            ->where('produksi_mineral_realisasi.id_surveyor', $id_surveyor)
            ->where('tanggal_transaksi', '>', date('2021-08-01 00:00:00'))
            ->where('produksi_mineral_realisasi.status_surveyor', 0)
            ->whereNull('produksi_mineral_realisasi.deleted_at')
            ->get();
        $xxxx = json_decode($query, true);
        $no = 1;
        for ($i = 0; $i < count($xxxx); $i++) {
            if ($xxxx[$i]['status_surveyor'] == 1) {
                $act = '<center><a onclick="return verifikasi(\'' . $xxxx[$i]['id_produksi_mn'] . '\')" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Verifikasi Lengkap !"><i class="fa fa-check"></i></a>&nbsp;
                    </center>';
            } else {
                $act = '<center><a onclick="return verifikasi(\'' . $xxxx[$i]['id_produksi_mn'] . '\')" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Verifikasi Lengkap !"><i class="fa fa-check"></i></a>&nbsp;
                    </center>';
            }
            $tmp_data[$i]['no'] = $i + 1;
            $tmp_data[$i]['id_produksi_mn'] = $xxxx[$i]['id_produksi_mn'];
            $tmp_data[$i]['tanggal_transaksi'] = tgl_indo(date('Y-m-d', strtotime($xxxx[$i]['tanggal_transaksi'])));
            $tmp_data[$i]['no_ref'] = $xxxx[$i]['no_ref'];
            $perusahaan = $db_2->table('perusahaan')->select('nama')->where('id_perusahaan', $xxxx[$i]['id_perusahaan'])->get();
            $tmp_data[$i]['penjual'] = $perusahaan[0]->nama;
            $tmp_data[$i]['action'] = $act;
        }
        return Datatables::of($tmp_data)
            ->make(true);
    }
}
