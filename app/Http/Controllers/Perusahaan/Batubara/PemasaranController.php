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
use App\Models\PemasaranBB;
use Webpatser\Uuid\Uuid;

class PemasaranController extends Controller
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
        return view('perusahaan.batubara.pemasaran.index', $data);
    }

    public function data_pemasaran()
    {
        $id_perusahaan = Auth::guard('traders')->user()->id_perusahaan;
        $data = [];
        $no = 1;
        $db_2 = \DB::connection('pgsql2');
        $query = DB::table('pemasaran_bb')->where('pelapor', $id_perusahaan)
            ->where('deleted_at', null)
            ->get();
        $result = json_decode($query, true);
        for ($i = 0; $i < count($result); $i++) {
            $data[$i]['no'] = $no++;
            $data[$i]['id_pemasaran_bb'] = $result[$i]['id_pemasaran_bb'];
            $data[$i]['date'] = tgl_indo(date('Y-m-d', strtotime($result[$i]['date'])));
            $data[$i]['id_transaksi'] = $result[$i]['id_transaksi'];
            $data[$i]['nama_kapal'] = $result[$i]['nama_kapal'];
            if ($result[$i]['kategori_pembeli'] == "2") {
                $kategori = "End User";
                $pembeli = get_nama_master_pembeli_moms($result[$i]['id_masterpembeli']);
            } else {
                $kategori =  "IUP OPK Pengangkutan dan Penjualan";
                $pembeli = get_nama_trader($result[$i]['id_masterpembeli']);
            }
            $data[$i]['provinsi_pelabuhan'] = $result[$i]['provinsi_pelabuhan'];
            $data[$i]['kategori'] = $kategori;
            $data[$i]['pembeli'] = $pembeli;
            $data[$i]['nama_jenis_pemasaran']  = $result[$i]['nama_jenis_pemasaran'];
            $data[$i]['action'] = '<center>';
            if ($result[$i]['kategori_pembeli'] == 1 && !empty($result[$i]['alasan_tolak_transaksi'])) {
                $status = 'Transaksi Ditolak Pembeli';
                $data[$i]['action'] .= '<a onclick="return showDetail(\'' . $result[$i]['id_pemasaran_bb'] . '\')" class="btn btn-icon btn-primary"><i class="flaticon-search"></i></a> &nbsp;&nbsp;&nbsp;';
                $data[$i]['action'] .= '<a onclick="return edit(\'' . $result[$i]['id_pemasaran_bb'] . '\')" class="btn btn-icon btn-warning"><i class="flaticon2-pen"></i></a> &nbsp;&nbsp;&nbsp;';
            } else {
                if (!empty($result[$i]['id_surveyor']) && $result[$i]['status_surveyor'] != 1) {
                    $status = 'Transaksi Ditolak Surveyor';
                    $data[$i]['action'] .= '<a onclick="return showDetail(\'' . $result[$i]['id_pemasaran_bb'] . '\')" class="btn btn-icon btn-primary"><i class="flaticon-search"></i></a> &nbsp;&nbsp;&nbsp;';
                    if ($result[$i]['kategori_pembeli'] != 1) {
                        $data[$i]['action'] .= '<a onclick="return edit(\'' . $result[$i]['id_pemasaran_bb'] . '\')" class="btn btn-icon btn-warning"><i class="flaticon2-pen"></i></a> &nbsp;&nbsp;&nbsp;';
                    }
                } else {
                    $status = '-';
                    $data[$i]['action'] .= '<a onclick="return showDetail(\'' . $result[$i]['id_pemasaran_bb'] . '\')" class="btn btn-icon btn-primary" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="la la-search" aria-hidden="true"></i></a> &nbsp;&nbsp;&nbsp;';
                }
            }
            $data[$i]['action'] .= '</center>';
        }

        return Datatables::of($data)
            ->make(true);
    }

    public function detail_pemasaran(Request $req)
    {
        $id_pemasaran = $req->get('id_pemasaran');
        $db_2 = \DB::connection('pgsql2');
        $data = DB::table('pemasaran_bb')
            ->where('id_pemasaran_bb', $id_pemasaran)
            ->get();

        $result = DB::table('pemasaran_detail_vol')->where('id_pemasaran_bb', $id_pemasaran)->get();
        /* detail volume pencampur */
        return view('perusahaan.batubara.pemasaran.detail', compact('data', 'result'));
    }

    public function add_pemasaran(Request $request)
    {
        $id_user = $request->id_perusahaan;

        $db_2 = \DB::connection('pgsql2');
        $data['cek_inven'] = DB::table('inventori_trader')

            ->where('id_trader', $id_user)->get();


        // dd($data);
        return view('perusahaan.batubara.pemasaran.add_pemasaran', $data);
    }

    public function ubah_pemasaran(Request $request)
    {
        $id_pemasaran = $request->id_pemasaran;
        $id_perusahaan = Auth::guard('traders')->user()->id_perusahaan;
        $data['pemasaran_bb'] = DB::table('pemasaran_bb')
            ->where('id_pemasaran_bb', $id_pemasaran)
            ->get();

        $data['inventori'] = DB::table('inventori_trader')
            ->where('id_trader', $id_perusahaan)->get();
        // dd($data);
        return view('perusahaan.batubara.pemasaran.ubah_pemasaran', $data);
    }

    public function negara_ekspor()
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_negara')
            ->where('id_negara', '!=', '4e877bba-c908-42aa-ae87-763957aec79c')
            ->get();

        return $data;
    }

    public function negara_domestik()
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_negara')
            ->where('id_negara', '4e877bba-c908-42aa-ae87-763957aec79c')
            ->get();


        return $data;
    }

    public function perusahaan_trader()
    {
        $data = DB::table('treader')->select('id_perusahaan', 'nama')
            ->where('id_perusahaan', '!=', Auth::guard('traders')->user()->id_perusahaan)
            ->where('jenis_komoditas', '1b5f47a9-e6c9-46e2-b957-c113ef39c787')
            ->where('aktifasi', true)
            ->where('status', 1)
            ->get();

        return $data;
    }

    public function master_pembeli()
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_pembeli')
            ->where('approval', true)
            ->get();
        return $data;
    }

    public function post_pemasaran(Request $request)
    {
        $status_surveyor = '';
        $surveyor = '';
        if (!empty($request->surveyor)) {
            $status_surveyor = 0;
            $surveyor = $request->surveyor;
        } else {
            $status_surveyor = null;
            $surveyor = null;
        }
        $kode_transaksi = $this->get_kode_transaksi(Auth::guard('traders')->user()->id_perusahaan);
        $total_volume = $request->Volume_pejualan;

        $uuid = Uuid::generate(4);
        $data = [
            'id_pemasaran_bb' => $uuid,
            'date' => reverse_default_date($request->tgl_transaksi),
            'id_transaksi' => $request->no_transaksi,
            'jenis_penjualan' => $request->jenis_penjualan,
            'pelabuhan_asal' => $request->pelabuhan_muat,
            'lokasi_pelabuhan' => $request->lokasi_pelabuhan_muat,
            'pelabuhan_tujuan' => $request->pelabuhan_ts,
            'nama_kapal' => $request->nama_kapal,
            'kategori_pembeli' => $request->kategori_pembeli,
            'tujuan_pemasaran' => $request->negara_tujuan,
            'pelapor' => Auth::guard('traders')->user()->id_perusahaan,
            'created_at' => date('Y-m-d H:i:s'),
            'id_masterpembeli' => $request->id_master_pembeli,
            'jenis_pemasaran' => $request->jenis_pemasaran,
            'mata_uang' => $request->mata_uang,
            'harga_jual' => str_replace(',', '.', str_replace('.', '', $request->harga_jual)),
            'nilai_invoice' => str_replace(',', '.', str_replace('.', '', $request->nilai_invoice)),

            'total_volume' => str_replace(',', '.', str_replace('.', '', $request->total_volume)),
            'nama_jenis_penjualan' => ($request->jenis_penjualan == '325404be-6885-4fac-ac8f-fedbc28e0efd') ? 'Domestik' : 'Expor',
            /*By Name*/
            'provinsi_pelabuhan' => get_provinsi_id($request->lokasi_pelabuhan_muat),
            'negara_tujuan' => master_negara_id($request->negara_tujuan),

            'nama_perusahaan' => ($request->kategori_pembeli == 1) ? get_nama_trader($request->id_master_pembeli) : get_nama_master_pembeli_moms($request->id_master_pembeli),
            'nama_jenis_pemasaran' => get_jenis_pemasaran_id($request->jenis_pemasaran),
            'id_surveyor' => $surveyor,
            'status_surveyor' => $status_surveyor,
            'jenis_laporan' => 'provisional',
            'kode_transaksi' => $kode_transaksi,
        ];
        DB::table('pemasaran_bb')->insert($data);
        $count = count($request->id_perusahaan_kerjasama);
        if ($count > 0) {
            for ($i = 0; $i < $count; $i++) {
                $stayuuid = $uuid;
                $idperusahaan_kerjasama = $request->id_perusahaan_kerjasama[$i];
                $id_trader = Auth::guard('traders')->user()->id_perusahaan;

                $dataDetail =
                    [
                        'id_pemasaran_bb' => $stayuuid,
                        'id_master_pembeli' => $request->id_perusahaan_kerjasama[$i],
                        'volume' => str_replace(',', '.', str_replace('.', '', $request->volume_input[$i])),
                    ];
                $minus = str_replace(',', '.', str_replace('.', '', $request->volume_awal[$i])) - str_replace(',', '.', str_replace('.', '', $request->volume_input[$i]));
                DB::table('pemasaran_detail_vol')->insert($dataDetail);
                /*UNTUK 22nya*/
                if (empty($surveyor)) {
                    DB::table('inventori_trader')
                        ->where('id_trader', $id_trader)
                        ->where('id_perusahaan_kerjasama', $request->id_perusahaan_kerjasama[$i])
                        ->update([
                            'volume' => $minus,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                } else {
                    # Diverifikasi oleh SURVEYOR
                }
            }
        }
        return redirect()->back()->with(['messsage', 'Success']);
    }

    public function pos_update(Request $request)
    {
        $status_surveyor = '';
        $surveyor = '';
        if (!empty($request->surveyor)) {
            $status_surveyor = 0;
            $surveyor = $request->surveyor;
        } else {
            $status_surveyor = null;
            $surveyor = null;
        }

        $data = [
            'date' => reverse_default_date($request->tgl_transaksi),
            'id_transaksi' => $request->no_transaksi,
            'jenis_penjualan' => $request->jenis_penjualan,
            'pelabuhan_asal' => $request->pelabuhan_muat,
            'lokasi_pelabuhan' => $request->lokasi_pelabuhan_muat,
            'pelabuhan_tujuan' => $request->pelabuhan_ts,
            'nama_kapal' => $request->nama_kapal,
            'kategori_pembeli' => $request->kategori_pembeli,
            'tujuan_pemasaran' => $request->negara_tujuan,
            'pelapor' => Auth::guard('traders')->user()->id_perusahaan,
            'created_at' => date('Y-m-d H:i:s'),
            'id_masterpembeli' => $request->id_master_pembeli,
            'jenis_pemasaran' => $request->jenis_pemasaran,
            'mata_uang' => $request->mata_uang,
            'harga_jual' => str_replace(',', '.', str_replace('.', '', $request->harga_jual)),
            'nilai_invoice' => str_replace(',', '.', str_replace('.', '', $request->nilai_invoice)),

            'total_volume' => str_replace(',', '.', str_replace('.', '', $request->total_volume)),
            'nama_jenis_penjualan' => ($request->jenis_penjualan == '325404be-6885-4fac-ac8f-fedbc28e0efd') ? 'Domestik' : 'Expor',
            /*By Name*/
            'provinsi_pelabuhan' => get_provinsi_id($request->lokasi_pelabuhan_muat),
            'negara_tujuan' => master_negara_id($request->negara_tujuan),

            'nama_perusahaan' => ($request->kategori_pembeli == 1) ? get_nama_trader($request->id_master_pembeli) : get_nama_master_pembeli_moms($request->id_master_pembeli),
            'nama_jenis_pemasaran' => get_jenis_pemasaran_id($request->jenis_pemasaran),
            'id_surveyor' => $surveyor,
            'status_surveyor' => $status_surveyor,
            'jenis_laporan' => 'provisional',
        ];

        DB::table('pemasaran_bb')->where('id_pemasaran_bb', $request->id_pemasaran)->update($data);
        // dd($data);
        $count = count($request->id_perusahaan_kerjasama);

        if ($count > 0) {
            for ($i = 0; $i < $count; $i++) {
                // $stayuuid = $uuid;
                $idperusahaan_kerjasama = $request->id_perusahaan_kerjasama[$i];
                $id_trader = Auth::guard('traders')->user()->id_perusahaan;
                $volume_input = (!empty($request->volume_input[$i])) ? $request->volume_input[$i] : 0;
                /*UNTUK 22nya*/
                if (!empty($request->volume_input[$i])) {
                    $restore_volume = str_replace(',', '.', str_replace('.', '', $request->volume_awal[$i])) +  str_replace(',', '.', str_replace('.', '',  $request->volume_input_lama[$i]));
                    $minus =  $restore_volume - str_replace(',', '.', str_replace('.', '', $volume_input));
                    if (empty($surveyor)) {
                        DB::table('inventori_trader')
                            ->where('id_trader', $id_trader)
                            ->where('id_perusahaan_kerjasama', $request->id_perusahaan_kerjasama[$i])
                            ->update([
                                'volume' => $minus,
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]);
                    } else {
                        # Diverifikasi oleh SURVEYOR
                    }
                    $dataDetail =
                        [
                            'id_master_pembeli' => $request->id_perusahaan_kerjasama[$i],
                            'volume' => str_replace(',', '.', str_replace('.', '', $request->volume_input[$i])),
                        ];
                    DB::table('pemasaran_detail_vol')->where('id_master_pembeli', $idperusahaan_kerjasama)
                        ->update($dataDetail);
                } else {
                    $minus = str_replace(',', '.', str_replace('.', '', $request->volume_awal[$i])) - str_replace(',', '.', str_replace('.', '', $request->volume_input_lama[$i]));

                    $dataDetail =
                        [
                            'id_master_pembeli' => $request->id_perusahaan_kerjasama[$i],
                            'volume' => str_replace(',', '.', str_replace('.', '', $request->volume_input_lama[$i])),
                        ];
                    DB::table('pemasaran_detail_vol')->where('id_master_pembeli', $idperusahaan_kerjasama)
                        ->update($dataDetail);
                }
            }
        }
        return redirect()->back()->with(['messsage', 'Success']);
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
