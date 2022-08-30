<?php

namespace App\Models\data_moms;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class final_pemasaran_bb extends Model
{
    //use SoftDeletes;
    // use Notifiable;
    protected $connection = 'pgsql2';

    protected $primaryKey = 'id_final_bb';

    protected $table = 'final_pemasaran_bb';

    protected $guarded = [];

    //public $incrementing = false;

    //protected $dates = ['deleted_at'];
}
