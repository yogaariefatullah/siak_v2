<?php

namespace App\Models\data_moms;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class pemasaran_bb extends Model
{
    //use SoftDeletes;
    // use Notifiable;
    protected $connection = 'pgsql2';

    protected $primaryKey = 'id_pemasaran_bb';

    protected $table = 'pemasaran_bb';

    protected $guarded = [];


    public function final_pemasaran() {
        return $this->hasOne('App\Models\final_pemasaran_bb');
    }
    //public $incrementing = false;

    //protected $dates = ['deleted_at'];
}