<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

use App\Master_SK;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:adminstrator');
    }

    public function index()
    {
        $datenow = '2019'/*date('Y')*/;
        $data["datenow"] = $datenow;

        $data["trader"] = count(DB::table('treader')->where('jenis_komoditas', 'b40a547d-dc5e-4bc0-b062-738f34e73922')
                            ->where('aktifasi', true)
                            ->get());

        $data["surveyor"] = count(DB::table('surveyor')->where('mineral', true)->where('aktifasi', true)
                            ->whereNotNull('id_perusahaan_surveyor')
                            ->get());

        $data["surveyor_lhv_trader"] = DB::table('pemasaran_bb')->leftjoin('surveyor','surveyor.uuid','=','pemasaran_bb.id_surveyor')
                             ->leftjoin('profile_surveyor','pemasaran_bb.id_surveyor','=','profile_surveyor.id_surveyor')
                             ->select(DB::raw('count(pemasaran_bb.id_surveyor) as count, surveyor.name, profile_surveyor.file, profile_surveyor.alamat'))
                             ->where('pemasaran_bb.status_surveyor', '1')
                             ->whereYear('pemasaran_bb.date', $datenow)
                             ->groupBy('surveyor.name','profile_surveyor.file','profile_surveyor.alamat')
                             ->orderby('count','desc')
                             ->limit(3)
                             ->get();


        //Total Transaksi LHV
        $data["total_lhv_trader"] = DB::table('pemasaran_bb')->where('status_surveyor','1')->whereYear('date', $datenow)->count('id_pemasaran_bb');
        $data["total_lhv_bulan1"] = DB::table('pemasaran_bb')->whereMonth('date', '01')->whereYear('date', $datenow)->where('status_surveyor','1')->count('id_pemasaran_bb');
        $data["total_lhv_bulan2"] = DB::table('pemasaran_bb')->whereMonth('date', '02')->whereYear('date', $datenow)->where('status_surveyor','1')->count('id_pemasaran_bb');
        $data["total_lhv_bulan3"] = DB::table('pemasaran_bb')->whereMonth('date', '03')->whereYear('date', $datenow)->where('status_surveyor','1')->count('id_pemasaran_bb');
        $data["total_lhv_bulan4"] = DB::table('pemasaran_bb')->whereMonth('date', '04')->whereYear('date', $datenow)->where('status_surveyor','1')->count('id_pemasaran_bb');
        $data["total_lhv_bulan5"] = DB::table('pemasaran_bb')->whereMonth('date', '05')->whereYear('date', $datenow)->where('status_surveyor','1')->count('id_pemasaran_bb');
        $data["total_lhv_bulan6"] = DB::table('pemasaran_bb')->whereMonth('date', '06')->whereYear('date', $datenow)->where('status_surveyor','1')->count('id_pemasaran_bb');
        $data["total_lhv_bulan7"] = DB::table('pemasaran_bb')->whereMonth('date', '07')->whereYear('date', $datenow)->where('status_surveyor','1')->count('id_pemasaran_bb');
        $data["total_lhv_bulan8"] = DB::table('pemasaran_bb')->whereMonth('date', '08')->whereYear('date', $datenow)->where('status_surveyor','1')->count('id_pemasaran_bb');
        $data["total_lhv_bulan9"] = DB::table('pemasaran_bb')->whereMonth('date', '09')->whereYear('date', $datenow)->where('status_surveyor','1')->count('id_pemasaran_bb');
        $data["total_lhv_bulan10"] = DB::table('pemasaran_bb')->whereMonth('date', '10')->whereYear('date', $datenow)->where('status_surveyor','1')->count('id_pemasaran_bb');
        $data["total_lhv_bulan11"] = DB::table('pemasaran_bb')->whereMonth('date', '11')->whereYear('date', $datenow)->where('status_surveyor','1')->count('id_pemasaran_bb');
        $data["total_lhv_bulan12"] = DB::table('pemasaran_bb')->whereMonth('date', '12')->whereYear('date', $datenow)->where('status_surveyor','1')->count('id_pemasaran_bb');


        // total ton pemasaran All
        $total_pemasaran_bulan1 = DB::table('pemasaran_bb')->whereMonth('date', '01')->whereYear('date', $datenow)->sum('total_volume');
        $total_pemasaran_bulan1 = ($total_pemasaran_bulan1 != 0) ? $total_pemasaran_bulan1 : 0;
        $data["total_pemasaran_bulan1"] = round($total_pemasaran_bulan1 / 1000000000, 2);

        $total_pemasaran_bulan2 = DB::table('pemasaran_bb')->whereMonth('date', '02')->whereYear('date', $datenow)->sum('total_volume');
        $total_pemasaran_bulan2 = ($total_pemasaran_bulan2 != 0) ? $total_pemasaran_bulan2 : 0;
        $data["total_pemasaran_bulan2"] = round($total_pemasaran_bulan2 / 1000000000, 2);

        $total_pemasaran_bulan3 = DB::table('pemasaran_bb')->whereMonth('date', '03')->whereYear('date', $datenow)->sum('total_volume');
        $total_pemasaran_bulan3 = ($total_pemasaran_bulan3 != 0) ? $total_pemasaran_bulan3 : 0;
        $data["total_pemasaran_bulan3"] = round($total_pemasaran_bulan3 / 1000000000, 2);

        $total_pemasaran_bulan4 = DB::table('pemasaran_bb')->whereMonth('date', '04')->whereYear('date', $datenow)->sum('total_volume');
        $total_pemasaran_bulan4 = ($total_pemasaran_bulan4 != 0) ? $total_pemasaran_bulan4 : 0;
        $data["total_pemasaran_bulan4"] = round($total_pemasaran_bulan4 / 1000000000, 2);

        $total_pemasaran_bulan5 = DB::table('pemasaran_bb')->whereMonth('date', '05')->whereYear('date', $datenow)->sum('total_volume');
        $total_pemasaran_bulan5 = ($total_pemasaran_bulan5 != 0) ? $total_pemasaran_bulan5 : 0;
        $data["total_pemasaran_bulan5"] = round($total_pemasaran_bulan5 / 1000000000, 2);

        $total_pemasaran_bulan6 = DB::table('pemasaran_bb')->whereMonth('date', '06')->whereYear('date', $datenow)->sum('total_volume');
        $total_pemasaran_bulan6 = ($total_pemasaran_bulan6 != 0) ? $total_pemasaran_bulan6 : 0;
        $data["total_pemasaran_bulan6"] = round($total_pemasaran_bulan6 / 1000000000, 2);

        $total_pemasaran_bulan7 = DB::table('pemasaran_bb')->whereMonth('date', '07')->whereYear('date', $datenow)->sum('total_volume');
        $total_pemasaran_bulan7 = ($total_pemasaran_bulan7 != 0) ? $total_pemasaran_bulan7 : 0;
        $data["total_pemasaran_bulan7"] = round($total_pemasaran_bulan7 / 1000000000, 2);

        $total_pemasaran_bulan8 = DB::table('pemasaran_bb')->whereMonth('date', '08')->whereYear('date', $datenow)->sum('total_volume');
        $total_pemasaran_bulan8 = ($total_pemasaran_bulan8 != 0) ? $total_pemasaran_bulan8 : 0;
        $data["total_pemasaran_bulan8"] = round($total_pemasaran_bulan8 / 1000000000, 2);

        $total_pemasaran_bulan9 = DB::table('pemasaran_bb')->whereMonth('date', '09')->whereYear('date', $datenow)->sum('total_volume');
        $total_pemasaran_bulan9 = ($total_pemasaran_bulan9 != 0) ? $total_pemasaran_bulan9 : 0;
        $data["total_pemasaran_bulan9"] =  round($total_pemasaran_bulan9 / 1000000000, 2);

        $total_pemasaran_bulan10 = DB::table('pemasaran_bb')->whereMonth('date', '10')->whereYear('date', $datenow)->sum('total_volume');
        $total_pemasaran_bulan10 = ($total_pemasaran_bulan10 != 0) ? $total_pemasaran_bulan10 : 0;
        $data["total_pemasaran_bulan10"] = round($total_pemasaran_bulan10 / 1000000000, 2);

        $total_pemasaran_bulan11 = DB::table('pemasaran_bb')->whereMonth('date', '11')->whereYear('date', $datenow)->sum('total_volume');
        $total_pemasaran_bulan11 = ($total_pemasaran_bulan11 != 0) ? $total_pemasaran_bulan11 : 0;
        $data["total_pemasaran_bulan11"] = round($total_pemasaran_bulan11 / 1000000000, 2);

        $total_pemasaran_bulan12 = DB::table('pemasaran_bb')->whereMonth('date', '12')->whereYear('date', $datenow)->sum('total_volume');
        $total_pemasaran_bulan12 = ($total_pemasaran_bulan12 != 0) ? $total_pemasaran_bulan12 : 0;
        $data["total_pemasaran_bulan12"] = round($total_pemasaran_bulan12 / 1000000000, 2);

        $total_pemasaran_bulan = (float)$data["total_pemasaran_bulan1"] + (float)$data["total_pemasaran_bulan2"] + (float)$data["total_pemasaran_bulan3"] + (float)$data["total_pemasaran_bulan4"] + (float)$data["total_pemasaran_bulan5"] + (float)$data["total_pemasaran_bulan6"] + (float)$data["total_pemasaran_bulan7"] + (float)$data["total_pemasaran_bulan8"] + (float)$data["total_pemasaran_bulan9"] + (float)$data["total_pemasaran_bulan10"] + (float)$data["total_pemasaran_bulan11"] + (float)$data["total_pemasaran_bulan12"] ;
        $total_pemasaran_bulan = ($total_pemasaran_bulan != 0) ? $total_pemasaran_bulan : 0;
        $sementara = round($total_pemasaran_bulan, 2);
        $data["total_pemasaran_bulan"] = $sementara . ' B';

        // total ton pemasaran trader ke trader
        $total_pemasaran_trader = DB::table('pemasaran_bb')->where('kategori_pembeli','1')->whereYear('date', $datenow)->sum('total_volume');
        $total_pemasaran_trader = ($total_pemasaran_trader != 0) ? $total_pemasaran_trader : 0;
        $data["total_pemasaran_trader"] = round($total_pemasaran_trader / 1000000000, 2) . ' B';


        // total ton pemasaran tader ke enduser
        $total_pemasaran_enduser = DB::table('pemasaran_bb')->where('kategori_pembeli','2')->whereYear('date', $datenow)->sum('total_volume');
        $total_pemasaran_enduser = ($total_pemasaran_enduser != 0) ? $total_pemasaran_enduser : 0;
        $data["total_pemasaran_enduser"] = round($total_pemasaran_enduser / 1000000000, 2) . ' B';
        //total transaksi pemasaran trader ke enduser bulan
        $data["total_pemasaran_end_bulan1"] = DB::table('pemasaran_bb')
                                        ->where('kategori_pembeli','2')
                                        ->whereMonth('date', '01')->whereYear('date', $datenow)->count('id_pemasaran_bb');
        $data["total_pemasaran_end_bulan2"] = DB::table('pemasaran_bb')
                                        ->where('kategori_pembeli','2')
                                        ->whereMonth('date', '02')->whereYear('date', $datenow)->count('id_pemasaran_bb');
        $data["total_pemasaran_end_bulan3"] = DB::table('pemasaran_bb')
                                        ->where('kategori_pembeli','2')
                                        ->whereMonth('date', '03')->whereYear('date', $datenow)->count('id_pemasaran_bb');
        $data["total_pemasaran_end_bulan4"] = DB::table('pemasaran_bb')
                                        ->where('kategori_pembeli','2')
                                        ->whereMonth('date', '04')->whereYear('date', $datenow)->count('id_pemasaran_bb');
        $data["total_pemasaran_end_bulan5"] = DB::table('pemasaran_bb')
                                        ->where('kategori_pembeli','2')
                                        ->whereMonth('date', '05')->whereYear('date', $datenow)->count('id_pemasaran_bb');
        $data["total_pemasaran_end_bulan6"] = DB::table('pemasaran_bb')
                                        ->where('kategori_pembeli','2')
                                        ->whereMonth('date', '06')->whereYear('date', $datenow)->count('id_pemasaran_bb');
        $data["total_pemasaran_end_bulan7"] = DB::table('pemasaran_bb')
                                        ->where('kategori_pembeli','2')
                                        ->whereMonth('date', '07')->whereYear('date', $datenow)->count('id_pemasaran_bb');
        $data["total_pemasaran_end_bulan8"] = DB::table('pemasaran_bb')
                                        ->where('kategori_pembeli','2')
                                        ->whereMonth('date', '08')->whereYear('date', $datenow)->count('id_pemasaran_bb');
        $data["total_pemasaran_end_bulan9"] = DB::table('pemasaran_bb')
                                        ->where('kategori_pembeli','2')
                                        ->whereMonth('date', '09')->whereYear('date', $datenow)->count('id_pemasaran_bb');
        $data["total_pemasaran_end_bulan10"] = DB::table('pemasaran_bb')
                                        ->where('kategori_pembeli','2')
                                        ->whereMonth('date', '10')->whereYear('date', $datenow)->count('id_pemasaran_bb');
        $data["total_pemasaran_end_bulan11"] = DB::table('pemasaran_bb')
                                        ->where('kategori_pembeli','2')
                                        ->whereMonth('date', '11')->whereYear('date', $datenow)->count('id_pemasaran_bb');
        $data["total_pemasaran_end_bulan12"] = DB::table('pemasaran_bb')
                                        ->where('kategori_pembeli','2')
                                        ->whereMonth('date', '12')->whereYear('date', $datenow)->count('id_pemasaran_bb');


        //total transaksi pemasaran
        $data["total_pemasaran_bulan_transaksi"] = DB::table('pemasaran_bb')->whereYear('date', $datenow)->count('id_pemasaran_bb');


        return view('admin.dashboard', $data);
    }


    public static function getNotification()
    {
        $badge = Master_SK::join('treader', 'master_sk_induk.userid', 'treader.id_perusahaan')
            ->where('jenis_komoditas', '1b5f47a9-e6c9-46e2-b957-c113ef39c787')->where('status_approve', 0)->count();
        return $badge;
    }

    public function indexmineral()
    {
        return view('admin.dashboardmineral');
    }

    public function ListSK_All()
    {
        if (Auth::guard('adminstrator')->user()->type == 'BATUBARA') {
            $type = "1b5f47a9-e6c9-46e2-b957-c113ef39c787";
        } else {
            $type = "b40a547d-dc5e-4bc0-b062-738f34e73922";
        }

        $MST_SK = Master_SK::select('*')
                    ->join('treader', 'master_sk_induk.userid', '=', 'treader.id_perusahaan')
                    ->where('treader.jenis_komoditas', $type)
                    ->get();

        return view('admin.All_SK', compact('MST_SK'));
    }

    public function listsk_all_mineral()
    {

        $url = "listsk_all_mineral";
        $MST_SK = Master_SK::select('*')->join('treader', 'master_sk_induk.userid', '=', 'treader.id_perusahaan')->where('treader.jenis_komoditas', 'b40a547d-dc5e-4bc0-b062-738f34e73922')->get();
        return view('admin.All_SK', compact('MST_SK'));
    }

    public function ListSK_Detail($id_sk)
    {
        $data = [];
        $db_2 = \DB::connection('pgsql2');
        $detail_sk = DB::table('sk_detail')->where('id_sk', $id_sk)->get();
        $json = json_decode($detail_sk, true);
        //dd($json);
        for ($i = 0; $i < count($detail_sk); $i++) {
            $data[$i]['no'] = $i;
            $master_sk = DB::table('master_sk_induk')
                ->where('id_sk', $json[$i]['id_sk'])->get();

            $data[$i]['no_sk'] = $master_sk[0]->id_sk;
            $data[$i]['no_sk_no'] = $master_sk[0]->no_sk;
            $trader = DB::table('treader')->select('nama')->where('id_perusahaan', $master_sk[0]->userid)->get();
            $data[$i]['nama_pemilik'] = $trader[0]->nama;
            if ($json[$i]['jenis_perusahaan'] == 'IUP OP/ PKB2B / IUPK' || $json[$i]['jenis_perusahaan'] == 'IUP OP/ KK / IUPK') {
                $perusahaan = $db_2->table('perusahaan')->select('nama')->where('id_perusahaan', $json[$i]['id_trader'])->get();
                $penjual = $perusahaan[0]->nama;
            } else {
                $perusahaan = DB::table('treader')->select('nama')->where('id_perusahaan', $json[$i]['id_trader'])->get();
                $penjual = $perusahaan[0]->nama;
            }
            $data[$i]['nama_penambang'] = $penjual;
            $data[$i]['volume'] = $json[$i]['volume'];
            $jenis = '';
            if ($json[$i]['jenis_komoditas'] == '1b5f47a9-e6c9-46e2-b957-c113ef39c787') {
                $jenis = 'BATUBARA';
            } else {
                $jenis = 'MINERAL';
            }
            $data[$i]['jenis_perusahaan'] = $jenis;
            $data[$i]['status_approve'] = $json[$i]['status_approve'];
            $data[$i]['id'] = $json[$i]['id'];
            $data[$i]['id_perusahaan'] = $json[$i]['id_perusahaan'];
        }
        return $data;
    }

    public function approve_sk(Request $request)
    {

        //        dd('approve');die();
        $id_sk = $request->IDska;
        //        dd($id_sk);die();
        $checked_arr = $_POST['ck_sk'];
        $count = count($checked_arr);
        //dd($request->ck_sk);
        for ($i = 0; $i < $count; $i++) {
            $idsk_detail = $_POST["ck_sk"][$i];
            $data_detail = ['status_approve' => true];
            DB::table('sk_detail')->where('id', $idsk_detail)->update($data_detail);
        }

        $data = ['status_approve' => '1', 'alasan' => $request->alasan2];
        DB::table('master_sk_induk')->where('id_sk', $id_sk)->update($data);
        return Redirect::back()->with(['msg' => 'Berhasil']);
    }

    public function tolak_perusahaan(Request $request)
    {

        //        dd("tolak");die();
        $id_sk = $request->IDsk;
        $checked_arr = $_POST['ck_sk'];
        $count = count($checked_arr);
        for ($i = 0; $i < $count; $i++) {
            $idsk_detail = $_POST["ck_sk"][$i];
            $data_detail = ['status_approve' => false];
            DB::table('sk_detail')->where('id', $idsk_detail)->update($data_detail);
        }
        //
        //        $data = ['status_approve' => '1'];
        //        DB::table('master_sk_induk')->where('id_sk', $id_sk)->update($data);
        return Redirect::back()->with(['msg' => 'Berhasil Tolak Perusahaan']);
    }

    public function tolak_sk(Request $request)
    {

        $id_sk = $request->txtIDsktolak;
        $alasan = $request->alasan;

        $data = [
            'status_aktif' => '2',
            'status_approve' => '2',
            'alasan' => $alasan,
        ];
        $aksi = DB::table('master_sk_induk')->where('id_sk', $id_sk)->update($data);
        return Redirect::back()->with(['msg' => 'Berhasil Tolak SK']);
    }

    public function List_Pembelian()
    {
        $dataMT = Pembelian::dataPenambang();
        $dataTT = Pembelian::dataTrader();

        return view('admin.All_Pembelian', compact('dataMT', 'dataTT'));
    }
    //mineral
    public function list_pembelian_mineral()
    {
        $pembelian = PembelianMN::get();
        return view('admin.all_pembelian_mineral', compact('pembelian'));
    }

    public function getDetail($id_pembelian)
    {
        $kadar1 = '-';
        $kadar2 = '-';
        $kadar3 = '-';
        $kadar4 = '-';
        $kadar5 = '-';
        $nama_produk = '';
        $pembelian = PembelianMN::where('id_pembelian_mn', $id_pembelian)->first();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => Helper::API() . "master_kualitas",
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
        $responeJson = curl_exec($curl);
        $jsonDecode = json_decode($responeJson, true);

        //dd($jsonDecode);
        $output = '';
        $output .= '<div class="row">';
        $output .= '<div class="col-md-6">';
        $output .= '<table border="0">';
        $output .= '<tr>';
        $output .= '<td style="width:100px;">No.Referensi</td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td>' . $pembelian->id_transaksi . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td style="width:100px;">Pembeli</td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td>' . $this->getNamaPerusahaan($pembelian->id_penjual) . '</td>';
        $output .= '</tr>';
        $output .= '</table>';

        $output .= '</div>';

        $curl1 = curl_init();

        curl_setopt_array($curl1, array(
            CURLOPT_URL => Helper::API() . "master_produk",
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

        $respone = curl_exec($curl1);
        $json = json_decode($respone, true);
        for ($z = 0; $z < count($json['data']); $z++) {
            if ($json['data'][$z]['id_produk'] == $pembelian->id_produk) {
                $nama_produk = $json['data'][$z]['nama_produk'];
            }
        }
        $output .= '<div class="col-md-5">';
        $output .= '<table>';
        $output .= '<tr>';
        $output .= '<td style="width:50px;">Produk</td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td >' . $nama_produk . '</td>';
        $output .= '</tr>';
        $output .= '</table>';
        $output .= '</div>';
        $output .= '<br><br><br><br>';
        $output .= '<div class="col-md-12">';
        $output .= '<table border="0">';

        for ($y = 0; $y < count($jsonDecode['data']); $y++) {

            if ($jsonDecode['data'][$y]['id_kualitas'] == $pembelian->kualitas_1) {
                $kadar1 = $jsonDecode['data'][$y]['nama_kualitas'];
            }
            if ($jsonDecode['data'][$y]['id_kualitas'] == $pembelian->kualitas_2) {
                $kadar2 = $jsonDecode['data'][$y]['nama_kualitas'];
            }
            if ($jsonDecode['data'][$y]['id_kualitas'] == $pembelian->kualitas_3) {
                $kadar3 = $jsonDecode['data'][$y]['nama_kualitas'];
            }
            if ($jsonDecode['data'][$y]['id_kualitas'] == $pembelian->kualitas_4) {
                $kadar4 = $jsonDecode['data'][$y]['nama_kualitas'];
            }
            if ($jsonDecode['data'][$y]['id_kualitas'] == $pembelian->kualitas_5) {
                $kadar5 = $jsonDecode['data'][$y]['nama_kualitas'];
            }

        }

        $output .= '<tr>';
        $output .= '<td style="width:100px;">Kadar1</td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td >' . $kadar1 . '</td>';
        $output .= '<td style="width:100px;"><center>Nilai Kadar1</center></td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td >' . number_format($pembelian->jumlah_kualitas_1, 2, ",", ".") . ' ' . $pembelian->satuan_kadar_1 . '</td>';
        $output .= '<td style="width:100px;"><center>Ekuivalen1</center></td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td >' . number_format($pembelian->ekuivalen1, 2, ",", ".") . ' ' . $pembelian->satuan_ekuivalen_1 . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td style="width:100px;">Kadar2</td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td >' . $kadar2 . '</td>';
        $output .= '<td style="width:100px;"><center>Nilai Kadar2</center></td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td >' . number_format($pembelian->jumlah_kualitas_2, 2, ",", ".") . ' ' . $pembelian->satuan_kadar_2 . '</td>';
        $output .= '<td style="width:100px;"><center>Ekuivalen2</center></td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td >' . number_format($pembelian->ekuivalen2, 2, ",", ".") . ' ' . $pembelian->satuan_ekuivalen_2 . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td style="width:100px;">Kadar3</td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td >' . $kadar3 . '</td>';
        $output .= '<td style="width:100px;"><center>Nilai Kadar3</center></td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td >' . number_format($pembelian->jumlah_kualitas_3, 2, ",", ".") . ' ' . $pembelian->satuan_kadar_3 . '</td>';
        $output .= '<td style="width:100px;"><center>Ekuivalen3</center></td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td >' . number_format($pembelian->ekuivalen3, 2, ",", ".") . ' ' . $pembelian->satuan_ekuivalen_3 . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td style="width:100px;">Kadar4</td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td >' . $kadar4 . '</td>';
        $output .= '<td style="width:100px;"><center>Nilai Kadar4</center></td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td >' . number_format($pembelian->jumlah_kualitas_4, 2, ",", ".") . ' ' . $pembelian->satuan_kadar_4 . '</td>';
        $output .= '<td style="width:100px;"><center>Ekuivalen4</center></td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td >' . number_format($pembelian->ekuivalen4, 2, ",", ".") . ' ' . $pembelian->satuan_ekuivalen_4 . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td style="width:100px;">Kadar5</td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td >' . $kadar5 . '</td>';
        $output .= '<td style="width:100px;"><center>Nilai Kadar5</center></td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td >' . number_format($pembelian->jumlah_kualitas_5, 2, ",", ".") . ' ' . $pembelian->satuan_kadar_5 . '</td>';
        $output .= '<td style="width:100px;"><center>Ekuivalen5</center></td>';
        $output .= '<td style="width:30px;">:</td>';
        $output .= '<td >' . number_format($pembelian->ekuivalen5, 2, ",", ".") . ' ' . $pembelian->satuan_ekuivalen_5 . '</td>';
        $output .= '</tr>';
        $output .= '</table>';
        $output .= '</div>';
        $output .= '</div>';
        echo $output;
    }

    public function List_pemasaran()
    {
        $MST_SK = PemasaranBB::select('*')->get();
        return view('admin.All_Pemasaran', compact('MST_SK'));
    }

    public function list_pemasaran_mineral()
    {
        $MST_SK = PemasaranBB::select('*')->get();
        return view('admin.All_Pemasaran', compact('MST_SK'));
    }

    public function List_LHV()
    {

        return view('admin.All_lhv' /*,compact('lhv','jumlah' )*/);
    }

    public function admingetanylistlhv()
    {
        $db_2 = \DB::connection('pgsql2');

        $query = $db_2->table('pemasaran_bb_partial')
            ->join('pemasaran_bb', 'pemasaran_bb_partial.id_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb')
            ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_bb.date', '>=', '2019-09-13 00:00:00')
            ->get();
        $tmp_data = [];
        $pembeli = '';
        $dat = User::all();
        $xxxx = json_decode($query, true);
        for ($i = 0; $i < count($xxxx); $i++) {
            if ($xxxx[$i]['status_surveyor'] == 1) {
                $ss = 'Diterima';
            } elseif ($xxxx[$i]['status_surveyor'] == 2) {
                $ss = 'Ditolak';
            } else {
                $ss = 'Belum Diverifikasi';
            }
            if (!empty($xxxx[$i]['dokumen_lhv'])) {
                $doc = $xxxx[$i]['dokumen_lhv'];
            } else {
                $doc = 'Belum Di Upload';
            }

            if ($xxxx[0]['kategori_pembeli'] == 3) {
                $pembelis = $db_2->table('perusahaan')->select('nama')->where('id_perusahaan', $query[0]->id_masterpembeli)->get();
                $pembeli = $pembelis[0]->nama;
            } else if ($xxxx[0]['kategori_pembeli'] == 2) {
                $pembelis = $db_2->table('master_pembeli')->select('nama_pembeli')->where('id_pembeli', $query[0]->id_masterpembeli)->get();
                $pembeli = $pembelis[0]->nama_pembeli;
            } else if ($xxxx[0]['kategori_pembeli'] == 5) {
                $pembelis = $db_2->table('master_stockpile')->select('nama_stockpile')->where('id_stockpile', $query[0]->id_masterpembeli)->get();
                $pembeli = $pembelis[0]->nama_stockpile;
            } else {
                foreach ($dat as $data1) {
                    if ($data1->id_perusahaan == $xxxx[0]['id_masterpembeli']) {
                        $pembeli = $data1->nama;
                    }
                }
            }

            $actions = '<button onclick="return show(\'' . $xxxx[$i]['id_pemasaran_bb'] . '\')" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Detail</button>';
            $tmp_data[$i]['no'] = $i + 1;
            $tmp_data[$i]['id_pemasaran_bb'] = $xxxx[$i]['id_pemasaran_bb'];
            $tmp_data[$i]['tanggal'] = tanggal_indonesia::tgl_indo(date('Y-m-d', strtotime($xxxx[$i]['date'])));
            $perusahaan = $db_2->table('perusahaan')->select('nama')->where('id_perusahaan', $xxxx[$i]['pelapor'])->get();
            $tmp_data[$i]['penjual'] = $perusahaan[0]->nama;
            $tmp_data[$i]['pembeli'] = $pembeli;
            $surveyor = DB::table('surveyor')->select('name', 'uuid')->where('uuid', $xxxx[$i]['id_surveyor'])->get();
            $mantap = json_decode($surveyor, true);
            if (!empty($mantap)) {
                $tmp_data[$i]['surveyor'] = $mantap[0]['name'];
            } else {
                $tmp_data[$i]['surveyor'] = '';
            }
            $tmp_data[$i]['status'] = $ss;
            $tmp_data[$i]['dokumen_lhv'] = $doc;
            $tmp_data[$i]['actions'] = $actions;
        }
        return Datatables::of($tmp_data)
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function modal_lhv(Request $request)
    {

        $id_pemasaran = $request->get('id_pemasaran');
        //dd($id_pemasaran);
        $db_2 = \DB::connection('pgsql2');
        $dat = User::all();
        $query = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
            ->get();
            $pembeli ='';
        $xxxx = json_decode($query, true);
        for ($i = 0; $i < count($xxxx); $i++) {
            if ($xxxx[0]['kategori_pembeli'] == 3) {
                $pembelis = $db_2->table('perusahaan')->select('nama')->where('id_perusahaan', $query[0]->id_masterpembeli)->get();
                $pembeli = $pembelis[0]->nama;
            } else if ($xxxx[0]['kategori_pembeli'] == 2) {
                $pembelis = $db_2->table('master_pembeli')->select('nama_pembeli')->where('id_pembeli', $query[0]->id_masterpembeli)->get();
                $pembeli = $pembelis[0]->nama_pembeli;
            } else if ($xxxx[0]['kategori_pembeli'] == 5) {
                $pembelis = $db_2->table('master_stockpile')->select('nama_stockpile')->where('id_stockpile', $query[0]->id_masterpembeli)->get();
                $pembeli = $pembelis[0]->nama_stockpile;
            } else {
                foreach ($dat as $data1) {
                    if ($data1->id_perusahaan == $xxxx[0]['id_masterpembeli']) {
                        $pembeli = $data1->nama;
                    }
                }
            }
        }
        $perusahaan = $db_2->table('perusahaan')->select('nama')->where('id_perusahaan', $query[0]->pelapor)->get();
        $penjual = $perusahaan[0]->nama;

        $detail_tongkang = $db_2->table('pemasaran_bb_partial')->where('id_pemasaran_bb', $id_pemasaran)->get();

        return view('admin.modal_lhv', compact('query', 'dat', 'penjual', 'detail_tongkang','pembeli'));
    }

    public function List_Registrasi_Akun()
    {   
        return view('admin.All_UserRegist');
    }

    public function list_akun()
    {
        $url = "List_Registrasi_Akun";

        if (Auth::guard('adminstrator')->user()->type == 'MINERAL') {
            $user = DB::table('treader')
                ->where('jenis_komoditas', 'b40a547d-dc5e-4bc0-b062-738f34e73922')->get();
        } else {
            $user = DB::table('treader')
                ->where('jenis_komoditas', '1b5f47a9-e6c9-46e2-b957-c113ef39c787')->get();
        }

        $act = '';
        $tmp_data = [];
        for ($i = 0; $i < count($user); $i++) {
            $tmp_data[$i]['no'] = $i + 1;
            $tmp_data[$i]['id'] = $user[$i]->id;
            $tmp_data[$i]['nama'] = $user[$i]->nama;
            $tmp_data[$i]['email'] = $user[$i]->email;
            $url = url('storage/app/public/suratpenugasan');
            if ($user[$i]->surat_penugasan != null) {
                $surat = '<a target="_blank" rel="noopener noreferrer" href="' . $url . '/' . $user[$i]->surat_penugasan . '" class="label label-lg font-weight-bold label-inline label-light-info">Download</a>';
            } else {
                $surat = '';
            }
            $tmp_data[$i]['surat_penugasan'] = $surat;
            $status = '';
            if ($user[$i]->aktifasi == true) {
                $status = '<span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">AKTIF</span>';
            } else {
                $status = '<span class="label label-danger label-dot mr-2"></span><span class="font-weight-bold text-danger">NON-AKTIF</span>';
            }
            $tmp_data[$i]['aktifasi'] = $status;
            if ($user[$i]->aktifasi == false) {
                //href="admin/Active-Treader/'.$user[$i]->id.'"
                $act = '<center>
                        <a onclick="return delete_perusahaan(\'' . base64_encode($user[$i]->id_perusahaan) . '\')" class="btn btn-icon btn-light-danger" title="Hapus Perusahaan"><i class="flaticon2-trash"></i>
                        </a>&nbsp;
                        <a onclick="return viewandedit(\'' . base64_encode($user[$i]->id_perusahaan) . '\')" class="btn btn-icon btn-light-primary" title="Ubah Perusahaan"><i class="flaticon2-edit"></i>
                        </a>&nbsp;
                        <a onclick="return activate(\'' . base64_encode($user[$i]->id_perusahaan) . '\')" class="btn btn-icon btn-light-success" title="Aktifasi Perusahaan"><i class="flaticon2-checkmark"></i>
                        </a>&nbsp;
                        </center>';
            } else {
                $act = '<center>
                        <a onclick="return delete_perusahaan(\'' . base64_encode($user[$i]->id_perusahaan) . '\')" class="btn btn-icon btn-light-danger" title="Hapus Perusahaan"><i class="flaticon2-trash"></i>
                        </a>&nbsp;
                        <a onclick="return viewandedit(\'' . base64_encode($user[$i]->id_perusahaan) . '\')" class="btn btn-icon btn-light-primary" title="Ubah Perusahaan"><i class="flaticon2-edit"></i>
                        </a>&nbsp;
                        <a onclick="return tolakperusahaan(\'' . base64_encode($user[$i]->id_perusahaan) . '\')" class="btn btn-icon btn-light-danger" title="Non-Aktif Perusahaan"><i class="flaticon2-information"></i>
                        </a>&nbsp;
                        </center>';
            }
            $tmp_data[$i]['actions'] = $act;
        }
        //dd($tmp_data);
        return Datatables::of($tmp_data)
            ->rawColumns(['actions', 'surat_penugasan','aktifasi'])
            ->make();
    }

    public function list_registrasi_akun_mineral()
    {
        $url = "list_registrasi_akun_mineral";
        $MST_SK = User::select('*')->where('jenis_komoditas', 'b40a547d-dc5e-4bc0-b062-738f34e73922')->get();
        return view('admin.All_UserRegist', compact('MST_SK'));
    }

    public function active_treader($id)
    {

        $data = [
            'aktifasi' => 't',
            'alasan' => null,
        ];
        DB::table('treader')->where('id_perusahaan', $id)->update($data);
    }

    public function active_treadersk($id, $id_sk)
    {
        $data = ['aktifasi' => 't'];
        $data_SK = ['status_approve' => 't'];
        $ceksk = DB::table('sk_detail')->where('id_sk', $id_sk)
            ->where('id_perusahaan', $id)->update($data_SK);
        // $cek = DB::table('treader')->where('id_perusahaan', $id)->update($data);

        return Redirect::back()->with(['msg' => 'Ubah Status Perusahaan, Berhasil !']);
    }

    public function nonactive_treader(Request $request)
    {
        $id_perusahaan = $request->txtIDperusahaan;
        $flag = $request->txt_flag;
        $alasan = $request->alasan;
        //dd($flag);
        if ($flag == 'accept') {
            $this->active_treader($id_perusahaan);
        } else if ($flag == 'delete') {
            $data = [
                'aktifasi' => 'f',
                'alasan' => $alasan,
                'email' => uniqid() . "@rejects.com",
                'notrader' => null,
                'jenis_komoditas' => null,
                'remember_token' => null,
            ];
            DB::table('treader')->where('id_perusahaan', $id_perusahaan)->update($data);

        } else {
            $data = [
                'aktifasi' => 'f',
                'alasan' => $alasan,
            ];
            DB::table('treader')->where('id_perusahaan', $id_perusahaan)->update($data);

        }

        return Redirect::back()->with(['msg' => 'Berhasil Update Data']);
    }

    public function nonactive_treadersk($id, $id_sk)
    {

        $data = ['aktifasi' => 'f'];
        $data_SK = ['status_approve' => 'f'];
        $ceksk = DB::table('sk_detail')->where('id_sk', $id_sk)
            ->where('id_perusahaan', $id)->update($data_SK);
        return Redirect::back()->with(['msg' => 'Ubah Status Perusahaan, Berhasil !']);
    }

    public function list_trader()
    {
        $data = detail_sk::listskdistict();
        return view('admin.All_VerifTrader', compact('data'));
    }

    public static function getStatus($id_perusahaan)
    {
        $status = Helper::API_GET_STATUS_MISVERA($id_perusahaan);

        return $status;
    }

    public static function getStatustrader($id_perusahaan)
    {
        $status = DB::table('treader')->where('id_perusahaan', $id_perusahaan)->first();
        if ($status != null) {
            return ($status->aktifasi == true) ? "true" : "false";

        } else {
            return ("NULL");
        }

    }

    public static function getProvinsi($id_provinsi)
    {
        $provinsi = Helper::API_GET_PROVINSI($id_provinsi);
        return $provinsi;
    }

    public function detail_provinsi($id_provinsi)
    {
        $provinsi = Helper::API_GET_PROVINSI($id_provinsi);
        return $provinsi;
    }

    public static function getPerusahaan($id_perusahaan)
    {
        return Helper::API_GET_DETAIL_PERUSAHAAN($id_perusahaan);
    }

    public static function getPembeli($id_pembeli)
    {
        return Helper::API_GET_DETAIL_PEMBELI($id_pembeli);
    }

    public function update_status_misvera($id_perusahaan, $status)
    {

        $response = Helper::API_UPDATE_STATUS_MISVERA($id_perusahaan, $status);
        return redirect()->route('admin.listTrader')->with(['msg' => 'Ubah Status Perusahaan, Berhasil !']);

    }

    public function update_status_misverask($id_perusahaan, $status)
    {

        $response = Helper::API_UPDATE_STATUS_MISVERA($id_perusahaan, $status);
        //dd($response);die();
        return Redirect::back()->with(['msg' => 'Ubah Status Perusahaan, Berhasil !']);

    }

    public static function getTrader($id_perusahaan)
    {
        $data = DB::table('treader')->select('nama')->where('id_perusahaan', $id_perusahaan)->first();
        if ($data != null) {
            $nama = $data->nama;
        } else {
            $nama = '';
        }
        return $nama;
    }

    public function detail_pemasaran($id_pemasaran)
    {

        $data = Helper::API_GET_DETAIL_PEMASARAN_BB($id_pemasaran);
        return $data;

    }

    public function detail_pemasaran_tt($id_pemasaran)
    {

        $data = PemasaranBB::detailTT($id_pemasaran);
        return $data;
    }

    public static function getSurveyor($id_surveyor)
    {

        $data = DB::table('surveyor')->where('uuid', $id_surveyor)->first();
        return $data->name;
    }

    public function detail_lhv()
    {
        $data = Helper::API_GET_LHV();
        return $data;
    }

    public static function list_perusahaan_surveyor()
    {

        $data = DB::table('surveyor')->where('id_perusahaan_surveyor', null)->get();
        return view('admin.list_perusahaan_surveyor', compact('data'));
    }

    public function admingetanylistsurveyor()
    {
        $users = DB::table('surveyor')
        ->leftjoin('profile_surveyor','surveyor.uuid','=','profile_surveyor.id_surveyor')
        /*->select(['nama_pic', 'nama_dokumen', 'uuid', 'id', 'name', 'email', 'created_at', 'aktifasi'])*/
        ->whereNull('id_perusahaan_surveyor')->get();

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                $uuid = (string) $user->uuid;
                $uuidbaru = "'" . $uuid . "'";
                if ($user->aktifasi == false) {
                    $url1 = url('admin/aktifasi_surveyor/' . $user->uuid . '');
                    $actions = '<center>
                        <a href="' . $url1 . '" class="btn btn-icon btn-light-success" title="Aktif Perusahaan"><i class="flaticon2-checkmark"></i></a>&nbsp';
                } else {
                    $url1 = url('admin/nonaktifasi_surveyor/' . $user->uuid . '');
                    $actions = '<center>
                        <a href="' . $url1 . '" class="btn btn-icon btn-light-danger" title="Non Aktif Perusahaan"><i class="flaticon2-information"></i></a>&nbsp';
                }
                return $actions .
                '<a onclick="editps(' . $uuidbaru . ');" class="btn btn-icon btn-light-warning" title="Edit Perusahaan"><i class="flaticon2-edit"></i></a>
                </center>';
            })
            ->addColumn('aktifasi', function ($user) {
                if ($user->aktifasi == true) {
                    return '
                        <span class="label label-success label-dot mr-2"></span>
                        <span class="font-weight-bold text-success">AKTIF</span>
                    ';
                } else {
                    return '
                        <span class="label label-danger label-dot mr-2"></span>
                        <span class="font-weight-bold text-danger">NON AKTIF</span>
                    ';
                }
            })
            ->addColumn('name', function ($user) {
                return '
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50 flex-shrink-0">
                                        <img src="'. asset("logo_surveyor/").'/'. $user->file .'" alt="Logo" class="h-50">
                                    </div>
                                    <div class="ml-3">
                                        <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">'. $user->name .'</span>
                                        <a class="text-muted text-hover-primary">'. $user->email .'</a>
                                    </div>
                                </div>
                        ';
            })
            ->addColumn('email', function ($user) {
                return '
                                <center><a class="label label-lg font-weight-bold label-inline label-light-info" target="_blank" rel="noopener noreferrer" href=" '. asset("storage/app/public/suratpenugasansurveyor/").'/'. $user->nama_dokumen .' ">Download</a></center>
                        ';
            })
            ->rawColumns(['action','name','aktifasi','email'])
            ->make();
    }

    public static function list_petugas_verifikator()
    {
        //$data = DB::select("SELECT * FROM surveyor WHERE id_perusahaan_surveyor IS NOT NULL");
        return view('admin.list_petugas_surveyor' /*,compact('data')*/);
    }

    public function admingetanylistverifikator()
    {
        if (Auth::guard('adminstrator')->user()->type == 'MINERAL') {
            $users = DB::table('surveyor')
                ->whereNotNull('mineral')->whereNotNull('id_perusahaan_surveyor')->get();
        } else {
            $users = DB::table('surveyor')
                ->whereNotNull('id_perusahaan_surveyor')->get();
        }

        return Datatables::of($users)
            ->addColumn('provinsi', function ($user) {
                if($user->provinsi_satu != '-' && (!empty($user->provinsi_satu))){
                    if($user->provinsi_dua != '-' && (!empty($user->provinsi_dua))){
                        $db_2 = \DB::connection('pgsql2');
                        $provinsi1 = $db_2->table('master_provinsi')
                        ->select('nama_provinsi')
                        ->where('id_provinsi', $user->provinsi_satu)->first();
                        
                        $provinsi2 = $db_2->table('master_provinsi')
                        ->select('nama_provinsi')
                        ->where('id_provinsi', $user->provinsi_dua)->first();
        
                        $nama_provinsi = $provinsi1->nama_provinsi . ' , ' . $provinsi2->nama_provinsi;
                        return $provinsi1->nama_provinsi . '<br>' . $provinsi2->nama_provinsi;
                    }
                }
                })
            ->addColumn('action', function ($user) {
                $uuid = (string) $user->uuid;
                $uuidbaru = "'" . $uuid . "'";
                if ($user->aktifasi == false) {
                    //$url1 = url('admin/aktifasi_surveyor/' . $user->uuid . '');
                    $actions = '<center>
                        <a onclick="alasan(\'' . $user->uuid . '\',\'1\',\'' . $user->name . '&nbsp;(' . AdminController::getNamaPerusahaanSurveyor($user->id_perusahaan_surveyor) . ')' . '\')" class="btn btn-icon btn-light-success" title="Aktif Perusahaan"><i class="flaticon2-checkmark"></i></a>';
                } else {
                    //$url1 = url('admin/nonaktifasi_surveyor/' . $user->uuid . '');
                    $actions = '<center>
                        <a onclick="alasan(\'' . $user->uuid . '\',\'2\',\'' . $user->name . '&nbsp;(' . AdminController::getNamaPerusahaanSurveyor($user->id_perusahaan_surveyor) . ')' . '\')" class="btn btn-icon btn-light-danger" title="Non Aktif Perusahaan"><i class="flaticon2-information"></i></a>';
                }
                return $actions .
                '
                <a onclick="editps(' . $uuidbaru . ');" class="btn btn-icon btn-light-warning" title="Edit Data"><i class="flaticon2-edit"></i></a>
                <a target="_blank" rel="noopener noreferrer" href="' . asset('Upload_Dokumen/' . $user->file) . '" class="btn btn-icon btn-light-info" title="Download Dokumen"><i class="flaticon2-download-2"></i></a>
                </center>';
            })
            ->addColumn('name', function ($user) {
                return '
                                <div class="d-flex align-items-center">
                                    <div class="ml-3">
                                        <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">'. $user->name .'</span>
                                        <a class="text-muted text-hover-primary">'. $user->email .'</a>
                                    </div>
                                </div>
                        ';
            })
            ->addColumn('aktifasi', function ($user) {
                if ($user->aktifasi == true) {
                    return '
                        <span class="label label-success label-dot mr-2"></span>
                        <span class="font-weight-bold text-success">AKTIF</span>
                    ';
                } else {
                    return '
                        <span class="label label-danger label-dot mr-2"></span>
                        <span class="font-weight-bold text-danger">NON AKTIF</span>
                    ';
                }
            })
            ->editColumn('id_perusahaan_surveyor', function ($user) {
                return AdminController::getNamaPerusahaanSurveyor($user->id_perusahaan_surveyor);
            })
            ->rawColumns(['action','aktifasi','name','provinsi'])
            ->make();
    }

    public function active_disactive_petugas(Request $request){

        if($request->kat == 1){

            $data = [
                'aktifasi' => 't',
                'updated_at' => date('Y-m-d H:i:s'),
                'alasan' => $request->alasan 
            ];
            DB::table('surveyor')->where('uuid', $request->txtIDperusahaan)->update($data);
            return redirect()->route('admin.listpetugas')->with(['msg' => 'Berhasil Terima / Aktifasi Akun Petugas Surveyor']);

        }else{

            $data = [
                'aktifasi' => 'f',
                'updated_at' => date('Y-m-d H:i:s'),
                'alasan' => $request->alasan 
            ];
            DB::table('surveyor')->where('uuid', $request->txtIDperusahaan)->update($data);
            return redirect()->route('admin.listpetugas')->with(['msg' => 'Berhasil Tolak / Non Aktifasi Akun Petugas Surveyor']);

        }

    }

    public function getmastertrader()
    {
        $tmp_data = [];
        $no = 1;
        $jenis = '';

        if (Auth::guard('admin')->user()->type == 'MINERAL') {
            $select = DB::Table('master_trader')
                ->Where('jenis_komoditas', 'b40a547d-dc5e-4bc0-b062-738f34e73922')->get();
            for ($i = 0; $i < count($select); $i++) {
                $tmp_data[$i]['no'] = $no++;
                $tmp_data[$i]['no_trader'] = $select[$i]->nomertrader;
                $tmp_data[$i]['nama_trader'] = $select[$i]->nama;
                if ($select[$i]->jenis_komoditas == '1b5f47a9-e6c9-46e2-b957-c113ef39c787') {
                    $jenis = 'BATUBARA';
                } else {
                    $jenis = 'MINERAL';
                }
                $act = '<center><button onclick="return editps(\'' . $select[$i]->nomertrader . '\')" class="btn btn-cyan btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></button>&nbsp;</center>';
                $tmp_data[$i]['jenis'] = $jenis;
                $tmp_data[$i]['actions'] = $act;
            }
        } else {
            $select = DB::Table('master_trader')
                ->Where('jenis_komoditas', '1b5f47a9-e6c9-46e2-b957-c113ef39c787')->get();
            for ($i = 0; $i < count($select); $i++) {
                $tmp_data[$i]['no'] = $no++;
                $tmp_data[$i]['no_trader'] = $select[$i]->nomertrader;
                $tmp_data[$i]['nama_trader'] = $select[$i]->nama;
                if ($select[$i]->jenis_komoditas == '1b5f47a9-e6c9-46e2-b957-c113ef39c787') {
                    $jenis = 'BATUBARA';
                } else {
                    $jenis = 'MINERAL';
                }
                $act = '<center><button onclick="return editps(\'' . $select[$i]->nomertrader . '\')" class="btn btn-cyan btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></button>&nbsp;</center>';
                $tmp_data[$i]['jenis'] = $jenis;
                $tmp_data[$i]['actions'] = $act;
            }
        }

        return Datatables::of($tmp_data)
            ->rawColumns(['actions'])
            ->make(true);
    }
    public static function list_master_trader()
    {
        //$data = DB::select("SELECT * FROM surveyor WHERE id_perusahaan_surveyor IS NOT NULL");
        return view('admin.master_trader' /*,compact('data')*/);
    }

    public function aktifasi_surveyor($id)
    {

        $data = ['aktifasi' => 't'];
        DB::table('surveyor')->where('uuid', $id)->update($data);
        $select = DB::table('surveyor')->where('uuid', $id)->get();
        foreach ($select as $value) {
            $id_perusahaan_surveyor = $value->id_perusahaan_surveyor;
        }
        if ($id_perusahaan_surveyor == null) {
            return redirect()->route('admin.listps')->with(['msg' => 'Berhasil Aktifasi Akun Surveyor']);
        } else {
            return redirect()->route('admin.listpetugas')->with(['msg' => 'Berhasil Aktifasi Akun Petugas Surveyor']);
        }

    }

    public function nonaktifasi_surveyor($id)
    {

        $data = ['aktifasi' => 'f'];
        DB::table('surveyor')->where('uuid', $id)->update($data);
        $select = DB::table('surveyor')->where('uuid', $id)->get();
        foreach ($select as $value) {
            $id_perusahaan_surveyor = $value->id_perusahaan_surveyor;
        }
        if ($id_perusahaan_surveyor == null) {
            return redirect()->route('admin.listps')->with(['msg' => 'Berhasil Menonaktifkan Akun Surveyor']);
        } else {
            return redirect()->route('admin.listpetugas')->with(['msg' => 'Berhasil Menonaktifkan Akun Petugas Surveyor']);
        }
    }

    public function addperusahaansurveyor(Request $request)
    {

        $nama = $request->nama;
        $email = $request->email;
        $password = Hash::make($request->password);
        $datenow = date('Y-m-d H:i:s');
        $created_at = $datenow;
        $updated_at = $datenow;
        $uuid = Uuid::generate(4);
        $aktifasi = true;

        $idlast = DB::table('surveyor')->orderby('id','desc')->first();
        //dd($idlast->id + 1);

        if ($request->hasFile('uploadpenugasan')) {
            $filename = 'SP-' . uniqid() . '.' . $request->file("uploadpenugasan")->getClientOriginalExtension();
            $destination = public_path() . '/storage/app/public/suratpenugasansurveyor/';
            $request->file('uploadpenugasan')->move($destination, $filename);
        } else {
            $filename = null;
        }
        $id = DB::table('surveyor')->insert([
            'id' => $idlast->id + 1,
            'name' => $nama,
            'email' => $email,
            'password' => $password,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
            'uuid' => $uuid,
            'password_real' => $request->password,
            'aktifasi' => $aktifasi,
            'nama_pic' => $request->pic,
            'nama_dokumen' => $filename,
        ]);

        return redirect()->route('admin.listps')->with(['msg' => 'Berhasil, Input Perusahaan Surveyor']);
    }

    public function add_master_trader(Request $request)
    {

        $nama = $request->nama;
        $kode = $request->notrader;
        $jenis = $request->jenis;

        $id = DB::table('master_trader')->insert([
            'nomertrader' => $kode,
            'nama' => $nama,
            'jenis_komoditas' => $jenis,
        ]);

        return redirect()->route('admin.list_master_trader');
    }

    public function getnotrader(Request $request)
    {
        try {
            $id_notrader = $request->notrader;

            $nomertrader = DB::table('master_trader')->select('nomertrader')->where('nomertrader', $id_notrader)->first();

            if (Count($nomertrader) == 0) {
                $cek = Treader::Select('notrader')->where('notrader', $id_notrader)->first();

                $valid = Count($cek);
                $data = '';
                if (Count($cek) == 0) {
                    $data = '';
                    return view('auth.register.viewsadmin', compact('data'));
                } else {
                    $data = 'ada di LOGIN';
                    return view('auth.register.viewsadmin', compact('data'));
                }
            } else {
                $data = 'ada di Master';
                return view('auth.register.viewsadmin', compact('data'));
            }

        } catch (exception $e) {
            $x = $e->getMessage();
            //abort(404);
        }

    }

    public function editperusahaansurveyor($uuid)
    {
        $data = DB::table('surveyor')->where('uuid', $uuid)->get();
        return $data;
    }

    public function edit_trader($uuid)
    {
        $data = DB::table('treader')->where('id_perusahaan', $uuid)->get();
        return $data;
    }

    public function edit_master_trader($kode)
    {

        $data = DB::table('master_trader')->where('nomertrader', $kode)->get();
        return $data;

    }

    public function updateperusahaansurveyor(Request $request)
    {

        $nama = $request->nama;
        $email = $request->email;
        $password = Hash::make($request->password);
        $datenow = date('Y-m-d H:i:s');
        $updated_at = $datenow;
        $aktifasi = $request->status;
        if ($request->hasFile('uploadpenugasan')) {
            $filename = 'SP-' . uniqid() . '.' . $request->file("uploadpenugasan")->getClientOriginalExtension();
            $destination = public_path() . '/storage/app/public/suratpenugasansurveyor/';
            $request->file('uploadpenugasan')->move($destination, $filename);
        } else {
            $carifile = DB::table('surveyor')->where('uuid', $request->uuid)->get();
            foreach ($carifile as $value) {
                $filename = $value->nama_dokumen;
            }
        }

        $id = DB::table('surveyor')->where('uuid', $request->uuid)->update([
            'name' => $nama,
            'email' => $email,
            'password' => $password,
            'updated_at' => $updated_at,
            'password_real' => $request->password,
            'aktifasi' => $aktifasi,
            'nama_pic' => $request->pic,
            'nama_dokumen' => $filename,
        ]);

        return redirect()->route('admin.listps');
    }

    public function update_trader(Request $request)
    {
        $nama = $request->nama;
        $email = $request->email;
        $password = Hash::make($request->password);
        $datenow = date('Y-m-d H:i:s');
        $updated_at = $datenow;
        $aktifasi = false;

        $id = DB::table('treader')->where('id_perusahaan', $request->uuid)->update([
            'nama' => $nama,
            'email' => $email,
            'password' => $password,
            'updated_at' => $updated_at,
            'aktifasi' => $aktifasi,
            'pic' => $request->pic,
        ]);
        return redirect()->route('admin.registrasi_treader')->with(['msg' => 'Berhasil Update Data IUP OP ANGKUT JUAL']);
    }

    public function update_master_trader(Request $request)
    {

        $nama = $request->nama_trader;
        $jenis_kom = $request->jenis_kom;

        $id = DB::table('master_trader')->where('nomertrader', $request->kode)->update([
            'nama' => $nama,
            'jenis_komoditas' => $jenis_kom,
        ]);

        return redirect()->route('admin.list_master_trader');
    }

    public function updatepetugassurveyor(Request $request)
    {

        $nama = $request->nama;
        $email = $request->email;
        $password = Hash::make($request->password);
        $datenow = date('Y-m-d H:i:s');
        $updated_at = $datenow;
        $aktifasi = $request->status;

        $id = DB::table('surveyor')->where('uuid', $request->uuid)->update([
            'name' => $nama,
            'email' => $email,
            'password' => $password,
            'updated_at' => $updated_at,
            'password_real' => $request->password,
            'aktifasi' => $aktifasi,
        ]);

        return redirect()->route('admin.listpetugas')->with(['msg' => 'Berhasil Ubah Data Petugas Surveyor']);
    }

    public static function getNamaPembeli($uuid)
    {
        $res = DB::table('treader')->where('id_perusahaan', $uuid)->first();
        if (empty($res)) {
            return null;
        } else {
            return $res->nama;
        }
    }

    public static function getNamaPerusahaanSurveyor($uuid)
    {

        $res = DB::table('surveyor')->where('uuid', $uuid)->first();
        if (empty($res)) {
            return null;
        } else {
            return $res->name;
        }
    }

    //mineralnotif
    public static function getNotificationRegisterMN()
    {
        $hitung = User::where('jenis_komoditas', 'b40a547d-dc5e-4bc0-b062-738f34e73922')->where('aktifasi', false)->where('alasan', null)->count();
        return $hitung;
    }

    public static function getNotificationSkMN()
    {
        $badge = Master_SK::join('treader', 'master_sk_induk.userid', 'treader.id_perusahaan')
            ->where('jenis_komoditas', 'b40a547d-dc5e-4bc0-b062-738f34e73922')->where('status_approve', 0)->count();
        return $badge;
    }

    public static function getNamaPerusahaan($id_perusahaan)
    {

        return WSPenambang::API_GET_PENJUAL($id_perusahaan);
    }

    public static function getNamaTrader($id_penjual)
    {

        $data = DB::table('treader')->where('id_perusahaan', $id_penjual)->first();
        return $data->nama;
    }

    public static function getNamaProduk($id_produk)
    {

        return WSPenambang::API_GET_PRODUK($id_produk);
    }

}
