<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class PreviewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:surveyors');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function hasil_scan_versi2($id, $tongkang, $kategori, $id_pembeli)
    {
        try {
            $id_pemasaran = base64_decode($id);
            $id_partial = base64_decode($tongkang);

            $db_2 = \DB::connection('pgsql2');

            $data['pemasaran'] = $db_2->table('pemasaran_bb')
                ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
                ->get();

            $partial = $db_2->table('pemasaran_bb_partial')
                ->where('pemasaran_bb_partial.id_detail', $id_partial)
                ->count();
            if ($partial > 0) {
                $data['partial'] = $db_2->table('pemasaran_bb_partial')
                    ->where('pemasaran_bb_partial.id_detail', $id_partial)
                    ->get();
            } else {
                $data['partial'] = $db_2->table('pemasaran_bb_partial')
                    ->where('pemasaran_bb_partial.id_pemasaran_bb', $id_pemasaran)
                    ->where('pemasaran_bb_partial.id_masterpembeli', base64_decode($id_pembeli))
                    ->where('pemasaran_bb_partial.no_tongkang', $kategori)
                    ->get();
            }
            if (!empty($data['pemasaran'])) {
                $profile = DB::table('profile_surveyor')->where('id_surveyor', $data['pemasaran'][0]->id_surveyor)->first();
                $data['profile'] = DB::table('profile_surveyor')
                    ->join('surveyor', 'surveyor.uuid', 'profile_surveyor.id_surveyor')
                    ->where('id_surveyor', $data['pemasaran'][0]->id_surveyor)->first();
                $data['url_logo'] = asset('/logo_surveyor/' . $profile->file);
                return view('surveyor.output.hasil_scan', $data);
            } else {
                return view('errors.custom-preview');
            }
        } catch (\Throwable $th) {
            //$th
        }
    }

    public function hasil_scan_2($id, $volume)
    {

        $id_pemasaran = base64_decode($id);
        $volumes = base64_decode($volume);
        // $kategori_pembeli = $kategori;
        // $id_masterpembeli = base64_decode($id_pembeli);

        $db_2 = \DB::connection('pgsql2');

        $data['pemasaran'] = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
            ->get();
        $data['volums'] = $volumes;
        $profile = DB::table('profile_surveyor')->where('id_surveyor', $data['pemasaran'][0]->id_surveyor)->first();
        $data['profile'] = DB::table('profile_surveyor')
            ->join('surveyor', 'surveyor.uuid', 'profile_surveyor.id_surveyor')
            ->where('id_surveyor', $data['pemasaran'][0]->id_surveyor)->first();
        $data['url_logo'] = asset('/logo_surveyor/' . $profile->file);
        //dd($pemasaranbb_partial);
        return view('surveyor.output.hasil_scan_vessel', $data);
    }

    public function base64($base64)
    {
        $data = base64_decode($base64);
        return $data;
    }

    public function hasil_scan_v2($id_pemasaran, $id_detail)
    {
        if (base64_decode($id_detail) == 0) {
            $id_pemasaran = base64_decode($id_pemasaran);
            $id_partial = base64_decode($id_detail);

            $db_2 = \DB::connection('pgsql2');

            $data['pemasaran'] = DB::table('pemasaran_bb')
                ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
                ->get();
            $data['partial'] = '';
            $profile = DB::table('profile_surveyor')->where('id_surveyor', $data['pemasaran'][0]->id_surveyor)->first();
            $data['profile'] = DB::table('profile_surveyor')
                ->join('surveyor', 'surveyor.uuid', 'profile_surveyor.id_surveyor')
                ->where('id_surveyor', $data['pemasaran'][0]->id_surveyor)->first();
            $data['url_logo'] = asset('/logo_surveyor/' . $profile->file);
            return view('surveyor.output.hasil_scan', $data);
        } else {
            $id_pemasaran = base64_decode($id_pemasaran);
            $id_partial = base64_decode($id_detail);

            $db_2 = \DB::connection('pgsql2');

            $data['pemasaran'] = $db_2->table('pemasaran_bb')
                ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
                ->get();
            $data['partial'] = $db_2->table('pemasaran_bb_partial')
                ->where('pemasaran_bb_partial.id_detail', $id_partial)
                ->get();
            $profile = DB::table('profile_surveyor')->where('id_surveyor', $data['pemasaran'][0]->id_surveyor)->first();
            $data['profile'] = DB::table('profile_surveyor')
                ->join('surveyor', 'surveyor.uuid', 'profile_surveyor.id_surveyor')
                ->where('id_surveyor', $data['pemasaran'][0]->id_surveyor)->first();
            $data['url_logo'] = asset('/logo_surveyor/' . $profile->file);
            return view('surveyor.output.hasil_scan', $data);
        }
    }



    public function hasil_scan($id, $tongkang, $kategori, $id_pembeli)
    {

        $id_pemasaran = base64_decode($id);
        $id_partial = base64_decode($tongkang);
        $kategori_pembeli = $kategori;
        $id_masterpembeli = base64_decode($id_pembeli);

        $db_2 = \DB::connection('pgsql2');

        $query = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->join('master_jenis_pemasaran', 'pemasaran_bb.jenis_pemasaran', 'master_jenis_pemasaran.id_jenis_pemasaran')
            ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
            ->get();
        $cek = json_decode($query, true);
        $dat = User::all();

        $perusahaan = $db_2->table('perusahaan')
            ->join('master_jenis_izin', 'perusahaan.jeniz_izin', 'id_jenis_izin')->where('perusahaan.id_perusahaan', $query[0]->pelapor)->get();
        $JSONData = json_decode($query, true);
        $penjual = $perusahaan[0]->nama;
        if ($JSONData[0]['kategori_pembeli'] == 3) {
            $pembelis = $db_2->table('perusahaan')->select('nama')->where('id_perusahaan', $query[0]->id_masterpembeli)->get();
            $jenis_pembeli = 'IUP PKP2B';
            $pembeli = $pembelis[0]->nama;
        } else if ($JSONData[0]['kategori_pembeli'] == 2) {
            $pembelis = $db_2->table('master_pembeli')->select('nama_pembeli')->where('id_pembeli', $query[0]->id_masterpembeli)->get();
            $jenis_pembeli = 'End User';
            $pembeli = $pembelis[0]->nama_pembeli;
        } else if ($JSONData[0]['kategori_pembeli'] == 5) {
            $pembelis = $db_2->table('master_stockpile')->select('nama_stockpile')->where('id_stockpile', $query[0]->id_masterpembeli)->get();
            $jenis_pembeli = 'Intermedite Stockpile';
            $pembeli = $pembelis[0]->nama_stockpile;
        } else {
            foreach ($dat as $data1) {
                if ($data1->id_perusahaan == $JSONData[0]['id_masterpembeli']) {
                    $jenis_pembeli = 'IUP OPK Pengangkutan dan Penjualan';
                    $pembeli = $data1->nama;
                }
            }
        }
        $pemasaranbb_partial = $db_2->table('pemasaran_bb_partial')
            ->where('pemasaran_bb_partial.id_detail', $id_partial)
            ->get();
        //dd($pemasaranbb_partial);
        return view('surveyor.view_verifikasi', compact('cek', 'pembeli', 'pemasaranbb_partial', 'penjual'));
    }

    public function hasil_scan_lama($id, $tongkang, $kategori, $id_pembeli)
    {

        $id_pemasaran = base64_decode($id);
        $no_tongkang = $tongkang;
        $kategori_pembeli = $kategori;
        $id_masterpembeli = base64_decode($id_pembeli);

        $db_2 = \DB::connection('pgsql2');

        $query = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->join('master_jenis_pemasaran', 'pemasaran_bb.jenis_pemasaran', 'master_jenis_pemasaran.id_jenis_pemasaran')
            ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
            ->get();
        $cek = json_decode($query, true);
        $dat = User::all();
        $perusahaan = $db_2->table('perusahaan')
            ->join('master_jenis_izin', 'perusahaan.jeniz_izin', 'id_jenis_izin')
            ->where('perusahaan.id_perusahaan', $query[0]->pelapor)->get();
        $JSONData = json_decode($query, true);
        $penjual = $perusahaan[0]->nama;
        if ($JSONData[0]['kategori_pembeli'] == 3) {
            $pembelis = $db_2->table('perusahaan')->select('nama')->where('id_perusahaan', $query[0]->id_masterpembeli)->get();
            $jenis_pembeli = 'IUP PKP2B';
            $pembeli = $pembelis[0]->nama;
        } else if ($JSONData[0]['kategori_pembeli'] == 2) {
            $pembelis = $db_2->table('master_pembeli')->select('nama_pembeli')->where('id_pembeli', $query[0]->id_masterpembeli)->get();
            $jenis_pembeli = 'End User';
            $pembeli = $pembelis[0]->nama_pembeli;
        } else if ($JSONData[0]['kategori_pembeli'] == 5) {
            $pembelis = $db_2->table('master_stockpile')->select('nama_stockpile')->where('id_stockpile', $query[0]->id_masterpembeli)->get();
            $jenis_pembeli = 'Intermedite Stockpile';
            $pembeli = $pembelis[0]->nama_stockpile;
        } else {
            foreach ($dat as $data1) {
                if ($data1->id_perusahaan == $JSONData[0]['id_masterpembeli']) {
                    $jenis_pembeli = 'IUP OPK Pengangkutan dan Penjualan';
                    $pembeli = $data1->nama;
                }
            }
        }

        $pemasaranbb_partial = $db_2->table('pemasaran_bb_partial')
            ->where('pemasaran_bb_partial.id_pemasaran_bb', $id_pemasaran)
            ->where('pemasaran_bb_partial.no_tongkang', $no_tongkang)
            ->get();

        return view('surveyor.view_verifikasi', compact('cek', 'pembeli', 'pemasaranbb_partial', 'penjual'));
    }

    public function hasil_scan_mn($id, $tongkang, $kategori, $id_pembeli)
    {
        $db_2 = \DB::connection('pgsql2');
        $id_pemasaran = base64_decode($id);
        $no_tongkang = $tongkang;
        $kategori_pembeli = $kategori;
        $id_masterpembeli = base64_decode($id_pembeli);
        $response = $db_2->table('pemasaran_mn')
            ->join('final_pemasaran_mn', 'pemasaran_mn.id_pemasaran_mn', 'final_pemasaran_mn.id_pemasaran_mn')
            ->join('master_jenis_penjualan', 'pemasaran_mn.jenis_pemasaran', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_mn.id_pemasaran_mn', $id_pemasaran)
            ->get();
        $cek = json_decode($response, true);
        $id_detail =  $db_2->table('pemasaran_mn_partial')->select('id_detail')->where('id_pemasaran_mn', $id_pemasaran)
            ->first();
        $pemasaranbb_partial = $db_2->table('pemasaran_mn_partial')->where('id_detail', $id_detail->id_detail)->get();
        $tongkang = '';
        $tugboat = '';
        $volume = '';
        $sts = '';
        $no_lhv = '';
        $zz = 0;
        $id_pelapor =  $response[0]->pelapor;

        $perusahaan = $db_2->table('perusahaan')->where('id_perusahaan', $id_pelapor)->get();

        for ($zz = 0; $zz < count($pemasaranbb_partial); $zz++) {
            if ($no_tongkang == $pemasaranbb_partial[$zz]->no_tongkang) {
                $tongkang = $pemasaranbb_partial[$zz]->nama_tongkang;
                $tugboat = $pemasaranbb_partial[$zz]->tag_boat;
                $volume = $pemasaranbb_partial[$zz]->volume;
                $sts = $pemasaranbb_partial[$zz]->status_cetak_lhv;
                $no_lhv = $pemasaranbb_partial[$zz]->no_lhv;
            }
        }
        return view('surveyor.view_verifikasi_mn', compact('cek', 'no_lhv', 'tongkang', 'volume', 'tugboat', 'sts', 'perusahaan'));
    }

    public function hasil_scan_vessel($id, $volumes)
    {
        $id_pemasaran = base64_decode($id);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => Helper::API() . "Pemasaran_BB/" . $id_pemasaran,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "Authorization:" . Helper::APIToken(),
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $cek = json_decode($response, true);
        //dd($cek);
        $curl1 = curl_init();
        curl_setopt_array($curl1, array(
            CURLOPT_URL => Helper::API() . "Perusahaan",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "Authorization:" . Helper::APIToken(),
            ),

        ));

        $response1 = curl_exec($curl1);
        $err1 = curl_error($curl1);
        curl_close($curl1);
        $DataPerusahaan = json_decode($response1, true);
        $pembeli = '';
        $dat = User::all();
        $kategori_pembeli = $cek['data']['0']['kategori_pembeli'];
        if ($kategori_pembeli == 2) {
            $pembeli = $cek['data']['0']['data_pembeli']['0']['nama_pembeli'];
        } else if ($kategori_pembeli != 3) {
            foreach ($dat as $data) {
                if ($data->id_perusahaan == $cek['data'][0]['id_masterpembeli']) {
                    $pembeli = $data->nama;
                }
            }
        } else {
            $x = 0;
            for ($x = 0; $x < count($DataPerusahaan['data'][0]['perusahaan']); $x++) {
                if ($cek['data'][0]['id_masterpembeli'] == $DataPerusahaan['data'][0]['perusahaan'][$x]['id_perusahaan']) {
                    $pembeli = $DataPerusahaan['data'][0]['perusahaan'][$x]['nama'];
                }
            }
        }

        $cek_final = $this->cekdouble($cek['data']['0']['id_transaksi']);

        $result_cekfinal = json_decode($cek_final, true);
        if ($result_cekfinal != '2') {
            $sts = 0;
        } else {
            $sts = 2;
        }

        return view('surveyor.view_vessel', compact('cek', 'sts', 'pembeli', 'volumes'));
    }

    public function laporan_lhv_mvp($id)
    {
        $db_2 = \DB::connection('pgsql2');

        $id_pemasaran = base64_decode($id);
        $query = DB::table('pemasaran_bb')->where('id_pemasaran_bb', base64_decode($id_pemasaran))->get();

        $perusahaan = DB::table('treader')->select('nama')->where('id_perusahaan', $query[0]->pelapor)->get();
        $penjual = $perusahaan[0]->nama;
        $dat = User::all();
        $get_provinsi = $db_2->table('master_provinsi')->where('id_provinsi', $query[0]->lokasi_pelabuhan)->get();
        $provinsi = $get_provinsi[0]->nama_provinsi;
        $JSONData = json_decode($query, true);
        $id_user = $query[0]->pelapor;
        if ($JSONData[0]['kategori_pembeli'] == 3) {
            $pembelis = $db_2->table('perusahaan')->select('nama')->where('id_perusahaan', $query[0]->id_masterpembeli)->get();
            $jenis_pembeli = 'IUP PKP2B';
            $pembeli = $pembelis[0]->nama;
        } else if ($JSONData[0]['kategori_pembeli'] == 2) {
            $pembelis = $db_2->table('master_pembeli')->select('nama_pembeli')->where('id_pembeli', $query[0]->id_masterpembeli)->get();
            $jenis_pembeli = 'End User';
            $pembeli = $pembelis[0]->nama_pembeli;
        } else if ($JSONData[0]['kategori_pembeli'] == 5) {
            $pembelis = $db_2->table('master_stockpile')->select('nama_stockpile')->where('id_stockpile', $query[0]->id_masterpembeli)->get();
            $jenis_pembeli = 'Intermedite Stockpile';
            $pembeli = $pembelis[0]->nama_stockpile;
        } else {
            foreach ($dat as $data1) {
                if ($data1->id_perusahaan == $JSONData[0]['id_masterpembeli']) {
                    $jenis_pembeli = 'IUP OPK Pengangkutan dan Penjualan';
                    $pembeli = $data1->nama;
                }
            }
        }

        $sts = $JSONData[0]['status_cetak_lhv'];

        return view('surveyor.view_mvp', compact('JSONData', 'sts', 'pembeli', 'penjual'));
    }

    public function cekdouble($no_transaksi)
    {
        $db_2 = \DB::connection('pgsql2');
        $query = $db_2->table('pemasaran_bb')->where('id_transaksi', $no_transaksi)->get();
        $data = Count($query);
        return $data;
    }
}
