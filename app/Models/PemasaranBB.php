<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemasaranBB extends Model
{
    //
    public $table = 'pemasaran_bb';
    //public $primaryKey = 'id_pembelian';
    protected $fillable = ['id_pemasaran_bb','date','id_transaksi','jenis_penjualan','pelabuhan_asal','lokasi_pelabuhan',
                            'pelabuhan_tujuan','nama_kapal','kategori_pembeli','jenis_industri' ,'tujuan_pemasaran', 'pelapor',
                            'id_masterpembeli' ,'jenis_pemasaran', 'mata_uang', 'harga_jual','nilai_invoice' ,'total_volume'
                            ,'nama_jenis_penjualan' ,'provinsi_pelabuhan' ,'negara_tujuan' ,'nama_jenis_pemasaran' ,'nama_perusahaan' ,'nama_jenis_industri'];

    public static function detailTT($id_pemasaran)
    {
        return PemasaranBB::where('id_pemasaran_bb', $id_pemasaran)->get();
    }
}
