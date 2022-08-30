<?php

namespace App\Http\Controllers\Perusahaan\Batubara;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class PembelianController extends Controller
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
        $data['id_perusahaan'] = Auth::guard('traders')->user()->id_perusahaan;
        return view('perusahaan.batubara.pembelian.index', $data);
    }

    public function data_pembelian()
    {
        $id_perusahaan = Auth::guard('traders')->user()->id_perusahaan;
        $data = [];
        $no = 1;
        $db_2 = \DB::connection('pgsql2');
        $query = DB::table('pembelian')->where('id_pembeli', $id_perusahaan)->get();
        $result = json_decode($query, true);
        //dd($result);


        for ($i = 0; $i < count($result); $i++) {

            $data[$i]['no'] = $no++;
            $data[$i]['id_pembelian'] = $result[$i]['id_pembelian'];
            $data[$i]['volume'] = number_format($result[$i]['volume'], 4, ',', '.');
            $data[$i]['penjual'] = ($result[$i]['status_transaksi'] == 1) ? get_nama_perusahaan_moms($result[$i]['id_penjual']) : get_nama_trader($result[$i]['id_penjual']);
            $data[$i]['status_transaksi'] = ($result[$i]['status_transaksi'] == 1) ? 'IUP OP / PKB2B' : 'IUP OPK Angkut Jual';
            $data[$i]['nilai_invoice'] = number_format($result[$i]['nilai_invoice'], 2, ',', '.');
            $data[$i]['id_transaksi'] = $result[$i]['id_transaksi'];
            $data[$i]['action'] = '<center>';
            if ($result[$i]['status_transaksi'] == 1) {
                $data[$i]['action'] .= '<a onclick="return showDetail(\'' . $result[$i]['id_pemasaran'] . '\')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-search-plus" aria-hidden="true"></i></a>';
            } else {
                $data[$i]['action'] .= '<a onclick="return showtrader(\'' . $result[$i]['id_pemasaran'] . '\')" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-search-plus" aria-hidden="true"></i></a>';
            }
            $data[$i]['action'] .= '</center>';
        }

        return Datatables::of($data)
            ->make(true);
    }

    public function detail(Request $req)
    {
        $id_pemasaran = $req->get('id_pemasaran');
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
            ->get();

        $perusahaan = $db_2->table('perusahaan')->select('nama')->where('id_perusahaan', $data[0]->pelapor)->get();
        $penjual = $perusahaan[0]->nama;

        $result = $db_2->table('detail_pemasaran')->leftjoin('perusahaan', 'perusahaan.id_perusahaan', 'detail_pemasaran.id_penjual')->where('id_pemasaran_bb', $id_pemasaran)->get();

        /* detail volume pencampur */
        return view('perusahaan.batubara.pembelian.detail', compact('data', 'penjual', 'result'));
    }

    public function detail_trader(Request $req)
    {
        $id_pemasaran = $req->get('id_pemasaran');
        $data = DB::table('pemasaran_bb')
            ->where('id_pemasaran_bb', $id_pemasaran)
            ->get();
        $penjual = get_nama_trader($data[0]->pelapor);
        $result = DB::table('pemasaran_detail_vol')->where('id_pemasaran_bb', $id_pemasaran)->get();

        /* detail volume pencampur */
        return view('perusahaan.batubara.pembelian.detail_trader', compact('data', 'penjual', 'result'));
    }
}
