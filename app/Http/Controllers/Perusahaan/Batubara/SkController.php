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
use Webpatser\Uuid\Uuid;
use App\Models\Master_SK;


class SkController extends Controller
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
        $data['res'] = Master_SK::select('id_sk', 'no_sk', 'tanggal_sk', 'status_approve', 'masa_berlaku')
            ->where('userid', $id_perusahaan)->groupBy('id_sk', 'no_sk', 'tanggal_sk', 'masa_berlaku', 'status_approve')->get();
        $data['cek'] = Master_SK::select('status_approve', 'status_perpanjangan', 'status_penambahan')
            ->where('userid', $id_perusahaan)->where('status_aktif', 1)->orderby('id', 'desc')->first();
        $cek = $data['cek'];
        if (!empty($cek)) {
            $data['status_approve'] = $cek->status_approve;
            $data['status_perpanjangan'] = $cek->status_perpanjangan;
            $data['status_penambahan'] = $cek->status_penambahan;
        }
        return view('perusahaan.batubara.sk.index', $data);
    }

    public function detail_sk(Request $request)
    {
        $id_sk = base64_decode($request->id_sk);
        $no_sk = base64_decode($request->no_sk);
        $id_perusahaan = Auth::guard('traders')->user()->id_perusahaan;

        $data['detail'] = DB::table('master_sk_induk')
            // ->leftjoin('sk_detail', 'sk_detail.id_sk', '=', 'master_sk_induk.id_sk')
            ->where('master_sk_induk.no_sk', '=', "$no_sk")
            ->where('master_sk_induk.id_sk', '=', "$id_sk")
            ->get();

        $data['perusahaan'] = DB::table('master_sk_induk')
            ->leftjoin('sk_detail', 'sk_detail.id_sk', '=', 'master_sk_induk.id_sk')
            ->where('master_sk_induk.no_sk', '=', "$no_sk")
            ->where('master_sk_induk.id_sk', '=', "$id_sk")
            ->get();

        $data['cek'] = Master_SK::select('*')->where('userid', $id_perusahaan)
            ->where('no_sk', $no_sk)
            ->where('id_sk', '=', "$id_sk")
            ->orderBy('id', 'DESC')->first();

        $data['dok_lampiran'] = Master_SK::select('*')
            ->where('userid', $id_perusahaan)
            ->where('master_sk_induk.no_sk', '=', "$no_sk")
            ->orderBy('status_penambahan', 'ASC')
            ->get();

        return view('perusahaan.batubara.sk.detail', $data);
    }

    /*CRUD*/

    public function add_sk_page()
    {
        $data['id_perusahaan'] = Auth::guard('traders')->user()->id_perusahaan;

        return view('perusahaan.batubara.sk.tambah_sk', $data);
    }

    public function perpanjang_sk_page()
    {
        $data['id_perusahaan'] = Auth::guard('traders')->user()->id_perusahaan;
        $data['sk'] = Master_SK::select('*')->where('userid', Auth::guard('traders')->user()->id_perusahaan)->orderBy('id', 'DESC')->first();
        $data['no_sk'] = Master_SK::where('userid', Auth::guard('traders')->user()->id_perusahaan)->orderBy('id', 'DESC')->first()->no_sk;
        $no_sk = $data['no_sk'];
        $data['dataDetail'] = Master_SK::join('sk_detail', 'sk_detail.id_sk', '=', 'master_sk_induk.id_sk')
            ->where('master_sk_induk.no_sk', 'like', "%$no_sk%")
            ->where('sk_detail.status_approve', true)
            ->get();
        return view('perusahaan.batubara.sk.perpanjang_sk', $data);
    }

    public function perusahaan_tambang()
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('perusahaan')->select('id_perusahaan', 'nama')
            ->where('tipe_perusahaan', '1b5f47a9-e6c9-46e2-b957-c113ef39c787')
            ->wherenull('deleted_at')
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

    public function store_sk(Request $request)
    {
        $uuid = Uuid::generate(4);
        $no_SK = $request->no_sk;
        $tanggal_sk = $request->tanggal_sk;
        $masa_berlaku = $request->masa_berlaku;

        $nm_image = $uuid . $request->file("customFile")->getClientOriginalName();
        $destination = public_path() . '/Upload_Dokumen//';
        $request->file('customFile')->move($destination, $nm_image);

        $count = Count($request->id_perusahaan_array);
        $insert = DB::table('master_sk_induk')->insert([
            'id_sk' => $uuid,
            'no_sk' => $no_SK,
            'tanggal_sk' => reverse_default_date($tanggal_sk),
            'masa_berlaku' => reverse_default_date($masa_berlaku),
            'dokumen' => $nm_image,
            'userid' => Auth::guard('traders')->user()->id_perusahaan,
            'status_approve' => 0,
            'status_aktif' => 1,
        ]);
        //dd($request->all());
        if ($insert > 0) {
            for ($i = 0; $i < $count; $i++) {
                $stayuuid = $uuid;
                $data = [
                    'id_sk' => $stayuuid,
                    'jenis_perusahaan' => $request->jenis_perusahaan_array[$i],
                    'id_trader' => $request->id_perusahaan_array[$i],
                    'id_perusahaan' => $request->id_perusahaan_array[$i],
                    'nama_perusahaan' => $request->nama_perusahaan_array[$i],
                    'nama_penambang' => $request->nama_perusahaan_array[$i],
                    'jenis_komoditas' => '1b5f47a9-e6c9-46e2-b957-c113ef39c787',
                    'volume' => $request->volume_array[$i],
                    'status_approve' => false,
                ];
                DB::table('sk_detail')->insert($data);
            }
        }
        return redirect('traders/batubara/list-sk');
    }
}
