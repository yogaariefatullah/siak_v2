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

class PerusahaanSurveyorController extends Controller
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
    public function index()
    {
        return view('perusahaan_surveyor.petugas_verifikator');
    }

    public function add_petugas()
    {
        return view('perusahaan_surveyor.add_petugas');
    }

    public function data_petugas()
    {
        $idsurveyor = Auth::guard('surveyors')->user()->uuid;
        $array = DB::table('surveyor')->where('id_perusahaan_surveyor', $idsurveyor)
            ->get();
        $data = [];
        for ($i = 0; $i < count($array); $i++) {
            $data[$i]['id_petugas'] = $array[$i]->uuid;

            $data[$i]['nama'] = $array[$i]->name;
            // $data[$i]['email'] = $array[$i]['email'];
            // $data[$i]['password'] = $array[$i]['password'];
            // $data[$i]['password_real'] = $array[$i]['password_real'];
            $data[$i]['no_sertifikat'] = $array[$i]->no_sertifikat;
            $status = '';
            if ($array[$i]->aktifasi == 't') {
                $status = '<span class="label label-success label-dot mr-2"></span>
                <span class="font-weight-bold text-success">AKTIF</span';
            } else {
                $status = '<span class="label label-danger label-dot mr-2"></span>
                <span class="font-weight-bold text-danger">TIDAK AKTIF</span
                <br/><hr/><p><small>' . $array[$i]->alasan . '</small></p>';
            }
            $data[$i]['status'] = $status;
            $data[$i]['alasan'] = $array[$i]->alasan;
            // $data[$i]['dokumen'] = $array[$i]['file'];

            // $data[$i]['provinsi_id_1'] = $array[$i]['provinsi_satu'];
            // $data[$i]['provinsi_id_2'] = $array[$i]['provinsi_dua'];

            // $data[$i]['nama_provinsi_id_1'] = get_provinsi_id($array[$i]['provinsi_satu']);
            // $data[$i]['nama_provinsi_id_2'] = get_provinsi_id($array[$i]['provinsi_dua']);

            // $data[$i]['provinsi'] = get_provinsi_id($array[$i]->provinsi_satu) . ' & ' . get_provinsi_id($array[$i]->provinsi_dua);
            $data[$i]['provinsi'] = $array[$i]->nama_provinsi_satu . ' & ' . $array[$i]->nama_provinsi_dua;

            $data[$i]['action'] = '<center>';
            if ($array[$i]->aktifasi == true) {
                $data[$i]['action'] .= '<a onclick="return showDetail(\'' . $array[$i]->uuid . '\')" class="btn btn-icon btn-primary"><i class="flaticon-search"></i></a> &nbsp;&nbsp;&nbsp;';
                $data[$i]['action'] .= '<a onclick="return edit(\'' . $array[$i]->uuid . '\')" class="btn btn-icon btn-warning"><i class="flaticon2-pen"></i></a> &nbsp;&nbsp;&nbsp;';
                $data[$i]['action'] .= '</center>';
            } else {
                $data[$i]['action'] .= '<a onclick="return showDetail(\'' . $array[$i]->uuid . '\')" class="btn btn-icon btn-primary"><i class="flaticon-search"></i></a> &nbsp;&nbsp;&nbsp;';
                $data[$i]['action'] .= '</center>';
            }
        }
        return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function edit(Request $request)
    {
        $id_petugas = $request->id_petugas;
        $data['petugas'] = DB::table('surveyor')->where('uuid', $id_petugas)->get();
        return view('perusahaan_surveyor.ubah_petugas', $data);
    }

    public function detail(Request $request)
    {
        $id_petugas = $request->id_petugas;
        $data['petugas'] = DB::table('surveyor')->where('uuid', $id_petugas)->get();
        return view('perusahaan_surveyor.detail_petugas', $data);
    }

    // PROFILE PERUSAHAAN

    public function index_profile()
    {
        $data['result'] = ProfileSurveyor::where('id_surveyor', Auth::guard('surveyors')->user()->uuid)->first();
        return view('perusahaan_surveyor.profile_perusahaan', $data);
    }

    public function updateProfile(Request $request)
    {
        $date = date('Y-m-d H:i:s');
        $uuid = Uuid::generate(4);
        $cek = ProfileSurveyor::join('surveyor', 'profile_surveyor.id_surveyor', '=', 'surveyor.uuid')->where('surveyor.uuid', Auth::guard('surveyor')->user()->uuid)->count();
        $validator = Validator::make($request->all(), [
            'file1' => 'max:1024|image:jpg,png|dimensions:max_width=300,max_height=300',
            'alamat' => 'required',

        ], [
            'file1.image' => 'Unggah file yang berekstensi jpg|png',
            'alamat.required' => 'Alamat belum diisi',
            'file1.dimensions' => 'Ukuran maksimal 300 x 300 pixel',
            'file1.max' => 'Ukuran file lebih dari 1 MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            if (($request->file('file1') != null)) {
                $nm_image = 'logo' . uniqid() . '.' . $request->file("file1")->getClientOriginalExtension();
                $destination = public_path() . '/logo_surveyor/';
                $request->file('file1')->move($destination, $nm_image);
            }
            if (($request->file('file') != null)) {
                $nm_image = 'logo' . uniqid() . '.' . $request->file("file")->getClientOriginalExtension();
                $destination = public_path() . '/logo_surveyor/';
                $request->file('file')->move($destination, $nm_image);
            }

            if ($cek > 0) {
                if (isset($request->file)) {
                    $update = ProfileSurveyor::where('id_profile', $request->id_profile)->update([
                        'file' => $nm_image,
                        'alamat' => $request->alamat,
                        'updated_at' => $date,
                    ]);
                } else {
                    $update = ProfileSurveyor::where('id_profile', $request->id_profile)->update([
                        'alamat' => $request->alamat,
                        'updated_at' => $date,
                    ]);
                }

                if ($update > 0) {
                    return redirect()->back()->with(['msg' => 'Update data']);
                } else {

                    return redirect()->back()->with(['error' => 'Update data']);
                }
            } else {

                $insert = ProfileSurveyor::insert([
                    'id_profile' => $uuid,
                    'id_surveyor' => Auth::guard('surveyor')->user()->uuid,
                    'file' => $nm_image,
                    'alamat' => $request->alamat,
                    'create_at' => $date,
                ]);
                if ($insert > 0) {
                    return redirect()->back()->with(['msg' => 'Insert data']);
                } else {
                    return redirect()->back()->with(['error' => 'Insert data']);
                }
            }
        }
    }

    // Verifikator
    public function index_isp()
    {
        return view('perusahaan_surveyor.stockpile.index_muat_isp');
    }

    public function index_trader()
    {
        return view('perusahaan_surveyor.trader.index_muat_trader');
    }

    public function index_muat_bb(Request $request)
    {
        $judul = '';
        if ($request->jenis_pembeli == 1) {
            $judul = 'IUP OP / PKP2B / IUP K';
        } elseif ($request->jenis_pembeli == 2) {
            $judul = 'Enduser';
        } elseif ($request->jenis_pembeli == 3) {
            $judul = 'IUP PKP2B';
        } else {
            $judul = '-';
        }

        $data = [
            'jenis_pembeli' => $request->jenis_pembeli,
            'url' => route('surveyors.muat.batubara_data', ['jenis_pembeli' => $request->jenis_pembeli]),
            'judul' => 'Data Titik Muat Pemasaran ' . $judul
        ];
        return view('perusahaan_surveyor.batubara.index_muat_batubara', $data);
    }

    public function index_tiser_bb(Request $request)
    {
        $judul = '';
        if ($request->jenis_pembeli == 1) {
            $judul = 'IUP OP / PKP2B / IUP K';
        } elseif ($request->jenis_pembeli == 2) {
            $judul = 'Enduser';
        } elseif ($request->jenis_pembeli == 3) {
            $judul = 'IUP PKP2B';
        } else {
            $judul = '-';
        }

        $data = [
            'jenis_pembeli' => $request->jenis_pembeli,
            'url' => route('surveyors.tiser.batubara_data', ['jenis_pembeli' => $request->jenis_pembeli]),
            'judul' => 'Data Titik Serah Pemasaran ' . $judul
        ];
        return view('perusahaan_surveyor.batubara.index_tiser_batubara', $data);
    }

    public function index_muat_mn(Request $request)
    {
        $judul = '';
        if ($request->jenis_pembeli == 1) {
            $judul = 'IUP OP / PKP2B / IUP K';
        } elseif ($request->jenis_pembeli == 2) {
            $judul = 'Enduser';
        } elseif ($request->jenis_pembeli == 3) {
            $judul = 'IUP PKP2B';
        } else {
            $judul = '-';
        }

        $data = [
            'jenis_pembeli' => $request->jenis_pembeli,
            'url' => route('surveyors.muat.mineral_data', ['jenis_pembeli' => $request->jenis_pembeli]),
            'judul' => 'Data Titik Muat Pemasaran ' . $judul
        ];
        return view('perusahaan_surveyor.mineral.index_muat_mineral', $data);
    }

    public function index_tiser_mn(Request $request)
    {
        $judul = '';
        if ($request->jenis_pembeli == 1) {
            $judul = 'IUP OP / PKP2B / IUP K';
        } elseif ($request->jenis_pembeli == 2) {
            $judul = 'Enduser';
        } elseif ($request->jenis_pembeli == 3) {
            $judul = 'IUP PKP2B';
        } else {
            $judul = '-';
        }

        $data = [
            'jenis_pembeli' => $request->jenis_pembeli,
            'url' => route('surveyors.tiser.mineral_data', ['jenis_pembeli' => $request->jenis_pembeli]),
            'judul' => 'Data Titik Serah Pemasaran ' . $judul
        ];
        return view('perusahaan_surveyor.mineral.index_tiser_mineral', $data);
    }
}
