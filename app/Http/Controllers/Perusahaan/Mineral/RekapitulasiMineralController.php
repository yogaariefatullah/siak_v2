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
use Yajra\Datatables\Datatables;

use App\Models\PemasaranBB;
use App\Models\Pembelian;
use App\Models\Trader;

class RekapitulasiMineralController extends Controller
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
        $db_2 = \DB::connection('pgsql2');
        // $data['id_perusahaan'] = Auth::guard('traders')->user()->id_perusahaan;
        $id_user = Auth::guard('traders')->user()->id_perusahaan;
        $balance = DB::table('inventori_trader')
            ->where('id_trader', $id_user)
            ->get();
        for ($i = 0; $i < count($balance); $i++) {
            $nama = $db_2->table('perusahaan')->where('id_perusahaan', $balance[$i]->id_perusahaan_kerjasama)->get();
            $nama2 = DB::table('treader')->where('id_perusahaan', $balance[$i]->id_perusahaan_kerjasama)->get();

            if (Count($nama) == 1) {
                $perusahaan = $db_2->table('perusahaan')->where('id_perusahaan', $balance[$i]->id_perusahaan_kerjasama)->get();
                $data[$i]['nama_perusahaan'] = $perusahaan[0]->nama;
                $data[$i]['jenis_perusahaan'] = 'IUP OP/ PKB2B / IUPK';
            } else if (Count($nama2) == 1) {
                $perusahaan2 = DB::table('treader')->where('id_perusahaan', $balance[$i]->id_perusahaan_kerjasama)->get();
                //dd( $perusahaan2 );
                $data[$i]['nama_perusahaan'] = $perusahaan2[0]->nama;
                $data[$i]['jenis_perusahaan'] = 'IUP OPK Pengangkutan / Penjualan';
            } else {
                $data[$i]['nama_perusahaan'] = '-';
                $data[$i]['jenis_perusahaan'] = '-';
            }

            $data[$i]['id_perusahaan'] = $balance[$i]->id_perusahaan_kerjasama;
            $data[$i]['volume'] = $balance[$i]->volume;
            $data[$i]['sisa_inventori'] = $this->get_inventori($balance[$i]->id_perusahaan_kerjasama, $id_user);
        }
        dd($balance);
        $total = DB::table('inventori_trader')
            ->where('id_trader', $id_user)
            ->sum('volume');
        return view('perusahaan.rekapitulasi.index', compact('balance', 'data', 'total'));
    }

    protected function get_inventori($id_perusahaan_kerjasama, $id_trader)
    {
        $detail = DB::table('inventori_trader')
            ->where('id_trader', $id_trader)
            ->where('id_perusahaan_kerjasama', $id_perusahaan_kerjasama)
            ->sum('volume');
        return $detail;
    }

    public function detail_inventori($id_sk)
    {
        $decode = base64_decode($id_sk);
        
        $id_user = Auth::user()->id_perusahaan;
        $getdatapemasaran = DB::table('pemasaran_bb')->leftJoin('pemasaran_detail_vol', 'pemasaran_bb.id_pemasaran_bb', 'pemasaran_detail_vol.id_pemasaran_bb')
            ->where('pemasaran_bb.pelapor', $id_user)
            ->where('pemasaran_detail_vol.id_master_pembeli', $decode)
            ->wherenull('pemasaran_bb.deleted_at')
            ->orderBy('pemasaran_bb.created_at', 'DESC')
            ->get();
        
        $datapembelian = Pembelian::select('*')->where('id_pembeli', $id_user)->where('id_penjual', $decode)->get();
        $cek = get_nama_trader($decode);
        if($cek == '-'){
            $nama = get_nama_perusahaan_moms($decode);
        }else if ($cek != '-') {
            $nama = $cek;
        }else{
            $nama = '-';
        }
        return view('perusahaan.rekapitulasi.detail', compact('datapembelian', 'getdatapemasaran','nama'));
    }
}
