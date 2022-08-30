<?php

namespace App\Http\Controllers\Perusahaan\Mineral;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Webpatser\Uuid\Uuid;
use App\Models\Master_SK;
use App\Models\Trader;
use Yajra\Datatables\Datatables;


class VerifikasiMineralController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:traders');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id_perusahaan = Auth::guard('traders')->user()->id_perusahaan;
        $data['cek'] = '';
        $data['inventori'] = DB::table('inventori_trader')->where('id_trader', $id_perusahaan)->sum('volume');
        return view('perusahaan.mineral.verifikasi.index', $data);
    }

    public function getDataPemasaran()
    {
        $id_perusahaan = Auth::guard('traders')->user()->id_perusahaan;
        $cek_inventory = DB::table('inventori_trader')->where('id_trader', $id_perusahaan)->sum('volume');
        $dat = Trader::all();
        $data = [];
        $no = 1;

        $id_masterpembeli = $id_perusahaan;
        $db_2 = \DB::connection('pgsql2');
        $query = $db_2->table('pemasaran_mn')
            ->join('final_pemasaran_mn', 'pemasaran_mn.id_pemasaran_mn', 'final_pemasaran_mn.id_pemasaran_mn')
            ->where('date', '>=', '2019-09-13 00:00:00')
            ->where('id_masterpembeli', $id_masterpembeli)
            ->where('pemasaran_mn.status_konfirmasi', null)
            ->where('pemasaran_mn.deleted_at', null)
            ->where('pemasaran_mn.jenis_laporan', 'provisional')
            ->orderby('date', 'desc')
            ->get();
        $result = json_decode($query, true);
        $nama = '';
        for ($i = 0; $i < count($result); $i++) {
            $data1 = $db_2->table('perusahaan')->where('id_perusahaan', $result[$i]['pelapor'])->first();
            $pembeli = $data1->nama;
            $data[$i]['no'] = $no++;
            $data[$i]['id_pemasaran_mn'] = $result[$i]['id_pemasaran_mn'];
            $data[$i]['jenis_laporan'] = $result[$i]['jenis_laporan'];
            $data[$i]['pelabuhan_asal'] = $result[$i]['pelabuhan_asal'];
            $data[$i]['pelabuhan_tujuan'] = $result[$i]['pelabuhan_tujuan'];
            $data[$i]['date'] = tgl_indo(date('Y-m-d', strtotime($result[$i]['date'])));
            $data[$i]['id_transaksi'] = $result[$i]['id_transaksi'];
            $data[$i]['penjual'] = $pembeli;
            $data[$i]['action'] = '<center>';
            $data[$i]['action'] .= '<a onclick="return showDetail(\'' . $result[$i]['id_pemasaran_mn'] . '\')" class="btn btn-primary btn-icon" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-search-plus" aria-hidden="true"></i></a>';
            $data[$i]['action'] .= '</center>';
        }

        return Datatables::of($data)
            ->make(true);
    }

    public function data_pemasaran_trader()
    {
        $id_perusahaan = Auth::guard('traders')->user()->id_perusahaan;
        $cek_inventory = DB::table('inventori_trader')->where('id_trader', $id_perusahaan)->sum('volume');

        $dat = Trader::all();
        $data = [];
        $no = 1;
        $db_2 = \DB::connection('pgsql2');
        $res = DB::table('pemasaran_mn')->where('id_masterpembeli',  $id_perusahaan)
            ->where('deleted_at', null)
            // ->where('status_konfirmasi', null)
            ->get();
        $result = json_decode($res, true);
        //dd($result);

        $nama = '';
        for ($i = 0; $i < count($result); $i++) {
            $perusahaan = DB::table('treader')->where('id_perusahaan', $result[$i]['pelapor'])->first();
            // foreach ($dat as $data1) {
            if (!empty($perusahaan)) {
                $pembeli = $perusahaan->nama;
            } else {
                $pembeli = '-';
            }
            // }

            $data[$i]['no'] = $no++;
            $data[$i]['id_pemasaran_mn'] = $result[$i]['id_pemasaran_mn'];
            $data[$i]['jenis_laporan'] = '-';
            $data[$i]['pelabuhan_asal'] = $result[$i]['pelabuhan_asal'];
            $data[$i]['pelabuhan_tujuan'] = $result[$i]['pelabuhan_tujuan'];
            $data[$i]['date'] = tgl_indo(date('Y-m-d', strtotime($result[$i]['date'])));
            $data[$i]['id_transaksi'] = $result[$i]['id_transaksi'];
            $data[$i]['penjual'] = $pembeli;
            $data[$i]['action'] = '<center>';
            $data[$i]['action'] .= '<a onclick="return showtrader(\'' . $result[$i]['id_pemasaran_mn'] . '\')" class="btn btn-primary btn-icon" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-search-plus" aria-hidden="true"></i></a>';
            $data[$i]['action'] .= '</center>';
        }

        return Datatables::of($data)
            ->make(true);
    }

    public function detail(Request $req)
    {
        $id_pemasaran = $req->get('id_pemasaran');
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('pemasaran_mn')
            ->join('final_pemasaran_mn', 'pemasaran_mn.id_pemasaran_mn', 'final_pemasaran_mn.id_pemasaran_mn')
            // ->join('master_jenis_penjualan', 'pemasaran_mn.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_mn.id_pemasaran_mn', $id_pemasaran)
            ->get();
        // dd($data);
        $perusahaan = $db_2->table('perusahaan')->select('nama')->where('id_perusahaan', $data[0]->pelapor)->get();
        $penjual = $perusahaan[0]->nama;


        /* detail volume pencampur */
        return view('perusahaan.mineral.verifikasi.detail', compact('data', 'penjual'));
    }

    public function detail_trader(Request $req)
    {

        $id_pemasaran = $req->get('id_pemasaran');
        // $db_2 = \DB::connection('pgsql2');
        $data = DB::table('pemasaran_mn')
            ->where('id_pemasaran_mn', $id_pemasaran)
            ->get();

        // $perusahaan = DB::table('treader')->where('id_perusahaan', $data[0]->pelapor)->get();
        $penjual = get_nama_trader($data[0]->pelapor);
        // dd($penjual);
        $result = DB::table('pemasaran_detail_vol')->where('id_pemasaran_mn', $id_pemasaran)->get();

        /* detail volume pencampur */
        return view('perusahaan.mineral.verifikasi.detail_trader', compact('data', 'penjual', 'result'));
    }

    public function reject(Request $req, $id_pemasaran)
    {
        $data = [
            "id_pemasaran_mn" => $id_pemasaran,
            "alasan" => $req->alasan,
        ];
        try {
            $db_2 = \DB::connection('pgsql2');
            $data = $db_2->table('pemasaran_mn')
                ->where('id_pemasaran_mn', $id_pemasaran)
                ->update(['status_konfirmasi' => false, 'alasan_tolak_transaksi' => $req->alasan]);

            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error']);
        }
    }

    public function accepted($id_pemasaran)
    {
        $data = [
            "id_pemasaran_mn" => $id_pemasaran,
        ];

        try {
            $db_2 = \DB::connection('pgsql2');
            $data = $db_2->table('pemasaran_mn')
                ->where('id_pemasaran_mn', $id_pemasaran)
                ->update(['status_konfirmasi' => true]);
            return redirect()->back()->with(["success" => "Diterima"]);
        } catch (Exception $e) {
            return redirect()->back()->with(["error" => "Gagal"]);
        }
    }

    public function accepted_trader($id_pemasaran)
    {
        $data = DB::table('pemasaran_mn')
            ->where('id_pemasaran_mn', $id_pemasaran)
            ->update(['status_konfirmasi' => true]);
        $pemasaran = DB::table('pemasaran_mn')
            ->where('id_pemasaran_mn', $id_pemasaran)->first();
        $detail = DB::table('pemasaran_detail_vol')
            ->where('id_pemasaran_mn', $id_pemasaran)->first();

        if (empty($pemasaran->id_surveyor)) {
            $is_pemilik = DB::table('inventori_trader')
                ->where('id_trader', $pemasaran->id_masterpembeli)->where('id_perusahaan_kerjasama', $pemasaran->pelapor)
                ->count();
            if ($is_pemilik == 0) {
                DB::table('inventori_trader')->insert([
                    'id_inven' => Uuid::generate(4),
                    'id_trader' => $pemasaran->id_masterpembeli,
                    'id_perusahaan_kerjasama' => $pemasaran->pelapor,
                    'volume' => $pemasaran->total_volume,
                    'create_at' => date('Y-m-d H:i:s'),
                ]);
            } else {
                $existing_invent = DB::table('inventori_trader')
                    ->where('id_trader', $pemasaran->id_masterpembeli)->where('id_perusahaan_kerjasama', $pemasaran->pelapor)
                    ->sum('volume');

                $jumlah = $pemasaran->total_volume + $existing_invent;
                DB::table('inventori_trader')
                    ->where('id_trader', $pemasaran->id_masterpembeli)
                    ->where('id_perusahaan_kerjasama', $pemasaran->pelapor)
                    ->update([
                        'volume' => $jumlah,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            }
            // $dataPembelian = [
            //     'id_transaksi' => $pemasaran->id_transaksi,
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'id_pembeli' => $pemasaran->id_masterpembeli,
            //     'id_pembelian' => UUID::generate(4),
            //     'id_pemasaran' =>  $pemasaran->idpemasaran,
            //     'id_penjual' => $pemasaran->idpemasaran,
            //     'volume' => $pemasaran->total_volume,
            //     'nilai_invoice' => $pemasaran->invo,
            //     'status_transaksi' => 2,
            //     'id_lokasi_provinsi' => $pemasaran->provinsi_pelabuhan,
            // ];
            // Pembelian::insert($dataPembelian);
        }


        return redirect()->back()->with(["success" => "Diterima"]);
    }

    public function tolak_trader($id_pemasaran)
    {
        $data = DB::table('pemasaran_mn')
            ->where('id_pemasaran_mn', $id_pemasaran)
            ->update(['status_konfirmasi' => false]);
        $pemasaran = DB::table('pemasaran_mn')
            ->where('id_pemasaran_mn', $id_pemasaran)->first();
        $get_detail = DB::table('pemasaran_detail_vol')->where('id_pemasaran_mn', $id_pemasaran)->get();


        for ($i = 0; $i < count($get_detail); $i++) {
            $vol_existing_sumber  = DB::table('inventori_trader')
                ->where('id_trader', $pemasaran->pelapor)->where('id_perusahaan_kerjasama', $get_detail[$i]->id_master_pembeli)
                ->sum('volume');
            $rollback_volume = $vol_existing_sumber + $get_detail[$i]->volume;
            DB::table('inventori_trader')
                ->where('id_trader', $pemasaran->pelapor)->where('id_perusahaan_kerjasama', $get_detail[$i]->id_master_pembeli)
                ->update([
                    'volume' => $rollback_volume,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
        }
        return redirect()->back()->with(["success" => "Diterima"]);
    }
}
