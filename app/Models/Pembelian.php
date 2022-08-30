<?php

namespace App\Models;

use App\Models\Treader;
use Illuminate\Database\Eloquent\Model;
use DB;

class Pembelian extends Model
{

    public $table = 'pembelian';
    protected $fillable = ['id_pembelian', 'id_transaksi', 'id_penjual', 'created_at', 'deleted_at', 'updated_at', 'id_pemasaran', 'id_lokasi_provinsi', 'id_pembeli'];

    public static function dataPenambang()
    {

        return Pembelian::select('*', 'treader.nama as nama_treader')
            ->where('status_transaksi', '1')
            ->join('treader', 'treader.id_perusahaan', '=', 'pembelian.id_pembeli')
            ->get();
    }

    public static function dataTrader()
    {

        return Pembelian::where('status_transaksi', '2')->get();
    }


    public function treader()
    {
        return $this->belongsTo(Treader::class, 'id_penjual')->withDefault();
    }
}
