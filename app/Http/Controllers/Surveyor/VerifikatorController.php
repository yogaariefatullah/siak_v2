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
use Webpatser\Uuid\Uuid;
use App\Models\data_moms\final_pemasaran_bb;
use App\Models\data_moms\pemasaran_bb;
use App\Models\Pembelian;
use App\Models\Inventory;
use Illuminate\Http\File;

class VerifikatorController extends Controller
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
    public function index_isp()
    {
        return view('surveyor.stockpile.index_muat_isp');
    }

    public function index_trader()
    {
        return view('surveyor.trader.index_muat_trader');
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
        } elseif ($request->jenis_pembeli == 5) {
            $judul = 'Intermediate Stockpile';
        } else {
            $judul = '-';
        }

        $data = [
            'jenis_pembeli' => $request->jenis_pembeli,
            'url' => route('surveyors.verifikator.muat.bb', ['jenis_pembeli' => $request->jenis_pembeli]),
            'url_final' => route('surveyors.verifikator.muat.bb.final', ['jenis_pembeli' => $request->jenis_pembeli]),
            'judul' => 'Data Titik Muat Pemasaran ' . $judul,
            'kategori' => $judul
        ];
        return view('surveyor.batubara.index_muat_batubara', $data);
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
            'url' => route('surveyors.verifikator.tiser.bb', ['jenis_pembeli' => $request->jenis_pembeli]),
            'judul' => 'Data Titik Serah Pemasaran ' . $judul
        ];
        return view('surveyor.batubara.index_tiser_batubara', $data);
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
            'url' => route('surveyors.verifikator.muat.mn', ['jenis_pembeli' => $request->jenis_pembeli]),
            'url_final' => route('surveyors.verifikator.muat.mn.final', ['jenis_pembeli' => $request->jenis_pembeli]),
            'judul' => 'Data Titik Muat Pemasaran ' . $judul,
            'kategori' => $judul
        ];
        return view('surveyor.mineral.index_muat_mineral', $data);
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
        return view('surveyor.mineral.index_tiser_mineral', $data);
    }

    public function index_produksi_bb()
    {
        $data = [
            'jenis_pembeli' => '',
            'url_modal' => route('surveyors.data_produksi'),
            'url_submit' => route('surveyors.verif_produksi_bb'),
            'url_reject' => url('surveyors/reject_produksi_bb') . '/',
            'url' =>  route('surveyors.verifikator.bb_produksi'),
            'judul' => 'Verifikasi ' . 'Produksi Penambangan Batubara',
            'kategori' => 'Produksi Penambangan Batubara'
        ];
        return view('surveyor.produksi.index', $data);
    }

    public function index_produksi_mn()
    {
        $data = [
            'jenis_pembeli' => '',
            'url_modal' => route('surveyors.data_produksi_mn'),
            'url_submit' => route('surveyors.verif_produksi_mn'),
            'url_reject' => url('surveyors/reject_produksi_mn') . '/',
            'url' => route('surveyors.verifikator.mn_produksi'),
            'judul' => 'Verifikasi ' . 'Produksi Penambangan Mineral',
            'kategori' => 'Produksi Penambangan Mineral'
        ];
        return view('surveyor.produksi.index', $data);
    }

    public function verif_dokumen(Request $request)
    {
        $id_pemasaran = $request->id_pemasaran;
        $db_2 = \DB::connection('pgsql2');
        $data['pemasaran'] = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
            ->get();
        $data['tongkang'] =  $db_2->table('pemasaran_bb_partial')
            ->where('id_pemasaran_bb', $id_pemasaran)
            ->get();
        $data['pencampur'] = $db_2->table('detail_pemasaran')
            ->leftjoin('perusahaan', 'perusahaan.id_perusahaan', 'detail_pemasaran.id_penjual')
            ->where('detail_pemasaran.id_pemasaran_bb', $id_pemasaran)->get();
        $pelapor = $data['pemasaran'][0]->pelapor;
        $bb = $data['pemasaran'][0]->dokumen_buktibayar;
        $shp = $data['pemasaran'][0]->dokumen_baru;
        // https://drive.google.com/viewerng/viewer?embedded=true&url=
        $dok_buktibayar = $this->validate_url_file($pelapor, 'buktibayar', $bb);
        $dok_shipping = $this->validate_url_file($pelapor, 'shipping', $shp);
        $data['dok_buktibayar'] = '' . $dok_buktibayar['file'];
        $data['dok_shipping'] = '' . $dok_shipping['file'];
        return view('surveyor.modal.modal_dokumen', $data);
    }

    protected function validate_url_file($id_perusahaan, $jenis_file, $file)
    {
        $getfile = '';
        $data = [];
        if ($jenis_file == 'buktibayar') {
            $url = 'https://moms.esdm.go.id/uploads/Dokumen-Bayar/' . $file;
            $file_headers = @get_headers($url);
            if ($file_headers[0] == 'HTTP/1.1 200 OK') {
                $urlfile = "https://moms.esdm.go.id/uploads/Dokumen-Bayar/";
                $getfile = $urlfile . '' . $file;
            } else {
                $urlfile = "https://moms.esdm.go.id/uploads/Dokumen-Bayar/" . $id_perusahaan . "/";
                $getfile = $urlfile . '' . $file;
            }
            $data['file'] = $getfile;
        } elseif ($jenis_file == 'invoice') {
            $url = 'https://moms.esdm.go.id/mn/uploads/dokumen_invoice/' . $file;
            $file_headers = @get_headers($url);
            if ($file_headers[0] == 'HTTP/1.1 200 OK') {
                $urlfile = "https://moms.esdm.go.id/mn/uploads/dokumen_invoice/";
                $getfile = $urlfile . '' . $file;
            } else {
                $urlfile = "https://moms.esdm.go.id/mn/uploads/dokumen_invoice/" . $id_perusahaan . "/";
                $getfile = $urlfile . '' . $file;
            }
            $data['file'] = $getfile;
        } elseif ($jenis_file == 'buktibayar_mn') {
            $url = 'https://moms.esdm.go.id/mn/uploads/Dokumen-Bayar/' . $file;
            $file_headers = @get_headers($url);
            if ($file_headers[0] == 'HTTP/1.1 200 OK') {
                $urlfile = "https://moms.esdm.go.id/mn/uploads/Dokumen-Bayar/";
                $getfile = $urlfile . '' . $file;
            } else {
                $urlfile = "https://moms.esdm.go.id/mn/uploads/Dokumen-Bayar/" . $id_perusahaan . "/";
                $getfile = $urlfile . '' . $file;
            }
            $data['file'] = $getfile;
        } else {
            $url = 'https://moms.esdm.go.id/uploads/dokumen_shipping/' . $file;
            $file_headers = @get_headers($url);
            if ($file_headers[0] == 'HTTP/1.1 200 OK') {
                $urlfile = "https://moms.esdm.go.id/uploads/dokumen_shipping/";
                $getfile = $urlfile . '' . $file;
            } else {
                $urlfile = "https://moms.esdm.go.id/uploads/dokumen_shipping/" . $id_perusahaan . "/";
                $getfile = $urlfile . '' . $file;
            }
            $data['file'] = $getfile;
        }
        return $data;
    }

    public function verifikasi_dokumen(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        $dataupdate = ['status_buktibayar' => '1'];
        $query = $db_2->table('pemasaran_bb')
            ->where('id_pemasaran_bb', $request->id_pemasaran)
            ->update($dataupdate);
        return redirect()->back()->with(['messsage', 'Success']);
    }

    public function reject_dokumen(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = [
            "id_pemasaran_bb" => $request->id_pemasaran,
            "alasan" => $request->alasan,
        ];
        try {
            $data = [
                'status_konfirmasi' => '0',
                'status_surveyor' => '2',
                'alasan_tolak_transaksi' => $request->alasan,
            ];
            $db_2->table('pemasaran_bb')
                ->where('id_pemasaran_bb', $request->id_pemasaran)
                ->update($data);
            echo json_encode(['status' => '200']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error']);
        }
    }

    public function verif_tongkang($id_pemasaran)
    {

        $id_pemasaran = base64_decode($id_pemasaran);
        $db_2 = \DB::connection('pgsql2');
        $data['pemasaran'] = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
            ->get();
        $data['tongkang'] =  $db_2->table('pemasaran_bb_partial')
            ->where('id_pemasaran_bb', $id_pemasaran)
            ->orderby('pemasaran_bb_partial.no_tongkang', 'ASC')
            ->get();
        $data['pencampur'] = $db_2->table('detail_pemasaran')
            ->leftjoin('perusahaan', 'perusahaan.id_perusahaan', 'detail_pemasaran.id_penjual')
            ->where('detail_pemasaran.id_pemasaran_bb', $id_pemasaran)->get();
        // dd($data);
        $data['judul'] = 'Verifikasi Pemasaran ' . $data['pemasaran'][0]->id_transaksi;
        $data['url_back'] = route('surveyors.petugas.index_muat_bb', ['jenis_pembeli' => $data['pemasaran'][0]->kategori_pembeli]);
        $pelapor = $data['pemasaran'][0]->pelapor;
        return view('surveyor.verifikasi.page_tongkang', $data);
    }

    public function verif_per_tongkang(Request $request)
    {
        $id_detail = $request->id_detail;
        $db_2 = \DB::connection('pgsql2');
        $data =  $db_2->table('pemasaran_bb_partial')
            ->where('id_detail', $id_detail)
            ->orderby('pemasaran_bb_partial.no_tongkang', 'ASC')
            ->get();
        return $data;
    }

    public function accepted_tongkang(Request $request)
    {

        $db_2 = \DB::connection('pgsql2');
        $volume_input = str_replace('.', '', str_replace(',', '.', $request->volume));
        $volume_asli = str_replace('.', '', str_replace(',', '.', $request->volume_asli));

        $id_pemasaran = $request->id_pemasaran_bb;
        $id_perusahaan = get_perusahaan($id_pemasaran);
        // dd($id_perusahaan);
        $perusahaanya = $id_perusahaan;
        $tgl = (!empty($request->tgl_lhv)) ? reverse_default_date($request->tgl_lhv) : null;
        $invent = cek_invent_perusahaan($perusahaanya);

        if (!empty($request->vol_cam)) {
            $volcam = $request->vol_cam;
        } else {
            $volcam = 0;
        }

        $selisih_volume = ($volume_asli) - ($volume_input - $volcam);
        $hasilfix = $invent + $selisih_volume;
        $status = '200 OK';
        if ($hasilfix < 0) {
            $messages = 'gagal';
        } else if ($hasilfix == 0) {
            if (empty($request->status_hapus)) {
                $data = [
                    "volume" =>  str_replace('.', '', str_replace(',', '.', $request->volume)),
                    "tgl_lhv" => $tgl,
                    "no_lhv" => $request->no_lhv,
                    "nama_tongkang" => $request->nama_tongkang,
                    "tag_boat" => $request->nama_tugboat,
                ];
                /*start  update bb_partial_muat using ws*/
                $data = $db_2->table('pemasaran_bb_partial')
                    ->where('id_detail', $request->id_detail)
                    ->update($data);
                $check = $db_2->table('pemasaran_bb_partial')->where('id_pemasaran_bb', $request->id_pemasaran_bb)->where('no_lhv', null)->get();
                $hasil = Count($check);
                if ($hasil == 0) {
                    $updatedata = ['status_surveyor' => '1'];
                    $updatepemasaran = $db_2->table('pemasaran_bb')->where('id_pemasaran_bb', $request->id_pemasaran_bb)->update($updatedata);
                }
            } else if ($request->status_hapus == 'true') {
                $date = date('Y-m-d H:i:s');
                $datas = [
                    "volume" => str_replace('.', '', str_replace(',', '.', $request->volume)),
                    "tgl_lhv" => $tgl,
                    "no_lhv" => 'DITOLAK',
                    "nama_tongkang" => $request->nama_tongkang,
                    "tag_boat" => $request->nama_tugboat,
                    "deleted_at" => $date,
                ];
                $data = $db_2->table('pemasaran_bb_partial')
                    ->where('id_detail', $request->id_detail)->update($datas);

                $check = $db_2->table('pemasaran_bb_partial')->where('id_pemasaran_bb', $id_pemasaran)->where('no_lhv', null)->get();
                $hasil = Count($check);
                if ($hasil == 0) {
                    $updatedata = ['status_surveyor' => '1'];
                    $updatepemasaran = $db_2->table('pemasaran_bb')->where('id_pemasaran_bb', $id_pemasaran)->update($updatedata);
                }
            } else {
                $date = date('Y-m-d H:i:s');
                $data = [
                    "volume" => str_replace('.', '', str_replace(',', '.', $request->volume)),
                    "tgl_lhv" => $tgl,
                    "no_lhv" => $request->no_lhv,
                    "nama_tongkang" => $request->nama_tongkang,
                    "tag_boat" => $request->nama_tugboat,
                ];
                $data = $db_2->table('pemasaran_bb_partial')
                    ->where('id_detail', $request->id_detail)->update($data);

                mengurangi_invent_selisih($perusahaanya, $selisih_volume);

                $check = $db_2->table('pemasaran_bb_partial')->where('id_pemasaran_bb', $id_pemasaran)->where('no_lhv', null)->get();
                $hasil = Count($check);
                if ($hasil == 0) {
                    $updatedata = ['status_surveyor' => '1'];
                    $updatepemasaran = $db_2->table('pemasaran_bb')->where('id_pemasaran_bb', $id_pemasaran)->update($updatedata);
                }
            }
            $messages = 'Success';
        } else {
            if (empty($request->status_hapus)) {
                $data = [
                    "volume" => str_replace('.', '', str_replace(',', '.',  $request->volume)),
                    "tgl_lhv" => $tgl,
                    "no_lhv" => $request->no_lhv,
                    "nama_tongkang" => $request->nama_tongkang,
                    "tag_boat" => $request->nama_tugboat,
                ];
                /*start  update bb_partial_muat using ws*/

                $data = $db_2->table('pemasaran_bb_partial')
                    ->where('id_detail', $request->id_detail)
                    ->update($data);
                // mengurangi_invent_selisih($perusahaanya, $selisih_volume);

                $check = $db_2->table('pemasaran_bb_partial')->where('id_pemasaran_bb', $request->id_pemasaran_bb)->where('no_lhv', null)->get();
                $hasil = Count($check);
                if ($hasil == 0) {
                    $updatedata = ['status_surveyor' => '1'];
                    $updatepemasaran = $db_2->table('pemasaran_bb')->where('id_pemasaran_bb', $request->id_pemasaran_bb)->update($updatedata);
                    $updated_volume_partial = total_volume_deletd_at($request->id_pemasaran);
                    // dd($updated_volume_partial);
                    $update_final = $db_2->table('final_pemasaran_bb')->where('id_pemasaran_bb', $id_pemasaran)->update(['volume' => $updated_volume_partial]);
                }
            } else if ($request->status_hapus == 'true') {
                $date = date('Y-m-d H:i:s');
                $datas = [
                    "volume" => str_replace('.', '', str_replace(',', '.',  $request->volume)),
                    "tgl_lhv" => $tgl,
                    "no_lhv" => 'DITOLAK',
                    "nama_tongkang" => $request->nama_tongkang,
                    "tag_boat" => $request->nama_tugboat,
                    "deleted_at" => $date,
                ];
                $data = $db_2->table('pemasaran_bb_partial')
                    ->where('id_detail', $request->id_detail)->update($datas);
                $check = $db_2->table('pemasaran_bb_partial')->where('id_pemasaran_bb', $id_pemasaran)->where('no_lhv', null)->get();
                $hasil = Count($check);
                if ($hasil == 0) {
                    $updatedata = ['status_surveyor' => '1'];
                    $updatepemasaran = $db_2->table('pemasaran_bb')->where('id_pemasaran_bb', $id_pemasaran)->update($updatedata);
                    $updated_volume_partial = total_volume_deletd_at($request->id_pemasaran);
                    $update_final = $db_2->table('final_pemasaran_bb')->where('id_pemasaran_bb', $id_pemasaran)->update(['volume' => $updated_volume_partial]);
                }
            } else {
                $date = date('Y-m-d H:i:s');
                $data = [
                    "volume" => str_replace('.', '', str_replace(',', '.',  $request->volume)),
                    "tgl_lhv" => $tgl,
                    "no_lhv" => $request->no_lhv,
                    "nama_tongkang" => $request->nama_tongkang,
                    "tag_boat" => $request->nama_tugboat,
                ];
                $data = $db_2->table('pemasaran_bb_partial')->where('id_pemasaran_bb', $id_pemasaran)
                    ->where('id_detail', $request->id_detail)->update($data);
                //$this->mengembalikan_invent($perusahaanya, $volume_asli);
                $check = $db_2->table('pemasaran_bb_partial')->where('id_pemasaran_bb', $id_pemasaran)->where('no_lhv', null)->get();
                $hasil = Count($check);
                if ($hasil == 0) {
                    $updatedata = ['status_surveyor' => '1'];
                    $updatepemasaran = $db_2->table('pemasaran_bb')->where('id_pemasaran_bb', $id_pemasaran)->update($updatedata);
                }
            }
            $messages = 'Success';
        }

        $result = [
            'status' => $status,
            'messages' => $messages,
            'update_partial' => $data,
        ];

        return redirect()->back()->with(['messsage', $result]);
    }

    public function unggah_dokumenlhv_page(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        $id_pemasaran = base64_decode($request->id_pemasaran);

        $data['tongkang'] = $db_2->table('pemasaran_bb_partial')
            ->where('id_pemasaran_bb', $id_pemasaran)
            ->orderby('no_tongkang', 'ASC')->get();
        $data['pemasaran'] = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
            ->get();
        $data['id_pemasaran'] = $id_pemasaran;
        if ($request->jenis_pembeli == 1) {
            $judul = 'IUP OP / PKP2B / IUP K';
        } elseif ($request->jenis_pembeli == 2) {
            $judul = 'Enduser';
        } elseif ($request->jenis_pembeli == 3) {
            $judul = 'IUP PKP2B';
        } else {
            $judul = '-';
        }
        $data['url_back'] = route('surveyors.petugas.index_muat_bb', ['jenis_pembeli' => $data['pemasaran'][0]->kategori_pembeli]);

        $data['judul'] = 'Upload Dokumen LHV dengan Kode Transaksi : ' . $data['pemasaran'][0]->id_transaksi;

        return view('surveyor.output.upload_lhv', $data);
    }

    public function store_dokumen_lhv(Request $request)
    {
        try {
            $doc_lhv = $request->doc_lhv;
            $status = 0;
            // $url = 'https://moms.esdm.go.id/';
            $url = 'http://115.124.72.219/momsv3/api/v2/';
            if (!empty($request->doc_lhv)) {
                for ($i = 0; $i < count($request->no_lhv); $i++) {
                    if ($request->no_lhv[$i] != 'DITOLAK') {
                        $tmp_name[$i] = ($_FILES['doc_lhv']['tmp_name'][$i]) ? $_FILES['doc_lhv']['tmp_name'][$i] : '';
                        $type[$i] = ($_FILES['doc_lhv']['type'][$i]) ? $_FILES['doc_lhv']['type'][$i] : '';
                        $name[$i] = ($_FILES['doc_lhv']['name'][$i]) ? $_FILES['doc_lhv']['name'][$i] : '';
                        $file_lhv = new \CURLFile($tmp_name[$i], $type[$i], $name[$i]);
                        $data = array(
                            "dokumenlhv" => $file_lhv,
                        );
                        // $ch = curl_init($url . 'upload_dokumen_partial/' . $request->id_detail[$i] . "/". $request->no_lhv[$i] ."/".Auth::user()->id_perusahaan_surveyor);
                        $ch = curl_init($url . 'upload_lhv_partial/' . $request->id_detail[$i] . "/" . Auth::user()->id_perusahaan_surveyor);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        $result = curl_exec($ch);
                        $status = 1;
                    } else {
                        $status = 0;
                    }
                }
                return redirect()->back()->with(['msg' => 'Berhasil Upload Dokumen !']);
            } else {
                return redirect()->back()->withErrors(['Harap Masukan Dokumen !']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors([report($th)]);
        }
    }

    public function verifikasi_cow($id_pemasaran)
    {
        try {
            $id_pemasaran = base64_decode($id_pemasaran);
            $db_2 = \DB::connection('pgsql2');
            $data['pemasaran'] = $db_2->table('pemasaran_bb')
                ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
                ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
                ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
                ->get();
            $data['tongkang'] =  $db_2->table('pemasaran_bb_partial')
                ->where('id_pemasaran_bb', $id_pemasaran)
                ->orderby('pemasaran_bb_partial.no_tongkang', 'ASC')
                ->get();
            $data['pencampur'] = $db_2->table('detail_pemasaran')
                ->leftjoin('perusahaan', 'perusahaan.id_perusahaan', 'detail_pemasaran.id_penjual')
                ->where('detail_pemasaran.id_pemasaran_bb', $id_pemasaran)->get();
            $data['judul'] = 'Verifikasi COW Kode Transaksi : ' . $data['pemasaran'][0]->id_transaksi;
            $data['url_back'] = route('surveyors.petugas.index_tiser_bb', ['jenis_pembeli' => $data['pemasaran'][0]->kategori_pembeli]);
            $pelapor = $data['pemasaran'][0]->pelapor;
            return view('surveyor.verifikasi.page_cow', $data);
        } catch (\Throwable $th) {
            $id_pemasaran = base64_decode($id_pemasaran);
            $db_2 = \DB::connection('pgsql2');
            $data['pemasaran'] = $db_2->table('pemasaran_bb')
                ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
                ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
                ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
                ->get();
            $data['tongkang'] =  $db_2->table('pemasaran_bb_partial')
                ->where('id_pemasaran_bb', $id_pemasaran)
                ->orderby('pemasaran_bb_partial.no_tongkang', 'ASC')
                ->get();
            $data['pencampur'] = $db_2->table('detail_pemasaran')
                ->leftjoin('perusahaan', 'perusahaan.id_perusahaan', 'detail_pemasaran.id_penjual')
                ->where('detail_pemasaran.id_pemasaran_bb', $id_pemasaran)->get();
            $data['judul'] = 'Verifikasi COW Kode Transaksi : ' . $data['pemasaran'][0]->id_transaksi;
            $data['url_back'] = route('surveyors.petugas.index_tiser_bb', ['jenis_pembeli' => $data['pemasaran'][0]->kategori_pembeli]);
            $pelapor = $data['pemasaran'][0]->pelapor;
            return view('surveyor.verifikasi.page_cow', $data);
        }
    }

    public function verifikasi_cow_store(Request $request)
    {
        try {
            $db_2 = \DB::connection('pgsql2');
            $kategori_pembeli = $request->kategori_pembeli;
            $data_pemasaran = $db_2->table('pemasaran_bb')
                ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
                ->where('pemasaran_bb.id_pemasaran_bb', $request->id_pemasaran)->first();

            $inventori = cek_invent_perusahaan($data_pemasaran->pelapor);
            $volumeInduk = str_replace('.', '', str_replace(',', '.', $request->volume_provosional));
            $updated_volume = str_replace(',', '.', str_replace('.', '',  $request->volume_final));
            // dd( $updated_volume);
            $sisa = ($inventori + $volumeInduk) - $updated_volume;
            $id_invent = update_invent($data_pemasaran->pelapor, $data_pemasaran->pelapor);

            if ($request->kategori_pembeli == 1) {
                $judul = 'IUP OP / PKP2B / IUP K';
            } elseif ($request->kategori_pembeli == 2) {
                $judul = 'Enduser';
            } elseif ($request->kategori_pembeli == 3) {
                $judul = 'IUP PKP2B';
            } else {
                $judul = '-';
            }

            if ($sisa > 0) {
                $update_invent_produksi =  ['volume' => $sisa, 'updated_at' => date('Y-m-d H:i:s')];
                $update = $db_2->table('inventori_')->where('id_inventory', $id_invent)->update($update_invent_produksi);
                $update_verifikasi = update_verif_cow($request->id_pemasaran, $request->radios5, $request->no_cow);
                $id_pemasaran_baru = UUID::generate(4);
                $id_final = $data_pemasaran->id_final_bb;

                $page = pemasaran_bb::find($request->id_pemasaran);
                $duplicatePage = $page->replicate();
                $duplicatePage->jenis_laporan = 'final';
                $duplicatePage->id_pemasaran_bb = $id_pemasaran_baru;
                $duplicatePage->save();

                $final = final_pemasaran_bb::find($id_final);
                $duplicatePage_final = $final->replicate();
                $duplicatePage_final->id_final_bb = UUID::generate(4);
                $duplicatePage_final->id_pemasaran_bb = $id_pemasaran_baru;
                $duplicatePage_final->volume = $updated_volume;
                $duplicatePage_final->volume_pencampur = str_replace('.', '', str_replace(',', '.', $request->volume_pencampur));
                $duplicatePage_final->save();

                if ($kategori_pembeli == 1 || $kategori_pembeli == 4) {
                    #code ...
                    $data_trader = ([
                        'id_transaksi' => $data_pemasaran->id_transaksi,
                        'id_pembelian' => UUID::generate(4),
                        'id_pemasaran' => $data_pemasaran->id_pemasaran_bb,
                        'status_transaksi' => 1,
                        'volume' => (float) $updated_volume,
                        'id_penjual' => $data_pemasaran->pelapor,
                        'id_pembeli' => $data_pemasaran->id_masterpembeli,
                        'nilai_invoice' => $data_pemasaran->nilai_invoice,
                        'created_at' => date('Y-m-d H:i:s'),
                        'petugas_survei' => $data_pemasaran->id_surveyor_ts,
                        'id_lokasi_provinsi' => $data_pemasaran->lokasi_pelabuhan,
                    ]);
                    $insert = Pembelian::insert($data_trader);
                    $cek_inventory = Inventory::where('id_trader', $request->id_masterpembeli)->where('id_perusahaan_kerjasama', $request->pelapor)->first();
                    if (count($cek_inventory) > 0) {
                        $sumVolume = $cek_inventory->volume + (float) $updated_volume;
                        $update = Inventory::where('id_trader', $request->id_masterpembeli)
                            ->where('id_perusahaan_kerjasama', $request->pelapor)
                            ->update(['volume' => $sumVolume, 'updated_at' => date('Y-m-d H:i:s')]);
                    } else {
                        $sumVolume = (float) $updated_volume;
                        $insert = Inventory::insert([
                            'id_trader' => $request->id_masterpembeli,
                            'id_perusahaan_kerjasama' => $request->pelapor,
                            'volume' => $sumVolume,
                            'create_at' => date('Y-m-d H:i:s'),
                            'id_inven' => Uuid::generate(4),
                        ]);
                    }
                    $result = [
                        'status' => 'OK',
                        'messages' => 'Berhasil Verifikasi Data',
                    ];
                } else if ($kategori_pembeli == 3) {
                    #code ...
                    $data = array(
                        'id_pembelian_bb' => UUID::generate(4),
                        'volume' => $updated_volume,
                        'date' => $data_pemasaran->date,
                        'created_at' => date('Y-m-d H:i:s'),
                        'mata_uang' => $data_pemasaran->mata_uang,
                        'harga_beli' => $data_pemasaran->harga_jual,
                        'titik_serah' => $data_pemasaran->jenis_pemasaran,
                        'nama_penjual' => get_nama_perusahaan_moms($data_pemasaran->pelapor),
                        'nilai_invoice' => $data_pemasaran->nilai_invoice,
                        'id_transaksi' => $data_pemasaran->id_transaksi,
                        'pelapor' => $data_pemasaran->id_masterpembeli,
                        'cv' => $data_pemasaran->cv,
                        'im' => $data_pemasaran->im,
                        'tm' => $data_pemasaran->tm,
                        'ts' => $data_pemasaran->ts,
                        'ash' => $data_pemasaran->ash,
                    );
                    $inc = $db_2->table('pembelian_bb')->insert($data);

                    $cek = $db_2->table('inventori_')->where('id_perusahaan', $data_pemasaran->id_masterpembeli)
                        ->where('id_perusahaan_kerjasama', $data_pemasaran->pelapor)->first();
                    //Update Pembeli
                    if ($cek) {
                        $dataupdate = [
                            'volume' => (float) $sisa,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];
                        $update = $db_2->table('inventori_')->where('id_inventory', $cek->id_inventory)->update($dataupdate);
                    } else {
                        $datainsert = [
                            'id_inventory' => UUID::generate(4),
                            'id_perusahaan' =>  $data_pemasaran->id_masterpembeli,
                            'id_perusahaan_kerjasama' => $data_pemasaran->pelapor,
                            'volume' => $updated_volume,
                            'created_at' => date('Y-m-d h:i:s'),
                        ];
                        $update = $db_2->table('inventori_')->insert($datainsert);
                    }
                    $result = [
                        'status' => 'OK',
                        'messages' => 'Berhasil Verifikasi Data',
                    ];
                } else if ($kategori_pembeli == 2) {
                    #code ...
                    $result = [
                        'status' => 'OK',
                        'messages' => 'Berhasil Verifikasi Data',
                    ];
                }

                $validate_pln = (!empty($data_pemasaran->id_jadwal)) ? true : false;

                if ($validate_pln == true) {
                    if (is_export_moms($data_pemasaran->pelapor) == 1) {
                        if(is_last_late($data_pemasaran->pelapor) == true){
                            $db_2->table('loginperusahaans')->where('id_perusahaan', $data_pemasaran->pelapor)->update(
                                ['is_export' => '']
                            );
                        }
                    }
                }
                $data = [
                    'jenis_pembeli' => $request->kategori_pembeli,
                    'url' => route('surveyors.verifikator.tiser.bb', ['jenis_pembeli' => $request->kategori_pembeli]),
                    'judul' => 'Data Titik Serah Pemasaran ' . $judul,
                    'result' => $result
                ];
            } else {
                $result = [
                    'status' => 'Error',
                    'messages' => 'Volume Inventori Tidak Mencukupi',
                ];
                $data = [
                    'jenis_pembeli' => $request->kategori_pembeli,
                    'url' => route('surveyors.verifikator.tiser.bb', ['jenis_pembeli' => $request->kategori_pembeli]),
                    'judul' => 'Data Titik Serah Pemasaran ' . $judul,
                    'result' => $result
                ];
            }

            return redirect()->route('surveyors.petugas.index_tiser_bb', ['jenis_pembeli' => $request->kategori_pembeli])->with(['messsage', $result]);
        } catch (\Throwable $th) {
            $result = [
                'status' => 'Error',
                'messages' => 'Terjadi Kesalahan !',
            ];
            $data = [
                'jenis_pembeli' => $request->kategori_pembeli,
                'url' => route('surveyors.verifikator.tiser.bb', ['jenis_pembeli' => $request->kategori_pembeli]),
                'judul' => 'Data Titik Serah Pemasaran ' . $judul,
                'result' => $result
            ];
            return redirect()->route('surveyors.petugas.index_tiser_bb', ['jenis_pembeli' => $request->kategori_pembeli])->with(['messsage', $result]);
        }
    }

    public function verifikasi_coa($id_pemasaran)
    {
        $id_pemasaran = base64_decode($id_pemasaran);
        $db_2 = \DB::connection('pgsql2');
        $data['pemasaran'] = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
            ->get();
        $data['tongkang'] =  $db_2->table('pemasaran_bb_partial')
            ->where('id_pemasaran_bb', $id_pemasaran)
            ->orderby('pemasaran_bb_partial.no_tongkang', 'ASC')
            ->get();
        $data['pencampur'] = $db_2->table('detail_pemasaran')
            ->leftjoin('perusahaan', 'perusahaan.id_perusahaan', 'detail_pemasaran.id_penjual')
            ->where('detail_pemasaran.id_pemasaran_bb', $id_pemasaran)->get();
        $data['judul'] = 'Verifikasi COA Kode Transaksi : ' . $data['pemasaran'][0]->id_transaksi;
        $data['url_back'] = route('surveyors.petugas.index_tiser_bb', ['jenis_pembeli' => $data['pemasaran'][0]->kategori_pembeli]);
        $pelapor = $data['pemasaran'][0]->pelapor;
        return view('surveyor.verifikasi.page_coa', $data);
    }

    public function verifikasi_coa_store(Request $request)
    {
        try {
            $id_pemasaran = base64_decode($request->id_pemasaran);
            $id_transaksi =  base64_decode($request->id_transaksi);
            $db_2 = \DB::connection('pgsql2');
            $data = [
                'cv' => ($request->gcv_arb) ? str_replace('.', '', str_replace(',', '.', $request->gcv_arb)) : 0,
                'im' => ($request->im) ? str_replace('.', '', str_replace(',', '.', $request->im)) : 0,
                'tm' => ($request->tm) ? str_replace('.', '', str_replace(',', '.', $request->tm)) : 0,
                'ts' => ($request->ts_arb) ? str_replace('.', '', str_replace(',', '.', $request->ts_arb)) : 0,
                'ash' => ($request->ash_arb) ? str_replace('.', '', str_replace(',', '.', $request->ash_arb)) : 0,
                'vm' => ($request->vm_adb) ? str_replace('.', '', str_replace(',', '.', $request->vm_adb)) : 0,
                'gcv' => ($request->gcv_adb) ? str_replace('.', '', str_replace(',', '.', $request->gcv_adb)) : 0,
                'above' => ($request->above) ? str_replace('.', '', str_replace(',', '.', $request->above)) : 0,
                'fc' => ($request->fc_adb) ? str_replace('.', '', str_replace(',', '.', $request->fc_adb)) : 0,
                'size' => ($request->hgi) ? str_replace('.', '', str_replace(',', '.', $request->hgi)) : 0,
                'hgi' => ($request->hgi) ?  str_replace('.', '', str_replace(',', '.', $request->hgi)) : 0,
            ];

            $update = $db_2->table('final_pemasaran_bb')->where('id_pemasaran_bb', $id_pemasaran)->update($data);
            $updatedata = ['status_coa' => '1'];
            $updatepemasaran = $db_2->table('pemasaran_bb')->where('id_transaksi', $id_transaksi)->update($updatedata);
            $check = $db_2->table('pemasaran_bb')->where('id_transaksi', $id_transaksi)->get();
            foreach ($check as $key) {
                $datadetail = [
                    "id_detail_kualitas" => UUID::generate(4),
                    "id_pemasaran" => $key->id_pemasaran_bb,
                    /*Data DETAIL*/
                    "ash_adb" => ($request->ash_adb) ?  str_replace('.', '', str_replace(',', '.', $request->ash_adb)) : 0,
                    "size" => ($request->size) ?  str_replace('.', '', str_replace(',', '.', $request->size)) : 0,
                    "above" => ($request->above) ?  str_replace('.', '', str_replace(',', '.', $request->above)) : 0,
                    "ts_adb" => ($request->ts_adb) ?  str_replace('.', '', str_replace(',', '.', $request->ts_adb)) : 0,
                    "vm" => ($request->vm_adb) ?  str_replace('.', '', str_replace(',', '.', $request->vm_adb)) : 0,
                    "fc" => ($request->fc_adb) ?  str_replace('.', '', str_replace(',', '.', $request->fc_adb)) : 0,
                    "hgi" => ($request->hgi) ?  str_replace('.', '', str_replace(',', '.', $request->hgi)) : 0,
                    /* Parameter */
                    "nvc" => ($request->ncv_arb) ?  str_replace('.', '', str_replace(',', '.', $request->ncv_arb)) : 0,
                    "gcv_adb" => ($request->gcv_adb) ?  str_replace('.', '', str_replace(',', '.', $request->gcv_adb)) : 0,
                    /*Ultimate */
                    "hydrogen" => ($request->hydrogen) ?  str_replace('.', '', str_replace(',', '.', $request->hydrogen)) : 0,
                    "carbon" => ($request->carbon) ?  str_replace('.', '', str_replace(',', '.', $request->carbon)) : 0,
                    "nitrogen" => ($request->nitrogen) ?  str_replace('.', '', str_replace(',', '.', $request->nitrogen)) : 0,
                    "sulphur" => ($request->sulphur) ?  str_replace('.', '', str_replace(',', '.', $request->sulphur)) : 0,
                    "oxygen" => ($request->oxygen) ?  str_replace('.', '', str_replace(',', '.', $request->oxygen)) : 0,
                    /*Ash Analysis */
                    "SiO2" => ($request->SiO2) ?  str_replace('.', '', str_replace(',', '.', $request->SiO2)) : 0,
                    "Al2O3" => ($request->Al2O3) ?  str_replace('.', '', str_replace(',', '.', $request->Al2O3)) : 0,
                    "Fe2O3" => ($request->Fe2O3) ?  str_replace('.', '', str_replace(',', '.', $request->Fe2O3)) : 0,
                    "CaO" => ($request->CaO) ?  str_replace('.', '', str_replace(',', '.', $request->CaO)) : 0,
                    "MgO" => ($request->MgO) ?  str_replace('.', '', str_replace(',', '.', $request->MgO)) : 0,
                    "TiO2" => ($request->TiO2) ?  str_replace('.', '', str_replace(',', '.', $request->TiO2)) : 0,
                    "Na2O" => ($request->Na2O) ?  str_replace('.', '', str_replace(',', '.', $request->Na2O)) : 0,
                    "K2O" => ($request->K2O) ?  str_replace('.', '', str_replace(',', '.', $request->K2O)) : 0,
                    "Mn3O4" => ($request->Mn3O4) ?  str_replace('.', '', str_replace(',', '.', $request->Mn3O4)) : 0,
                    "SO3" => ($request->SO3) ?  str_replace('.', '', str_replace(',', '.', $request->SO3)) : 0,
                    "P2O5" => ($request->P2O5) ?  str_replace('.', '', str_replace(',', '.', $request->P2O5)) : 0,
                    "Boron" => ($request->Boron) ?  str_replace('.', '', str_replace(',', '.', $request->Boron)) : 0,
                    "Selenium" => ($request->Selenium) ?  str_replace('.', '', str_replace(',', '.', $request->Selenium)) : 0,
                    "Phosphorus" => ($request->Phosphorus) ?  str_replace('.', '', str_replace(',', '.', $request->Phosphorus)) : 0,
                    "Chlorine" => ($request->Chlorine) ?  str_replace('.', '', str_replace(',', '.', $request->Chlorine)) : 0,
                    "Fluorine" => ($request->Fluorine) ?  str_replace('.', '', str_replace(',', '.', $request->Fluorine)) : 0,
                    "Mercury" => ($request->Mercury) ?  str_replace('.', '', str_replace(',', '.', $request->Mercury)) : 0,
                    "Arsenic" => ($request->Arsenic) ?  str_replace('.', '', str_replace(',', '.', $request->Arsenic)) : 0,
                    /*ASH Red Oxy */
                    "initial_deformation_reduc" => ($request->initial_deformation_red) ?  str_replace('.', '', str_replace(',', '.', $request->initial_deformation_red)) : 0,
                    "spherical_reduc" => ($request->spherical_red) ?  str_replace('.', '', str_replace(',', '.', $request->spherical_red)) : 0,
                    "hemispherical_reduc" => ($request->hemispherical_red) ?  str_replace('.', '', str_replace(',', '.', $request->hemispherical_red)) : 0,
                    "flow_reduc" => ($request->flow_red) ?  str_replace('.', '', str_replace(',', '.', $request->flow_red)) : 0,
                    "spherical_oxid" => ($request->spherical_ox) ?  str_replace('.', '', str_replace(',', '.', $request->spherical_ox)) : 0,
                    "initial_deformation_oxid" => ($request->initial_deformation_ox) ?  str_replace('.', '', str_replace(',', '.', $request->initial_deformation_ox)) : 0,
                    "hemispherical_oxid" => ($request->hemispherical_ox) ?  str_replace('.', '', str_replace(',', '.', $request->hemispherical_ox)) : 0,
                    "flow_oxid" => ($request->flow_ox) ?  str_replace('.', '', str_replace(',', '.', $request->flow_ox)) : 0,
                    /* Other */
                    "photopermeability_mean" => ($request->pm) ?  str_replace('.', '', str_replace(',', '.', $request->pm)) : 0,
                    "aft" => ($request->aft) ?  str_replace('.', '', str_replace(',', '.', $request->aft)) : 0,
                    "csn" => ($request->CSN) ?  str_replace('.', '', str_replace(',', '.', $request->CSN)) : 0,
                    "fluidity" => ($request->Fluidity) ?  str_replace('.', '', str_replace(',', '.', $request->Fluidity)) : 0,
                    "csr" => ($request->CSR) ?  str_replace('.', '', str_replace(',', '.', $request->CSR)) : 0,
                ];
                $inc_pemasaran_detail_kualitas = $db_2->table('pemasaran_bb_kualitas')->insert($datadetail);
            }

            if ($request->kategori_pembeli == 1) {
                $judul = 'IUP OP / PKP2B / IUP K';
            } elseif ($request->kategori_pembeli == 2) {
                $judul = 'Enduser';
            } elseif ($request->kategori_pembeli == 3) {
                $judul = 'IUP PKP2B';
            } else {
                $judul = '-';
            }
            $data = [
                'jenis_pembeli' => $request->kategori_pembeli,
                'url' => route('surveyors.verifikator.tiser.bb', ['jenis_pembeli' => $request->kategori_pembeli]),
                'judul' => 'Data Titik Serah Pemasaran ' . $judul,
            ];
            return redirect()->route('surveyors.petugas.index_tiser_bb', ['jenis_pembeli' => $request->kategori_pembeli])->with(['messsage', $data]);
        } catch (\Throwable $th) {
            $result = [
                'status' => 'Error',
                'messages' => 'Terjadi Kesalahan !',
            ];
            $data = [
                'jenis_pembeli' => $request->kategori_pembeli,
                'url' => route('surveyors.verifikator.tiser.bb', ['jenis_pembeli' => $request->kategori_pembeli]),
                'judul' => 'Data Titik Serah Pemasaran ' . $judul,
                'result' => $result
            ];
            return redirect()->route('surveyors.petugas.index_tiser_bb', ['jenis_pembeli' => $request->kategori_pembeli])->with(['messsage', $data]);
        }
    }

    public function verif_tongkang_isp($id_pemasaran)
    {

        $id_pemasaran = base64_decode($id_pemasaran);
        $db_2 = \DB::connection('pgsql2');
        $data['pemasaran'] = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
            ->get();
        $data['tongkang'] =  $db_2->table('pemasaran_bb_partial')
            ->where('id_pemasaran_bb', $id_pemasaran)
            ->orderby('pemasaran_bb_partial.no_tongkang', 'ASC')
            ->get();
        $data['pencampur'] = $db_2->table('detail_pemasaran')
            ->leftjoin('perusahaan', 'perusahaan.id_perusahaan', 'detail_pemasaran.id_penjual')
            ->where('detail_pemasaran.id_pemasaran_bb', $id_pemasaran)->get();
        // dd($data);
        $data['judul'] = 'Verifikasi Pemasaran ' . $data['pemasaran'][0]->id_transaksi;
        $data['url_back'] = route('surveyors.petugas.index_isp');
        $pelapor = $data['pemasaran'][0]->pelapor;
        return view('surveyor.verifikasi.page_tongkang_isp', $data);
    }

    /*START MINERAL*/

    public function verif_dokumen_mn(Request $request)
    {
        $id_pemasaran = $request->id_pemasaran;
        $db_2 = \DB::connection('pgsql2');
        $data['pemasaran'] = $db_2->table('pemasaran_mn')
            ->join('final_pemasaran_mn', 'pemasaran_mn.id_pemasaran_mn', 'final_pemasaran_mn.id_pemasaran_mn')
            ->where('pemasaran_mn.id_pemasaran_mn', $id_pemasaran)
            ->get();
        $data['tongkang'] =  $db_2->table('pemasaran_mn_partial')
            ->where('id_pemasaran_mn', $id_pemasaran)
            ->get();
        $pelapor = $data['pemasaran'][0]->pelapor;
        $bb = $data['pemasaran'][0]->dokumen_buktibayar;
        $shp = $data['pemasaran'][0]->dokumen_invoice;
        if ($request->tipe_dokumen == 'invoice') {
            $dok_shipping = $this->validate_url_file($pelapor, 'invoice', $shp);
            $url = route('surveyors.dokumen.mn.accept');
        } else {
            $dok_shipping = $this->validate_url_file($pelapor, 'buktibayar_mn', $bb);
            $url = route('surveyors.buktibayar.mn.accept');
        }
        $data['dok_shipping'] = '' . $dok_shipping['file'];
        $data['tipe_dokumen'] = $request->tipe_dokumen;
        $data['url'] = $url;
        return view('surveyor.modal.modal_dokumen_mn', $data);
    }

    public function verifikasi_dokumen_mn(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        $dataupdate = ['status_invoice' => '1'];
        $query = $db_2->table('pemasaran_mn')
            ->where('id_pemasaran_mn', $request->id_pemasaran)
            ->update($dataupdate);
        return redirect()->back()->with(['messsage', 'Success']);
    }

    public function verifikasi_buktibayar_mn(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        $dataupdate = ['status_buktibayar' => '1'];
        $query = $db_2->table('pemasaran_mn')
            ->where('id_pemasaran_mn', $request->id_pemasaran)
            ->update($dataupdate);
        return redirect()->back()->with(['messsage', 'Success']);
    }

    public function reject_dokumen_mn(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = [
            "id_pemasaran_mn" => $request->id_pemasaran,
            "alasan" => $request->alasan,
        ];
        try {
            $data = [
                'status_konfirmasi' => '0',
                'status_surveyor' => '2',
                'alasan_tolak_transaksi' => $request->alasan,
            ];
            $db_2->table('pemasaran_mn')
                ->where('id_pemasaran_mn', $request->id_pemasaran)
                ->update($data);
            echo json_encode(['status' => '200']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error']);
        }
    }

    public function verif_tongkang_mn($id_pemasaran)
    {
        $id_pemasaran = base64_decode($id_pemasaran);
        $db_2 = \DB::connection('pgsql2');
        $data['pemasaran'] = $db_2->table('pemasaran_mn')
            ->join('final_pemasaran_mn', 'pemasaran_mn.id_pemasaran_mn', 'final_pemasaran_mn.id_pemasaran_mn')
            ->where('pemasaran_mn.id_pemasaran_mn', $id_pemasaran)
            ->get();
        $data['tongkang'] =  $db_2->table('pemasaran_mn_partial')
            ->where('id_pemasaran_mn', $id_pemasaran)
            ->orderby('pemasaran_mn_partial.no_tongkang', 'ASC')
            ->get();
        $data['pencampur'] = 0;
        // dd($data);
        $data['judul'] = 'Verifikasi Pemasaran ' . $data['pemasaran'][0]->id_transaksi;
        $data['url_back'] = route('surveyors.petugas.index_muat_mn', ['jenis_pembeli' => $data['pemasaran'][0]->kategori_pembeli]);
        $pelapor = $data['pemasaran'][0]->pelapor;
        return view('surveyor.verifikasi.page_tongkang_mn', $data);
    }

    public function verif_per_tongkang_mn(Request $request)
    {
        $id_detail = $request->id_detail;
        $db_2 = \DB::connection('pgsql2');
        $data =  $db_2->table('pemasaran_mn_partial')
            ->where('id_detail', $id_detail)
            ->orderby('pemasaran_mn_partial.no_tongkang', 'ASC')
            ->get();

        return $data;
    }

    public function accepted_tongkang_mn(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        $tgl = (!empty($request->tgl_lhv)) ? reverse_default_date($request->tgl_lhv) : null;


        $data = $db_2->table('pemasaran_mn_partial')
            ->where('id_detail', $request->id_detail)
            ->update([
                "volume" => str_replace(',', '.', str_replace('.', '', $request->volume)),
                "tgl_lhv" => $tgl,
                "no_lhv" => $request->no_lhv,
                "no_tongkang" => $request->no_tongkang,
                "nama_tongkang" => $request->nama_tongkang,
                "tag_boat" => $request->tugboat,
            ]);

        $check = $db_2->table('pemasaran_mn_partial')->where('id_pemasaran_mn', $request->id_pemasaran_mn)->where('no_lhv', null)->get();
        $hasil = Count($check);
        if ($hasil == 0) {
            $updatedata = ['status_surveyor' => '1'];
            $updatepemasaran = $db_2->table('pemasaran_mn')->where('id_pemasaran_mn', $request->id_pemasaran_mn)->update($updatedata);
            $result = [
                'status' => 'success',
                'update_partial' => $data,
                'final' => $hasil
            ];
        } else {
            $result = [
                'status' => 'failed',
                'update_partial' => $data,
                'final' => $hasil
            ];
        }
        return redirect()->back()->with(['messsage', $result]);
    }

    public function unggah_dokumenlhv_page_mn(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        $id_pemasaran = base64_decode($request->id_pemasaran);
        $data['tongkang'] = $db_2->table('pemasaran_mn_partial')
            ->where('id_pemasaran_mn', $id_pemasaran)
            ->orderby('no_tongkang', 'ASC')->get();
        $data['pemasaran'] = $db_2->table('pemasaran_mn')
            ->join('final_pemasaran_mn', 'pemasaran_mn.id_pemasaran_mn', 'final_pemasaran_mn.id_pemasaran_mn')
            ->where('pemasaran_mn.id_pemasaran_mn', $id_pemasaran)
            ->get();
        $data['id_pemasaran'] = $id_pemasaran;
        if ($request->jenis_pembeli == 1) {
            $judul = 'IUP OP / PKP2B / IUP K';
        } elseif ($request->jenis_pembeli == 2) {
            $judul = 'Enduser';
        } elseif ($request->jenis_pembeli == 3) {
            $judul = 'IUP PKP2B';
        } else {
            $judul = '-';
        }
        $data['url_back'] = route('surveyors.petugas.index_muat_mn', ['jenis_pembeli' => $data['pemasaran'][0]->kategori_pembeli]);

        $data['judul'] = 'Upload Dokumen LHV dengan Kode Transaksi : ' . $data['pemasaran'][0]->id_transaksi;

        return view('surveyor.output.upload_lhv_mn', $data);
    }

    public function data_produksi(Request $request)
    {
        $id_produksi = $request->id_produksi;
        $surveyor = Auth::guard('surveyors')->user()->id_perusahaan_surveyor;
        $dat = DB::table('surveyor')->get();
        $id_surveyor = '';
        if ($surveyor == null) {
            $id_surveyor = Auth::guard('surveyors')->user()->uuid;
        } else {
            $id_surveyor = $surveyor;
        }

        $db_2 = \DB::connection('pgsql2');
        $query = $db_2->table('produksi_batubara_realisasi')
            ->leftJoin('blok', function ($join) {
                $join->on('produksi_batubara_realisasi.id_blok', '=', 'blok.id_blok');
            })
            ->leftJoin('perusahaan', function ($join) {
                $join->on('produksi_batubara_realisasi.id_perusahaan', '=', 'perusahaan.id_perusahaan');
            })
            ->leftJoin('master_jenis_pencatatan', function ($join) {
                $join->on('master_jenis_pencatatan.id_jenis_pencatatan', '=', 'produksi_batubara_realisasi.jenis_pencatatan');
            })
            ->leftJoin('master_jenis_produksi', function ($join) {
                $join->on('master_jenis_produksi.id_jenis_produksi', '=', 'produksi_batubara_realisasi.jenis_produksi');
            })
            ->where('produksi_batubara_realisasi.id_produksi_bb', $id_produksi)
            ->get();
        $data = $query;
        $perusahaan = $db_2->table('perusahaan')->select('nama')->where('id_perusahaan', $query[0]->id_perusahaan)->get();
        $pelapor  = $perusahaan[0]->nama;
        return view('surveyor.modal.modal_produksi_bb', compact('data', 'pelapor'));
    }

    public function data_produksi_mn(Request $request)
    {
        $id_produksi = $request->id_produksi;
        $surveyor = Auth::guard('surveyors')->user()->id_perusahaan_surveyor;
        $dat = DB::table('surveyor')->get();
        $id_surveyor = '';
        if ($surveyor == null) {
            $id_surveyor = Auth::guard('surveyors')->user()->uuid;
        } else {
            $id_surveyor = $surveyor;
        }

        $db_2 = \DB::connection('pgsql2');
        $query = $db_2->table('produksi_mineral_realisasi')
            ->leftJoin('blok', function ($join) {
                $join->on('produksi_mineral_realisasi.id_blok', '=', 'blok.id_blok');
            })
            ->leftJoin('perusahaan', function ($join) {
                $join->on('produksi_mineral_realisasi.id_perusahaan', '=', 'perusahaan.id_perusahaan');
            })
            ->leftJoin('master_jenis_pencatatan', function ($join) {
                $join->on('master_jenis_pencatatan.id_jenis_pencatatan', '=', 'produksi_mineral_realisasi.jenis_pencatatan');
            })
            ->leftJoin('master_jenis_produksi', function ($join) {
                $join->on('master_jenis_produksi.id_jenis_produksi', '=', 'produksi_mineral_realisasi.jenis_produksi');
            })
            ->where('produksi_mineral_realisasi.id_produksi_mn', $id_produksi)

            ->get();
        $data = $query;
        $perusahaan = $db_2->table('perusahaan')->select('nama')->where('id_perusahaan', $query[0]->id_perusahaan)->get();
        $pelapor  = $perusahaan[0]->nama;
        return view('surveyor.modal.modal_produksi_mn', compact('data', 'pelapor'));
    }

    public function verif_produksi_bb(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        try {
            $ip = $request->id_perusahaan;
            $check =  $db_2->table('inventori_')->Where('id_perusahaan', $ip)->where('id_perusahaan_kerjasama', $ip)->first();
            if (empty($count)) {
                #code ...
            } else {
                foreach ($check as $t) {
                    $volA = $t->volume;
                }
                $volAwal = $check->volume;
                $vol_baru = str_replace(',', '.', str_replace('.', '', $request->volume));
                $storedVolume = $volAwal + $vol_baru;
                $db_2->table('inventori_')
                    ->where('id_perusahaan_kerjasama', $ip)->where('id_perusahaan', $ip)
                    ->update([
                        'volume' => $storedVolume,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            }
            $test =  $db_2->table('produksi_batubara_realisasi')->where('id_produksi_bb', $request->id_produksi)
                ->update(
                    [
                        'status_surveyor' => 1,
                    ]
                );
            $e = 'Berhasil Verifikasi Produksi Penambangan';
        } catch (Exception $e) {
            throw $e;
        }
        return redirect()->back()->with(['msg' => $e]);
    }

    public function reject_produksi_bb(Request $request, $id_pemasaran)
    {
        $db_2 = \DB::connection('pgsql2');
        try {
            $db_2->table('produksi_batubara_realisasi')->where('id_produksi_bb', $id_pemasaran)
                ->update(
                    [
                        'status_surveyor' => 2,
                    ]
                );
            $e = 'Berhasil Menolak Produksi Penambangan';
        } catch (Exception $e) {
            throw $e;
        }
        return redirect()->back()->with(['msg' => $e]);
    }

    public function verif_produksi_mn(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');
        try {
            $db_2->table('produksi_mineral_realisasi')->where('id_produksi_mn', $request->id_produksi)
                ->update(
                    [
                        'status_surveyor' => 1,
                    ]
                );

            $e = 'Berhasil Verifikasi Produksi Penambangan';
        } catch (Exception $e) {
            throw $e;
        }
        return redirect()->back()->with(['msg' => $e]);
    }

    public function reject_produksi_mn(Request $request, $id_pemasaran)
    {
        $db_2 = \DB::connection('pgsql2');
        try {
            $db_2->table('produksi_mineral_realisasi')->where('id_produksi_mn', $id_pemasaran)
                ->update(
                    [
                        'status_surveyor' => 2,
                    ]
                );
            $e = 'Berhasil Menolak Produksi Penambangan';
        } catch (Exception $e) {
            throw $e;
        }
        return redirect()->back()->with(['msg' => $e]);
    }

    /*PEMASARAN TRADER*/

    public function accepted_pemasaran_trader(Request $request)
    {

        $db_2 = \DB::connection('pgsql2');
        $volume_input = str_replace('.', '', str_replace(',', '.', $request->volume_verif));
        $volume_asli = str_replace('.', '', str_replace(',', '.', $request->volume_awal));
        $id_pemasaran = $request->id_pemasaran_bb;
        $tgl = (!empty($request->tgl_lhv)) ? reverse_default_date($request->tgl_lhv) : null;
        $selisih =  $volume_input  -  $volume_asli;
        $pemasaran =    DB::table('pemasaran_bb')
            ->where('id_pemasaran_bb', $id_pemasaran)->get();
        try {
            DB::table('pemasaran_bb')
                ->where('id_pemasaran_bb', $id_pemasaran)
                ->update(
                    [
                        'total_volume' => str_replace(',', '.', str_replace('.', '',  $volume_input)),
                        'status_surveyor' => 1,
                        'no_lhv' => $request->no_lhv,
                        'tgl_input' => $tgl,
                        'status_cetak_lhv' => 0,
                    ]
                );
            $newuuid = Uuid::generate(4);
            foreach ($pemasaran as $p) {
                $id_masterpembeli = $p->id_masterpembeli;
                $kategori_pembeli = $p->kategori_pembeli;
                $id_trader = $p->pelapor;
            }

            $detail_pemasaran = DB::table('pemasaran_detail_vol')
                ->where('id_pemasaran_bb', $id_pemasaran)->get();

            for ($i = 0; $i < count($detail_pemasaran); $i++) {
                $perusahaan_kerjasama = $detail_pemasaran[$i]->id_master_pembeli;

                $cek_sisa = DB::table('inventori_trader')->where('id_trader', $id_trader)
                    ->where('id_perusahaan_kerjasama', $detail_pemasaran[$i]->id_master_pembeli)->sum('volume');

                $hasil =  $cek_sisa - $detail_pemasaran[$i]->volume;

                DB::table('inventori_trader')
                    ->where('id_trader', $id_trader)
                    ->where('id_perusahaan_kerjasama', $perusahaan_kerjasama)
                    ->update(
                        [
                            'volume' => $hasil
                        ]
                    );
            }
            /*Post Inventori Pembelian*/
            $newuuid = Uuid::generate(4);
            if ($request->kategori_pembeli == 1) {
                $caridiinvent = DB::table('inventori_trader')
                    ->where('id_trader', $id_masterpembeli)
                    ->where('id_perusahaan_kerjasama', $id_trader)
                    ->count();
                if ($caridiinvent == 0) {
                    DB::table('inventori_trader')->insert(
                        [
                            'id_inven' => $newuuid,
                            'id_trader' => $id_masterpembeli,
                            'id_perusahaan_kerjasama' => $id_trader,
                            'volume' => $volume_input,
                            'create_at' => date('Y-m-d H:i:s'),
                        ]
                    );
                } else {
                    $a = DB::table('inventori_trader')->where('id_trader', $id_masterpembeli)->where('id_perusahaan_kerjasama', $id_trader)->sum('volume');
                    $updated = $a + $volume_input;
                    DB::table('inventori_trader')->where('id_trader', $id_masterpembeli)
                        ->where('id_perusahaan_kerjasama', $id_trader)
                        ->update(
                            [
                                'volume' => $updated,
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]
                        );
                }
            }
            /*Post Inventori Pembelian*/
            $e = 'Berhasil Verifikasi Penambangan';
            return redirect()->route('surveyors.petugas.index_trader')->with(['msg' => $e]);
        } catch (Exception $e) {
            return redirect()->back()->with(['msg' => $e]);
        }
    }

    public function reject_pemasaran_trader(Request $request)
    {
        try {
            $status =  DB::table('pemasaran_bb')
                ->where('id_pemasaran_bb', $request->id_pemasaran_bb)
                ->update(
                    [
                        'status_konfirmasi' => null,
                    ]
                );
            return $status;
        } catch (\Throwable $th) {
            return report($th);
        }
    }

    public function verif_tongkang_trader($id_pemasaran)
    {
        try {
            $id_pemasaran = base64_decode($id_pemasaran);
            $data['pemasaran'] = DB::table('pemasaran_bb')
                ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
                ->get();
            $data['pencampur'] = DB::table('pemasaran_detail_vol')
                ->where('pemasaran_detail_vol.id_pemasaran_bb', $id_pemasaran)->get();
            $data['judul'] = 'Verifikasi Pemasaran ' . $data['pemasaran'][0]->id_transaksi;
            $data['url_back'] = route('surveyors.petugas.index_trader');
            $pelapor = $data['pemasaran'][0]->pelapor;
            return view('surveyor.verifikasi.page_tongkang_trader', $data);
        } catch (\Throwable $th) {
            $id_pemasaran = base64_decode($id_pemasaran);
            $data['pemasaran'] = DB::table('pemasaran_bb')
                ->where('pemasaran_bb.id_pemasaran_bb', $id_pemasaran)
                ->get();
            $data['pencampur'] = DB::table('pemasaran_detail_vol')
                ->where('pemasaran_detail_vol.id_pemasaran_bb', $id_pemasaran)->get();
            $data['judul'] = 'Verifikasi Pemasaran ' . $data['pemasaran'][0]->id_transaksi;
            $data['url_back'] = route('surveyors.petugas.index_trader');
            $pelapor = $data['pemasaran'][0]->pelapor;
            return view('surveyor.verifikasi.page_tongkang_trader', $data);
        }
    }

    public function verif_pemasaran_trader(Request $request)
    {
        $id_detail = $request->id_detail;
        $db_2 = \DB::connection('pgsql2');
        $data = DB::table('pemasaran_bb')
            ->where('pemasaran_bb.id_pemasaran_bb', $id_detail)
            ->get();
        return $data;
    }

    public function upload_modal_trader(Request $request)
    {
        $id_pemasaran = $request->get('id_pemasaran');
        $db_2 = \DB::connection('pgsql2');
        $data['pemasaran'] = DB::table('pemasaran_bb')
            ->where('id_pemasaran_bb', $id_pemasaran)
            ->get();

        $data['pencampur'] = DB::table('pemasaran_detail_vol')->where('id_pemasaran_bb', $id_pemasaran)->get();

        /* detail volume pencampur */
        return view('perusahaan_surveyor.modal.upload_trader', $data);
    }
    function upload_lhv_trader(Request $request)
    {
        try {
            $pemasaran_bb = DB::table('pemasaran_bb')->where('id_pemasaran_bb', $request->id_pemasaran_bb)->get();

            if ($request->hasFile('doc_lhv')) {
                $filename = 'LHV-' . uniqid() . '.' . $request->file("doc_lhv")->getClientOriginalExtension();
                $destination = public_path() . '/uploads/lhv/' . $pemasaran_bb[0]->pelapor;

                $path = public_path() . '/uploads/lhv/' . $pemasaran_bb[0]->pelapor . '/';
                // $root = $_SERVER["DOCUMENT_ROOT"];
                // $dir = $root . '/' . $path;
                if (!file_exists($destination)) {
                    if (!is_dir($destination)) {
                        mkdir($destination, 0755, true);
                    } else {
                        mkdir($destination, 0755, true);
                    }
                }

                $request->file('doc_lhv')->move($destination, $filename);
            } else {
                $filename = null;
            }
            DB::table('pemasaran_bb')
                ->where('id_pemasaran_bb',  $request->id_pemasaran_bb)
                ->update(
                    [
                        'dokumen_lhv' => $filename,
                    ]
                );
            $th = 'Berhasil Unggah Dokumen LHV';
            return redirect()->back()->with(['msg' => $th]);
        } catch (\Throwable $e) {
            $th = 'Gagal Unggah Dokumen ' . report($e);
            return redirect()->back()->with(['msg' => $th]);
        }
    }
}
