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
use Webpatser\Uuid\Uuid;

class PemasaranMineralController extends Controller
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
        return view('perusahaan.mineral.pemasaran.index', $data);
    }

    public function data_pemasaran()
    {
        $id_perusahaan = Auth::guard('traders')->user()->id_perusahaan;
        $data = [];
        $no = 1;
        $db_2 = \DB::connection('pgsql2');
        $query = DB::table('pemasaran_mn')->where('pelapor', $id_perusahaan)
            ->where('deleted_at', null)
            ->get();
        $result = json_decode($query, true);
        for ($i = 0; $i < count($result); $i++) {
            $data[$i]['no'] = $no++;
            $data[$i]['id_pemasaran_mn'] = $result[$i]['id_pemasaran_mn'];
            $data[$i]['date'] = tgl_indo(date('Y-m-d', strtotime($result[$i]['date'])));
            $data[$i]['id_transaksi'] = $result[$i]['id_transaksi'];
            $data[$i]['nama_kapal'] = $result[$i]['nama_kapal'];
            $data[$i]['provinsi_pelabuhan'] = get_provinsi_id($result[$i]['lokasi_pelabuhan']);
            if ($result[$i]['kategori_pembeli'] == "2") {
                $kategori = "End User";
                $pembeli = get_nama_master_pembeli_moms($result[$i]['id_masterpembeli']);
            } else {
                $kategori =  "IUP OPK Pengangkutan dan Penjualan";
                $pembeli = get_nama_trader($result[$i]['id_masterpembeli']);
            }
            $data[$i]['kategori'] = $kategori;
            $data[$i]['pembeli'] = $pembeli;
            $data[$i]['nama_jenis_pemasaran']  = $result[$i]['nama_jenis_pemasaran'];
            $data[$i]['action'] = '<center>';
            $data[$i]['action'] .= '<a onclick="return showDetail(\'' . $result[$i]['id_pemasaran_mn'] . '\')" class="btn btn-primary btn-icon" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-search-plus" aria-hidden="true"></i></a>';
            // if ($result[$i]['kategori_pembeli'] == "2") {
            //     $data[$i]['action'] .= '<a onclick="return showDetail(\'' . $result[$i]['id_pemasaran_mn'] . '\')" class="btn btn-primary btn-icon" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-search-plus" aria-hidden="true"></i></a>';
            // }else{
            //     $data[$i]['action'] .= '<a onclick="return showDetail(\'' . $result[$i]['id_pemasaran_mn'] . '\')" class="btn btn-primary btn-icon" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-search-plus" aria-hidden="true"></i></a>';
            // }
            $data[$i]['action'] .= '</center>';
        }

        return Datatables::of($data)
            ->make(true);
    }

    public function detail_pemasaran(Request $req)
    {
        $id_pemasaran = $req->get('id_pemasaran');
        $db_2 = \DB::connection('pgsql2');
        $data = DB::table('pemasaran_mn')
            ->where('id_pemasaran_mn', $id_pemasaran)
            ->get();

        return view('perusahaan.mineral.pemasaran.detail', compact('data'));
    }

    public function add_pemasaran(Request $request)
    {
        $id_user = $request->id_perusahaan;
        $data['pembeli_trader'] = DB::table('treader')
            ->where('jenis_komoditas', 'b40a547d-dc5e-4bc0-b062-738f34e73922')
            ->where('status', 1)
            ->where('id_perusahaan', '!=', Auth::guard('traders')->user()->id_perusahaan)
            ->where('aktifasi', true)
            ->where('alasan', null)->get();
        $db_2 = \DB::connection('pgsql2');
        $data['cek_inven'] = DB::table('inventori_trader')->where('id_trader', $id_user)->get();


        // dd($data);
        return view('perusahaan.mineral.pemasaran.add_pemasaran', $data);
    }

    public function master_kualitas(Request $request)
    {
        $data['master_kualitas'] = get_kualitas_kadar($request->id_produk);
        // dd($data);
        return view('perusahaan.mineral.output.detail', $data);
    }

    public function post_pemasaran(Request $request)
    {
        // dd($request->all());
        $kategori_pembeli = $request->kategori_pembeli;
        $uuid = Uuid::generate(4);
        $status_surveyor = '';
        $surveyor = '';
        if (!empty($request->surveyor)) {
            $status_surveyor = 0;
            $surveyor = $request->surveyor;
        } else {
            $status_surveyor = null;
            $surveyor = null;
        }
        // $kode_transaksi = $this->get_kode_transaksi(Auth::guard('traders')->user()->id_perusahaan);
        if ($kategori_pembeli == 1) {
            try {
                $data_pemasaran = [
                    'id_pemasaran_mn' => $uuid,
                    'date' => date('Y-m-d H:i:s'),
                    'id_transaksi' => $request->kode_transaksi,
                    'jenis_penjualan' => $request->jenis_penjualan,
                    'pelabuhan_asal' => $request->pelabuhan_muat,
                    'lokasi_pelabuhan' => $request->lokasi_pelabuhan_muat,
                    'pelabuhan_tujuan' => $request->pelabuhan_ts,
                    'nama_kapal' => $request->nama_kapal,
                    'kategori_pembeli' => $kategori_pembeli,
                    'tujuan_pemasaran' => $request->jenis_pemasaran,
                    'pelapor' => Auth::guard('traders')->user()->id_perusahaan,
                    'id_masterpembeli' => $request->id_master_pembeli,
                    'jenis_pemasaran' => $request->jenis_pemasaran,
                    'mata_uang' => $request->mata_uang,
                    'uom' => null,
                    'volume' => str_replace(',', '.', str_replace('.', '', $request->volume)),
                    'id_produk' => $request->jenis_produk
                ];
                $exec =  DB::table('pemasaran_mn')->insert($data_pemasaran);
                $qty = [];
                for ($i = 0; $i < count($request->kadar); $i++) {
                    $qty['kualitas_' . ($i + 1)]  = str_replace(',', '.', str_replace('.', '',$request->kadar[$i]));
                    $qty['ekuivalen' . ($i + 1)]  = str_replace(',', '.', str_replace('.', '',$request->ekualivalen_kadar[$i]));
                    $qty['satuan_ekuivalen_' . ($i + 1)]  = str_replace(',', '.', str_replace('.', '',$request->ekualivalen_satuan[$i]));
                    $qty['jumlah_kualitas_' . ($i + 1)]  = str_replace(',', '.', str_replace('.', '',$request->nilai_kadar[$i]));
                    $qty['satuan_kadar_' . ($i + 1)]  = str_replace(',', '.', str_replace('.', '',$request->nilai_kadar_satuan[$i]));
                }
                DB::table('pemasaran_mn')->where('id_pemasaran_mn', $uuid)->update($qty);
                $uuid2 = Uuid::generate(4);
                $data1 = [
                    "id_pembelian" => $uuid2,
                    "created_at" => date('Y-m-d H:i:s'),
                    "id_transaksi" => $request->kode_transaksi,
                    "id_pemasaran_mn" => $uuid,
                    "id_pembeli" => $request->id_master_pembeli,
                    "id_penjual" => Auth::guard('traders')->user()->id_perusahaan,
                    "volume" => str_replace(',', '.', str_replace('.', '', $request->volume)),
                    "id_produk" => $request->jenis_produk,
                    "uom" => null,
                ];
                DB::table('pembelian_mn')->insert($data1);
                DB::table('pembelian_mn')->where('id_pemasaran_mn', $uuid)->update($qty);

                return redirect()->back()->with(["success" => "berhasil menambah data"]);
            } catch (Exception $e) {
                echo $e;
                return redirect()->back()->with(["failed" => "gagal menambah data"]);
            }
        } else if ($kategori_pembeli == 2) {
            try {
                $data_pemasaran = [
                    'id_pemasaran_mn' => $uuid,
                    'date' => date('Y-m-d H:i:s'),
                    'id_transaksi' => $request->kode_transaksi,
                    'jenis_penjualan' => $request->jenis_penjualan,
                    'pelabuhan_asal' => $request->pelabuhan_muat,
                    'lokasi_pelabuhan' => $request->lokasi_pelabuhan_muat,
                    'pelabuhan_tujuan' => $request->pelabuhan_ts,
                    'nama_kapal' => $request->nama_kapal,
                    'kategori_pembeli' => $kategori_pembeli,
                    'tujuan_pemasaran' => $request->jenis_pemasaran,
                    'pelapor' => Auth::guard('traders')->user()->id_perusahaan,
                    'id_masterpembeli' => $request->id_master_pembeli,
                    'jenis_pemasaran' => $request->jenis_pemasaran,
                    'mata_uang' => $request->mata_uang,
                    'uom' => null,
                    'volume' => str_replace(',', '.', str_replace('.', '', $request->volume)),
                    'id_produk' => $request->jenis_produk
                ];
                $exec = DB::table('pemasaran_mn')->insert($data_pemasaran);
                $qty = [];
                for ($i = 0; $i < count($request->kadar); $i++) {
                    $qty['kualitas_' . ($i + 1)]  = str_replace(',', '.', str_replace('.', '',$request->kadar[$i]));
                    $qty['ekuivalen' . ($i + 1)]  = str_replace(',', '.', str_replace('.', '',$request->ekualivalen_kadar[$i]));
                    $qty['satuan_ekuivalen_' . ($i + 1)]  = str_replace(',', '.', str_replace('.', '',$request->ekualivalen_satuan[$i]));
                    $qty['jumlah_kualitas_' . ($i + 1)]  = str_replace(',', '.', str_replace('.', '',$request->nilai_kadar[$i]));
                    $qty['satuan_kadar_' . ($i + 1)]  = str_replace(',', '.', str_replace('.', '',$request->nilai_kadar_satuan[$i]));
                }
                DB::table('pemasaran_mn')->where('id_pemasaran_mn', $uuid)->update($qty);
                return redirect()->back()->with(["success" => "berhasil menambah data"]);
            } catch (Exception $e) {
                echo $e;
                return redirect()->back()->with(["failed" => "gagal menambah data"]);
            }
        }
    }

    public function pos_update(Request $request)
    {
        dd($request->all());
    }

    protected function get_kode_transaksi($id_perusahaan)
    {
        $tanggalskr = date('Y-m-d');
        $testing = PemasaranBB::select('kode_transaksi')
            ->where('pelapor', $id_perusahaan)
            ->where('jenis_laporan', 'provisional')
            ->whereDate('created_at', $tanggalskr)->orderBy('created_at', 'DESC')->first();
        $iduser = Auth::user()->id;
        $rest = (int) substr($testing, -4);

        $date = date_format(date_create($tanggalskr), 'Y/m/d');
        $no = 0;
        if ($rest == 0) {
            $no = "$date/ $iduser-0001";
            $autonya = $no;
        } else if ($rest < 9) {
            $no = $rest + 1;
            $autonya = "$date/ $iduser-000$no";
        } else if ($rest < 99) {
            $no = $rest + 1;
            $autonya = "$date/ $iduser-00$no";
        } else if ($rest < 999) {
            $no = $rest + 1;
            $autonya = "$date/ $iduser-0$no";
        } else if ($rest < 9999) {
            $no = $rest + 1;
            $autonya = "$date/ $iduser-$no";
        } else {
            $autonya = "$date/ $iduser-0001";
        }
        return $autonya;
    }
}
