<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master_SK extends Model
{

    public $table = 'master_sk_induk';
    public $primaryKey = 'id';

	  protected $fillable = ['id_sk','no_sk','tanggal_sk','masa_berlaku','dokumen','userid','status_approve','status_aktif','status_penambahan','status_perpanjangan','no_sk_perpanjangan'];
}
