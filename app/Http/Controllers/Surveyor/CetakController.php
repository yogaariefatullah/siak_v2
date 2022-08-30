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
use App\Models\ProfileSurveyor;
use PDF;

class CetakController extends Controller
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
    public function cetak_lhv($id_detail)
    {

        $db_2 = \DB::connection('pgsql2');
        $data['tongkang'] = $db_2->table('pemasaran_bb_partial')->where('id_detail', base64_decode($id_detail))->first();
        $id_pemasaran =  $data['tongkang']->id_pemasaran_bb;
        $db_2->table('pemasaran_bb_partial')->where('id_detail', base64_decode($id_detail))->update([
            'status_cetak_lhv' => 1,
        ]);
        // $data['tongkang'] = $db_2->table('pemasaran_bb_partial')->where('id_detail', $id_detail)->first();
        // $id_pemasaran =  $data['tongkang']->id_pemasaran_bb;
        // $db_2->table('pemasaran_bb_partial')->where('id_detail', $id_detail)->update([
        //     'status_cetak_lhv' => 1,
        // ]);

        $data['pemasaran'] = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
            ->get();
        $data['kategori_pembeli'] = $data['pemasaran'][0]->kategori_pembeli;
        $data['id_pemasaran'] = $id_pemasaran;
        $data['surveyor'] = ProfileSurveyor::where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)->first();
        $data['nama_surveyor'] = Auth::guard('surveyors')->user()->name;
        $profile = DB::table('profile_surveyor')->where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)->first();
        $url = asset('/logo_surveyor/' . $profile->file);
        $id_pelapor = get_perusahaan($id_pemasaran);
        $gambar = 'data:image/png;base64,' . base64_encode(file_get_contents($url));
        // $data['gambar'] = "<img src='{$url}' alt='mostafid' class='logo' height='100' width='100'>";
        $data['gambar'] = $gambar;
        $data['perusahaan'] = $db_2->table('perusahaan')->where('id_perusahaan', $id_pelapor)->get();
        set_time_limit(600);
        $pdf = PDF::setOptions([
            'images' => true,
            'isRemoteEnabled' => true,
        ])
            ->loadView('surveyor.output.print', $data)
            ->setPaper('a4', 'portrait');
        $name = 'LHV - ' . uniqid() . '.pdf';
        //return $pdf->download('invoice.pdf');
        return $pdf->stream($name);
    }

    public function cetak_lhv_mn($id_detail)
    {

        $db_2 = \DB::connection('pgsql2');
        $data['tongkang'] = $db_2->table('pemasaran_mn_partial')->where('id_detail', base64_decode($id_detail))->first();
        $id_pemasaran =  $data['tongkang']->id_pemasaran_mn;
        $db_2->table('pemasaran_mn_partial')->where('id_detail', base64_decode($id_detail))->update([
            'status_cetak_lhv' => 1,
        ]);
        $data['pemasaran'] = $db_2->table('pemasaran_mn')
            ->join('final_pemasaran_mn', 'pemasaran_mn.id_pemasaran_mn', 'final_pemasaran_mn.id_pemasaran_mn')
            ->join('master_jenis_penjualan', 'pemasaran_mn.jenis_pemasaran', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_mn.id_pemasaran_mn', $id_pemasaran)
            ->get();

        $data['kategori_pembeli'] = $data['pemasaran'][0]->kategori_pembeli;
        $data['id_pemasaran'] = $id_pemasaran;
        $data['surveyor'] = ProfileSurveyor::where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)->first();
        $data['nama_surveyor'] = Auth::guard('surveyors')->user()->name;
        $profile = DB::table('profile_surveyor')->where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)->first();
        $url = asset('/logo_surveyor/' . $profile->file);
        $id_pelapor =  $data['pemasaran'][0]->pelapor;
        $data['gambar'] = 'data:image/png;base64,' . base64_encode(file_get_contents($url));
        $data['perusahaan'] = $db_2->table('perusahaan')->where('id_perusahaan', $id_pelapor)->get();
        set_time_limit(600);
        $pdf = PDF::setOptions([
            'images' => true,
            'isRemoteEnabled' => true,
        ])
            ->loadView('surveyor.output.print_mn', $data)
            ->setPaper('a4', 'portrait');
        $name = 'LHV - ' . uniqid() . '.pdf';
        //return $pdf->download('invoice.pdf');
        return $pdf->stream($name);
    }

    public function cetak_lhv_trader($id_detail)
    {

        $id_pemasaran = base64_decode($id_detail);
        $data['id_pemasaran']= base64_decode($id_detail);
        $id_surveyor = Auth::guard('surveyors')->user()->id_perusahaan_surveyor;
        $data['nama_surveyor'] = Auth::guard('surveyors')->user()->name;
        $data['tmp_id_detail'] = 0;
        $data['Perusahaan_surveyor'] = DB::table('surveyor')->Where('uuid', $id_surveyor)->first();
        $profile = ProfileSurveyor::where('id_surveyor', $id_surveyor)->first();
        $no_sk = '';
        $urllogo = url('logo_surveyor/logo.gif');
        $logo_minerba = "<img src='{$urllogo}' alt='mostafid' class='logo' height='500' width='500'>";
        $url = public_path('logo_surveyor/' . $profile->file);
        $logo = "Html::image('logo_surveyor/' )";

        $data['gambar'] = 'data:image/png;base64,' . base64_encode(file_get_contents($url));
        //echo $gambar;die();
        $db_2 = \DB::connection('pgsql2');
        $query = DB::table('pemasaran_bb')->where('id_pemasaran_bb', base64_decode($id_detail))->get();

        $perusahaan = DB::table('treader')->select('nama')->where('id_perusahaan', $query[0]->pelapor)->get();
        $data['penjual'] = $perusahaan[0]->nama;

        $data['get_provinsi'] = $db_2->table('master_provinsi')->where('id_provinsi', $query[0]->lokasi_pelabuhan)->get();
        $data['provinsi'] = $data['get_provinsi'][0]->nama_provinsi;
        $data['JSONData'] = json_decode($query, true);
        $id_user = $query[0]->pelapor;
        $JSONData = json_decode($query, true);
        if ($JSONData[0]['kategori_pembeli'] == 2) {
            $data['pembeli'] = get_nama_master_pembeli_moms($query[0]->id_masterpembeli);
            $data['jenis_pembeli'] = 'End User';
        } else if ($JSONData[0]['kategori_pembeli'] == 5) {
            $data['pembeli'] = get_nama_stockpile($query[0]->id_masterpembeli);
            $data['jenis_pembeli'] = 'Intermedite Stockpile';
        } else {
            $data['pembeli'] = get_nama_trader($query[0]->id_masterpembeli);
            $data['jenis_pembeli'] = 'IUP OPK Angkut Jual';
        }

        /* start update cetak_lhv ws */

        $data['stsnya'] = $query[0]->status_cetak_lhv;
        $update = $data['stsnya'] + 1;
        $get_sk = DB::select("SELECT
        master_sk_induk.no_sk,
        sk_detail.jenis_perusahaan,
        sk_detail.id_perusahaan ,
        sk_detail.nama_perusahaan FROM
        master_sk_induk
        JOIN sk_detail ON sk_detail.id_sk = master_sk_induk.id_sk
        WHERE
        master_sk_induk.status_aktif = '1'
        AND sk_detail.status_approve = 't'
        AND master_sk_induk.userid = '$id_user' limit 1");

        $data['nomor_sk'] = '';
        $data['pemasaranbb_partial_update'] = DB::table('pemasaran_bb')->where('id_pemasaran_bb', base64_decode($id_detail))
            ->update(['status_cetak_lhv' => $update]);
        /* end update cetak_lhv ws */
        $data['volume'] = $query[0]->total_volume;
        $data['DataPerusahaan'] = json_decode($perusahaan, true);
        $data['tgl'] = $query[0]->tgl_input;
        //dd($get_sts);
        set_time_limit(600);
        $pdf = PDF::setOptions(
            [
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'enable_php' => true
            ]
        )->loadView('surveyor.output.cetak_lhv_mvp',$data)
            ->setPaper('a4', 'portrait');
        $name = 'LHV - ' . uniqid() . '.pdf';
        //return $pdf->download('invoice.pdf');
        return $pdf->stream($name);
    }

    public function preview_modal(Request $request)
    {
        $data = [];
        $id_pemasaran = $request->id_pemasaran_bb;
        $db_2 = \DB::connection('pgsql2');
        $data['input_tgl'] = reverse_default_date($request->tanggal);
        $data['input_volume'] = $request->volume;
        $data['input_nama_tongkang'] = $request->tongkang;
        $data['input_nama_tugboat'] = $request->tugboat;
        $data['input_no_lhv'] = $request->no_lhv;
        $data['pemasaran'] = $db_2->table('pemasaran_bb')
            // ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            // ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->leftjoin('perusahaan', 'pemasaran_bb.pelapor', 'perusahaan.id_perusahaan')
            ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
            ->get();
        $data['id_pemasaran'] = $id_pemasaran;
        $data['id_detail'] = $request->id_detail;
        $data['surveyor'] = ProfileSurveyor::where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)->first();
        $data['nama_surveyor'] = Auth::guard('surveyors')->user()->name;
        $profile = DB::table('profile_surveyor')->where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)->first();
        $url = asset('/logo_surveyor/' . $profile->file);
        $data['gambar'] = 'data:image/png;base64,' . base64_encode(file_get_contents($url));
        return view('surveyor.output.preview', $data);
    }

    public function preview_modal_mn(Request $request)
    {
        $data = [];
        $id_pemasaran = $request->id_pemasaran_mn;
        $db_2 = \DB::connection('pgsql2');
        $data['input_tgl'] = reverse_default_date($request->tanggal);
        $data['input_volume'] = $request->volume;
        $data['input_nama_tongkang'] = $request->tongkang;
        $data['input_nama_tugboat'] = $request->tugboat;
        $data['input_no_lhv'] = $request->no_lhv;
        $data['pemasaran'] = $db_2->table('pemasaran_mn')
            ->where('pemasaran_mn.id_pemasaran_mn', $id_pemasaran)
            ->get();
        $data['id_pemasaran'] = $id_pemasaran;
        $data['id_detail'] = $request->id_detail;
        $data['surveyor'] = ProfileSurveyor::where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)->first();
        $data['nama_surveyor'] = Auth::guard('surveyors')->user()->name;
        $profile = DB::table('profile_surveyor')->where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)->first();
        $url = asset('/logo_surveyor/' . $profile->file);
        $data['gambar'] = 'data:image/png;base64,' . base64_encode(file_get_contents($url));
        // dd($data);
        return view('surveyor.output.preview_mn', $data);
    }

    public function cetak_cow_bb($id_transaksi)
    {
        $db_2 = \DB::connection('pgsql2');


        $data['pemasaran'] = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_bb.id_transaksi', base64_decode($id_transaksi))
            ->where('jenis_laporan', 'final')
            ->get();
        $id_pemasaran = $data['pemasaran'][0]->id_pemasaran_bb;
        foreach ($data['pemasaran'] as $p) {
            $db_2->table('final_pemasaran_bb')
                ->where('id_pemasaran_bb', $p->id_pemasaran_bb)
                ->update([
                    'status_cetak_cow' => 1
                ]);
        }

        $data['kategori_pembeli'] = $data['pemasaran'][0]->kategori_pembeli;
        $data['id_pemasaran'] = $id_pemasaran;
        $data['surveyor'] = ProfileSurveyor::where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)->first();
        $data['nama_surveyor'] = Auth::guard('surveyors')->user()->name;
        $profile = DB::table('profile_surveyor')->where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)->first();
        $url = public_path('logo_surveyor/' . $profile->file);
        $id_pelapor = get_perusahaan($id_pemasaran);
        $data['gambar'] = 'data:image/png;base64,' . base64_encode(file_get_contents($url));
        $data['perusahaan'] = $db_2->table('perusahaan')->where('id_perusahaan', $id_pelapor)->get();
        $urllogo = url('logo_surveyor/logo.gif');
        $data['logo_minerba'] = "<img src='{$urllogo}' alt='mostafid' class='logo' height='500' width='500'>";
        set_time_limit(600);
        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'enable_php' => true
        ])

            ->loadView('surveyor.output.print_cow', $data)
            ->setPaper('a4', 'portrait');
        $name = 'LHV - ' . uniqid() . '.pdf';
        //return $pdf->download('invoice.pdf');
        return $pdf->stream($name);
    }

    public function cetak_coa_bb($id_transaksi)
    {
        $db_2 = \DB::connection('pgsql2');
        $data['pemasaran'] = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_bb.id_transaksi', base64_decode($id_transaksi))
            ->where('jenis_laporan', 'final')
            ->get();
        $id_pemasaran = $data['pemasaran'][0]->id_pemasaran_bb;
        $data['kualitas'] = $db_2->table('pemasaran_bb_kualitas')
            ->where('id_pemasaran', $id_pemasaran)
            ->get();


        foreach ($data['pemasaran'] as $p) {
            $db_2->table('final_pemasaran_bb')
                ->where('id_pemasaran_bb', $p->id_pemasaran_bb)
                ->update([
                    'status_cetak_coa' => 1
                ]);
        }

        $data['kategori_pembeli'] = $data['pemasaran'][0]->kategori_pembeli;
        $data['id_pemasaran'] = $id_pemasaran;
        $data['surveyor'] = ProfileSurveyor::where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)->first();
        $data['nama_surveyor'] = Auth::guard('surveyors')->user()->name;
        $profile = DB::table('profile_surveyor')->where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)->first();
        $url = public_path('logo_surveyor/' . $profile->file);
        $id_pelapor = get_perusahaan($id_pemasaran);
        // $data['gambar'] = "<img src='{$url}' alt='mostafid' class='logo' height='100' width='100'>";
        $data['gambar'] = 'data:image/png;base64,' . base64_encode(file_get_contents($url));
        $data['perusahaan'] = $db_2->table('perusahaan')->where('id_perusahaan', $id_pelapor)->get();
        $urllogo = url('logo_surveyor/logo.gif');
        $data['logo_minerba'] = "<img src='{$urllogo}' alt='mostafid' class='logo' height='500' width='500'>";
        set_time_limit(600);
        $pdf = PDF::setOptions([
            'images' => true,
            'isRemoteEnabled' => true,
        ])
            ->loadView('surveyor.output.print_coa', $data)
            ->setPaper('a4', 'portrait');
        $name = 'LHV - ' . uniqid() . '.pdf';
        //return $pdf->download('invoice.pdf');
        return $pdf->stream($name);
    }

    public function print_lhv_vessel(Request $request)
    {
        $id_transaksi = $request->id_transaksi;
        $no_lhv = $request->no_lhv_vessel;
        $tgl = $request->tgl_lhv_vessel;
        $data['tgl'] = $request->tgl_lhv_vessel;
        $data['no_lhv'] = $no_lhv;

        $volume_input_vessel = str_replace(',', '.', str_replace('.', '', $request->volume_totals));
        $data['volume_input_vessel'] = $volume_input_vessel;
        $db_2 = \DB::connection('pgsql2');
        $data['pemasaran'] = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_bb.id_transaksi', base64_decode($id_transaksi))
            ->where('jenis_laporan', 'final')
            ->get();
        $db_2->table('pemasaran_bb')
            ->where('id_transaksi', $id_transaksi)
            ->update([
                'status_cetak_lhv' => 1
            ]);
        $final = $db_2->table('pemasaran_bb')
            ->where('id_transaksi', base64_decode($id_transaksi))->get();
        foreach ($final as $key) {
            $db_2->table('final_pemasaran_bb')
                ->where('id_pemasaran_bb', $key->id_pemasaran_bb)
                ->update([
                    'nama_dokumenlhv' => $no_lhv,
                ]);
        }

        $id_pemasaran = $data['pemasaran'][0]->id_pemasaran_bb;
        $id_transaksi = base64_decode($request->no_transaksi_vessel);
        $id_pemasaran = $request->id_pemasaran_vessel;
        $data['kategori_pembeli'] = $data['pemasaran'][0]->kategori_pembeli;
        $data['id_pemasaran'] = $id_pemasaran;
        $data['surveyor'] = ProfileSurveyor::where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)->first();
        $data['nama_surveyor'] = Auth::guard('surveyors')->user()->name;
        $profile = DB::table('profile_surveyor')->where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)->first();
        $url = asset('/logo_surveyor/' . $profile->file);
        $id_pelapor =  $data['pemasaran'][0]->pelapor;
        $data['gambar'] = "<img src='{$url}' alt='mostafid' class='logo' height='100' width='100'>";
        $data['perusahaan'] = $db_2->table('perusahaan')->where('id_perusahaan', $id_pelapor)->get();
        $urllogo = url('logo_surveyor/logo.gif');
        $data['logo_minerba'] = "<img src='{$urllogo}' alt='mostafid' class='logo' height='500' width='500'>";
        $data['kategori_pembeli'] = $data['pemasaran'][0]->kategori_pembeli;
        set_time_limit(600);
        $pdf = PDF::setOptions([
            'images' => true,
            'isRemoteEnabled' => true,
        ])
            ->loadView('surveyor.output.print_vessel', $data)
            ->setPaper('a4', 'portrait');
        $name = 'LHV-VESSEL/' . uniqid() . '.pdf';
        return $pdf->download($name);
        // return $pdf->download($name);
    }

    public function preview_trader(Request $request)
    {
        $data = [];
        $id_pemasaran = $request->id_pemasaran_bb;
        $db_2 = \DB::connection('pgsql2');
        $data['pemasaran'] = DB::table('pemasaran_bb')
            ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
            ->get();
        $data['input_tgl'] = $request->tanggal;
        $data['id_detail'] = $request->id_detail;
        $data['input_volume'] = $request->volume;
        $data['input_no_lhv'] = $request->no_lhv;
        $data['id_pemasaran'] = $id_pemasaran;
        $data['surveyor'] = ProfileSurveyor::where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)->first();
        $data['nama_surveyor'] = Auth::guard('surveyors')->user()->name;
        $penjual = $data['pemasaran'][0]->pelapor;
        $data['penjual'] = DB::table('treader')->where('id_perusahaan', $penjual)->first();
        $profile = DB::table('profile_surveyor')->where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)->first();
        $url = asset('/logo_surveyor/' . $profile->file);
        $data['gambar'] = 'data:image/png;base64,' . base64_encode(file_get_contents($url));

        return view('surveyor.output.previewOpk', $data);
    }
}
