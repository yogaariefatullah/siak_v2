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

class SurveyorController extends Controller
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

    public function detail_muat_moms(Request $request)
    {
        $id_pemasaran = $request->get('id_pemasaran');
        $db_2 = \DB::connection('pgsql2');
        $data['pemasaran'] = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
            ->get();

        $data['pencampur'] = $db_2->table('detail_pemasaran')
            ->leftjoin('perusahaan', 'perusahaan.id_perusahaan', 'detail_pemasaran.id_penjual')
            ->where('detail_pemasaran.id_pemasaran_bb', $id_pemasaran)->get();
        $data['tongkang'] =  $db_2->table('pemasaran_bb_partial')
            ->where('id_pemasaran_bb', $id_pemasaran)
            ->get();
        /* detail volume pencampur */
        return view('perusahaan_surveyor.modal.detail', $data);
    }

    public function detail_modal_trader(Request $request)
    {
        $id_pemasaran = $request->get('id_pemasaran');
        $db_2 = \DB::connection('pgsql2');
        $data['pemasaran'] = DB::table('pemasaran_bb')
            ->where('id_pemasaran_bb', $id_pemasaran)
            ->get();

        $data['pencampur'] = DB::table('pemasaran_detail_vol')->where('id_pemasaran_bb', $id_pemasaran)->get();

        /* detail volume pencampur */
        return view('perusahaan_surveyor.modal.detail_trader', $data);
    }

    public function detail_muat_moms_mn(Request $request)
    {
        $id_pemasaran = $request->get('id_pemasaran');
        $db_2 = \DB::connection('pgsql2');
        $data['data'] = $db_2->table('pemasaran_mn')
            ->join('final_pemasaran_mn', 'pemasaran_mn.id_pemasaran_mn', 'final_pemasaran_mn.id_pemasaran_mn')
            ->where('pemasaran_mn.id_pemasaran_mn', $id_pemasaran)
            ->get();
        $data['tongkang'] =  $db_2->table('pemasaran_mn_partial')
            ->where('id_pemasaran_mn', $id_pemasaran)
            ->orderby('pemasaran_mn_partial.no_tongkang', 'ASC')
            ->get();
        /* detail volume pencampur */
        return view('perusahaan_surveyor.modal.detail_mn', $data);
    }

    public function detail_vessel(Request $request)
    {
        $id_pemasaran = $request->get('id_pemasaran');
        $db_2 = \DB::connection('pgsql2');
        $data['pemasaran'] = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_bb.id_pemasaran_bb', base64_decode($id_pemasaran))
            ->get();

        $data['pencampur'] = $db_2->table('detail_pemasaran')
            ->leftjoin('perusahaan', 'perusahaan.id_perusahaan', 'detail_pemasaran.id_penjual')
            ->where('detail_pemasaran.id_pemasaran_bb', base64_decode($id_pemasaran))->get();

        /* detail volume pencampur */
        return view('perusahaan_surveyor.modal.verifikasi_vessel', $data);
    }

    
}
