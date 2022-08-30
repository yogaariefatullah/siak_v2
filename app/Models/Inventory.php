<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{

    public $table = 'inventori_trader';
    //public $primaryKey = 'id';
	   protected $fillable = ['id','id_trader','id_perusahaan_kerjasama','volume'];
}
