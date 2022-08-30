<?php

use App\Models\LogActivity;

if (!function_exists('site_logo')) {
    function site_logo($used_for)
    {
        $pict = DB::table('site_logo')->whereNull('deleted_at')->where('used_for', 'favicon')->first();

        $retVal = ($pict) ? $pict->filename : $pict->filename;
        $pict = '{{asset(' . $pict->path . '' . $pict->filename . ')}}';
        return $pict;
    }
}

if (!function_exists('tgl_indo')) {
    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
    }
}

if (!function_exists('default_date')) {
    function default_date($tanggal)
    {
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . '/' . $pecahkan[1] . '/' . $pecahkan[0];
    }
}

if (!function_exists('reverse_default_date')) {
    function reverse_default_date($tanggal)
    {
        $pecahkan = explode('/', $tanggal);
        return $pecahkan[2] . '-' . $pecahkan[1] . '-' . $pecahkan[0];
    }
}

if (!function_exists('get_nama_trader')) {
    function get_nama_trader($id_perusahaan)
    {
        $data = DB::table('treader')->where('id_perusahaan', $id_perusahaan)->first();
        if (!empty($data)) {
            $result = $data->nama;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('get_nama_perusahaan_moms')) {
    function get_nama_perusahaan_moms($id_perusahaan)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('perusahaan')->where('id_perusahaan', $id_perusahaan)->first();
        if (!empty($data)) {
            $result = $data->nama;
        } else {
            $result = '-';
        }
        return $result;
    }
}


if (!function_exists('get_nama_stockpile')) {
    function get_nama_stockpile($id_perusahaan)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_stockpile')->where('id_stockpile', $id_perusahaan)->first();
        if (!empty($data)) {
            $result = $data->nama_stockpile;
        } else {
            $result = 'ISP Tidak Terdaftar';
        }
        return $result;
    }
}

if (!function_exists('get_nama_master_pembeli_moms')) {
    function get_nama_master_pembeli_moms($id_perusahaan)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_pembeli')->where('id_pembeli', $id_perusahaan)->first();
        if (!empty($data)) {
            $result = $data->nama_pembeli;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('get_provinsi_id')) {
    function get_provinsi_id($id_provinsi)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_provinsi')->where('id_provinsi', $id_provinsi)->first();
        if (!empty($data)) {
            $result = $data->nama_provinsi;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('get_provinsi_data')) {
    function get_provinsi_data()
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_provinsi')->get();

        return $data;
    }
}

if (!function_exists('master_jenis_pemasaran_data')) {
    function master_jenis_pemasaran_data()
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_jenis_pemasaran')->get();

        return $data;
    }
}

if (!function_exists('master_jenis_penjualan_data')) {
    function master_jenis_penjualan_data()
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_jenis_penjualan')->get();
        return $data;
    }
}

if (!function_exists('master_negara_data')) {
    function master_negara_data()
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_negara')->get();

        return $data;
    }
}

if (!function_exists('master_negara_id')) {
    function master_negara_id($negara_id)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_negara')->where('id_negara', $negara_id)->first();
        if (!empty($data)) {
            $result = $data->negara;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('surveyor_data')) {
    function surveyor_data()
    {
        // $db_2 = \DB::connection('pgsql2');
        $data = DB::table('surveyor')
            ->wherenull('id_perusahaan_surveyor')
            ->where('aktifasi', true)
            ->get();

        return $data;
    }
}

if (!function_exists('get_produk_id')) {
    function get_produk_id($id_produk)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_produk')->where('id_produk', $id_produk)->first();
        if (!empty($data)) {
            $result = $data->nama_produk;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('get_uom_id')) {
    function get_uom_id($id_uom)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_uom')->where('id_uom', $id_uom)->first();
        if (!empty($data)) {
            $result = $data->nama_uom;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('get_kualitas_id')) {
    function get_kualitas_id($id_kualitas)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_kualitas')->where('id_kualitas', $id_kualitas)->first();
        if (!empty($data)) {
            $result = $data->nama_kualitas;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('get_jenis_pemasaran_id')) {
    function get_jenis_pemasaran_id($jenis_pemasaran)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_jenis_pemasaran')->where('id_jenis_pemasaran', $jenis_pemasaran)->first();
        if (!empty($data)) {
            $result = $data->jenis_pemasaran;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('get_volume_pencampur_edit')) {
    function get_volume_pencampur_edit($id_pemasaran, $id_perusahaan_kerjasama)
    {
        $data = DB::table('pemasaran_detail_vol')
            ->where('id_pemasaran_bb', $id_pemasaran)
            ->where('id_master_pembeli', $id_perusahaan_kerjasama)
            ->first();
        if (!empty($data)) {
            $result = $data->volume;
        } else {
            $result = 0;
        }
        return $result;
    }
}

// SURVEYOR
if (!function_exists('get_total_petugas')) {
    function get_total_petugas($id_perusahaan)
    {
        $data = DB::table('surveyor')
            ->where('id_perusahaan_surveyor', $id_perusahaan)
            ->count();
        if (!empty($data)) {
            $result = $data;
        } else {
            $result = 0;
        }
        return $result;
    }
}

if (!function_exists('get_total_titik_muat_dashboard')) {
    function get_total_titik_muat_dashboard($id_surveyor)
    {
        $db_2 = \DB::connection('pgsql2');

        $data = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->leftjoin('rkab', 'rkab.id_perusahaan', 'pemasaran_bb.pelapor')
            ->where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)
            ->where('jenis_laporan', 'provisional')
            ->where('date', '>=', '2020-01-01 00:00:00')
            ->where('pemasaran_bb.deleted_at', '=', null)
            ->wherenull('status_surveyor')
            ->where(function ($q) {
                $lokasi1 = Auth::guard('surveyors')->user()->provinsi_satu;
                $lokasi2 = Auth::guard('surveyors')->user()->provinsi_dua;
                $q->where('lokasi_pelabuhan', $lokasi1)
                    ->orWhere('lokasi_pelabuhan', $lokasi2);
            })
            ->where(function ($q) {
                $tahun = date("Y");
                $q->where('rkab.tahun', $tahun)->where('rkab.status', '!=', '1')->where('rkab.approve', true)
                    ->orwhere('rkab.tahun', $tahun)->where('rkab.status', '3')->where('rkab.approve', null)
                    ->orwhere('rkab.tahun', $tahun)->where('rkab.status', '3')->where('rkab.approve', false);
            })
            ->orderby('date', 'desc')
            ->count();

        if (!empty($data)) {
            $result = $data;
        } else {
            $result = 0;
        }
        return $result;
    }
}

if (!function_exists('get_total_titik_serah_dashboard')) {
    function get_total_titik_serah_dashboard($id_surveyor)
    {
        $db_2 = \DB::connection('pgsql2');

        $data = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->leftjoin('rkab', 'rkab.id_perusahaan', 'pemasaran_bb.pelapor')
            ->where('id_surveyor', Auth::guard('surveyors')->user()->id_perusahaan_surveyor)
            ->where('jenis_laporan', 'provisional')
            ->where('date', '>=', '2020-01-01 00:00:00')
            ->where('pemasaran_bb.deleted_at', '=', null)
            ->where('status_surveyor', 1)
            ->where(function ($q) {
                $lokasi1 = Auth::guard('surveyors')->user()->provinsi_satu;
                $lokasi2 = Auth::guard('surveyors')->user()->provinsi_dua;
                $q->where('lokasi_pelabuhan_ts', $lokasi1)
                    ->orWhere('lokasi_pelabuhan_ts', $lokasi2);
            })
            ->where(function ($q) {
                $tahun = date("Y");
                $q->where('rkab.tahun', $tahun)->where('rkab.status', '!=', '1')->where('rkab.approve', true)
                    ->orwhere('rkab.tahun', $tahun)->where('rkab.status', '3')->where('rkab.approve', null)
                    ->orwhere('rkab.tahun', $tahun)->where('rkab.status', '3')->where('rkab.approve', false);
            })
            ->orderby('date', 'desc')
            ->count();

        if (!empty($data)) {
            $result = $data;
        } else {
            $result = 0;
        }
        return $result;
    }
}

if (!function_exists('get_total_titik_muat_dashboard_mn')) {
    function get_total_titik_muat_dashboard_mn($id_surveyor)
    {
        $db_2 = \DB::connection('pgsql2');

        $data = $db_2->table('pemasaran_mn')
            ->join('final_pemasaran_mn', 'pemasaran_mn.id_pemasaran_mn', 'final_pemasaran_mn.id_pemasaran_mn')
            ->where('id_surveyor', $id_surveyor)
            ->where('jenis_laporan', 'provisional')
            ->where('date', '>=', '2020-01-01 00:00:00')
            ->wherenull('pemasaran_mn.deleted_at')
            ->wherenull('status_surveyor')
            ->where(function ($q) {
                $lokasi1 = Auth::guard('surveyors')->user()->provinsi_satu;
                $lokasi2 = Auth::guard('surveyors')->user()->provinsi_dua;
                $q->where('lokasi_pelabuhan', $lokasi1)
                    ->orWhere('lokasi_pelabuhan', $lokasi2);
            })
            ->count();

        if (!empty($data)) {
            $result = $data;
        } else {
            $result = 0;
        }
        return $result;
    }
}

if (!function_exists('get_total_titik_serah_dashboard_mn')) {
    function get_total_titik_serah_dashboard_mn($id_surveyor)
    {
        $db_2 = \DB::connection('pgsql2');

        $data = $db_2->table('pemasaran_mn')
            ->join('final_pemasaran_mn', 'pemasaran_mn.id_pemasaran_mn', 'final_pemasaran_mn.id_pemasaran_mn')
            ->where('id_surveyor', $id_surveyor)
            ->where('jenis_laporan', 'provisional')
            ->where('date', '>=', '2020-01-01 00:00:00')
            ->wherenull('pemasaran_mn.deleted_at')
            ->where('status_surveyor', 1)
            ->where(function ($q) {
                $lokasi1 = Auth::guard('surveyors')->user()->provinsi_satu;
                $lokasi2 = Auth::guard('surveyors')->user()->provinsi_dua;
                $q->where('lokasi_pelabuhan_ts', $lokasi1)
                    ->orWhere('lokasi_pelabuhan_ts', $lokasi2);
            })
            ->count();

        if (!empty($data)) {
            $result = $data;
        } else {
            $result = 0;
        }
        return $result;
    }
}

if (!function_exists('cek_double_transaksi')) {
    function cek_double_transaksi($id_transaksi)
    {
        $db_2 = \DB::connection('pgsql2');
        $query = $db_2->table('pemasaran_bb')->where('id_transaksi', $id_transaksi)->get();
        $data = Count($query);

        if (!empty($data)) {
            $result = $data;
        } else {
            $result = 0;
        }
        return $result;
    }
}

if (!function_exists('cek_double_transaksi_mn')) {
    function cek_double_transaksi_mn($id_transaksi)
    {
        $db_2 = \DB::connection('pgsql2');
        $query = $db_2->table('pemasaran_mn')->where('id_transaksi', $id_transaksi)->get();
        $data = Count($query);

        if (!empty($data)) {
            $result = $data;
        } else {
            $result = 0;
        }
        return $result;
    }
}

if (!function_exists('get_nama_surveyor')) {
    function get_nama_surveyor($uuid)
    {
        $data = DB::table('surveyor')
            ->where('uuid', $uuid)
            ->first();
        if (!empty($data)) {
            $result = $data->name;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('cek_invent_perusahaan')) {
    function cek_invent_perusahaan($id_perusahaan)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('inventori_')->where('id_perusahaan', $id_perusahaan)
            ->where('id_perusahaan_kerjasama', $id_perusahaan)->sum('volume');
        if (!empty($data)) {
            $result = $data;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('get_perusahaan')) {
    function get_perusahaan($id_pemasaran)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('pemasaran_bb')->where('id_pemasaran_bb', $id_pemasaran)->first();

        if (!empty($data)) {
            $result = $data->pelapor;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('total_volume_deletd_at')) {
    function total_volume_deletd_at($id_pemasaran)
    {
        $db_2 = \DB::connection('pgsql2');
        $volum_tongkang = $db_2->table('pemasaran_bb_partial')
            ->Where('deleted_at', null)
            ->where('id_pemasaran_bb', $id_pemasaran)->sum('volume');

        if (!empty($volum_tongkang)) {
            $result = $volum_tongkang;
        } else {
            $result = 0;
        }
        return $result;
    }
}

if (!function_exists('mengurangi_invent_selisih')) {
    function mengurangi_invent_selisih($id_perusahaan, $pengurangan)
    {
        $db_2 = \DB::connection('pgsql2');
        $invent = $db_2->table('inventori_')->where('id_perusahaan', $id_perusahaan)
            ->where('id_perusahaan_kerjasama', $id_perusahaan)->sum('volume');
        $volums = $invent + $pengurangan;
        $dibalikin = $db_2->table('inventori_')->where('id_perusahaan', $id_perusahaan)
            ->where('id_perusahaan_kerjasama', $id_perusahaan)->update(['volume' => $volums]);

        if (!empty($dibalikin)) {
            $result = $dibalikin;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('get_jenis_izin')) {
    function get_jenis_izin($id_jenis)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_jenis_izin')->where('id_jenis_izin', $id_jenis)->first();
        if (!empty($data)) {
            $result = $data->jenis_izin;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('get_produk_data')) {
    function get_produk_data($id_perusahaan)
    {
        $data = DB::table('pembelian_mn')->select('id_produk', 'uom')
            ->where('id_pembeli', $id_perusahaan)->groupBy('id_produk', 'uom')->get();
        if (!empty($data)) {
            $result = $data;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('get_kualitas_kadar')) {
    function get_kualitas_kadar($id_produk)
    {
        $db_2 = \DB::connection('pgsql2');
        $data =  $db_2->table('master_produk_kualitas')->select('master_kualitas.id_kualitas', 'master_kualitas.nama_kualitas', 'master_kualitas.id_type', 'master_produk_kualitas.id_produk')
            ->join('master_kualitas', 'master_produk_kualitas.id_kualitas', 'master_kualitas.id_kualitas')
            ->where('master_produk_kualitas.id_produk', $id_produk)->get();
        if (!empty($data)) {
            $result = $data;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('get_alamat_surveyor')) {
    function get_alamat_surveyor($uuid)
    {
        $data = DB::table('profile_surveyor')
            ->where('id_surveyor', $uuid)
            ->first();
        if (!empty($data)) {
            $result = $data->alamat;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('get_final_bb_row')) {
    function get_final_bb_row($id_transaksi)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('pemasaran_bb')
            ->join('final_pemasaran_bb', 'pemasaran_bb.id_pemasaran_bb', 'final_pemasaran_bb.id_pemasaran_bb')
            ->join('master_jenis_penjualan', 'pemasaran_bb.jenis_penjualan', 'master_jenis_penjualan.id_jenis_penjualan')
            ->where('pemasaran_bb.id_transaksi', $id_transaksi)
            ->where('jenis_laporan', 'final')
            ->first();
        if (!empty($data)) {
            $result = $data->id_pemasaran_bb;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('update_invent')) {
    function update_invent($id_perusahaan, $id_kerjasama)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('inventori_')->where('id_perusahaan', $id_perusahaan)
            ->where('id_perusahaan_kerjasama', $id_kerjasama)->first();
        if (!empty($data)) {
            $result = $data->id_inventory;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('update_verif_cow')) {
    function update_verif_cow($id_pemasaran, $jenis_bayar, $no_cow)
    {
        $db_2 = \DB::connection('pgsql2');
        $updatedata = ['jenis_bayar' => $jenis_bayar, 'status_cow' => '1'];
        $update_di_final = ['no_cow' => $no_cow];
        $pemasaran = $db_2->table('pemasaran_bb')->where('id_pemasaran_bb', $id_pemasaran)->update($updatedata);

        $final = $db_2->table('final_pemasaran_bb')->where('id_pemasaran_bb', $id_pemasaran)->update($update_di_final);

        if ($pemasaran > 0 && $final > 0) {
            $result = 1;
        } else {
            $result = '-';
        }
        return $result;
    }
}

if (!function_exists('addToLog')) {
    function addToLog($subject, $menu = null)
    {

        if (Auth::guard('traders')->check()) {
            $id_user = Auth::guard('traders')->user()->id;
            $group = 'IUP OPK';
        } else if (Auth::guard('surveyors')->check()) {
            if (Auth::guard('surveyors')->user()->id_perusahaan_surveyor != '') {
                $id_user = Auth::guard('surveyors')->user()->id;
                $group = 'PETUGAS';
            } else {
                $id_user = Auth::guard('surveyors')->user()->id;
                $group = 'PERUSAHAAN SURVEYOR';
            }
        } else if (Auth::guard('adminstrator')->check()) {
            $id_user = Auth::guard('adminstrator')->user()->id;
            $group = 'ADMIN';
        } else {
            $id_user = null;
            $group = null;
        }

        $data =  [
            'user_id' => $id_user,
            'role' => $group,
            'subject' => $subject,
            'request_method' => Request::method(),
            'endpoint' => Request::fullUrl(),
            'ip' =>  Request::ip(),
            'menu' => $menu,
            'isp_district' => '',
            'agent' => Request::header('user-agent'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        try {
            LogActivity::insert($data);
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
}

if (!function_exists('is_export_moms')) {
    function is_export_moms($id_perusahaan)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('perusahaan')->where('id_perusahaan', $id_perusahaan)->first();
        if (!empty($data)) {
            $result = $data->is_export;
        } else {
            $result = 0;
        }
        return $result;
    }
}
if (!function_exists('is_last_late')) {
    function is_last_late($id_perusahaan)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('loginperusahaans')->where('id_perusahaan', $id_perusahaan)->first();
        $wiup = $data->wiup;
        $data = $db_2->table('master_jadwal_pln')
            ->where('wiup', $wiup)
            ->where('status_realisasi', 0)
            ->whereDate('tanggal', '<=', date('Y-m-d', strtotime('-1 days')))
            ->count();
        if ($data > 0) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}

if (!function_exists('is_pln_transaction')) {
    function is_pln_transaction($id_jadwal)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_jadwal_pln')->where('id_jadwal', $id_jadwal)->count();
        return $data;
    }
}

if (!function_exists('is_pln_trader')) {
    function is_pln_trader($id_jadwal)
    {
        $db_2 = \DB::connection('pgsql2');
        $data = $db_2->table('master_jadwal_pln')->where('id_jadwal', $id_jadwal)->first();
        if ($data) {
            $result = $data->id_trader;
        } else {
            $result = null;
        }
        return $result;
    }
}
