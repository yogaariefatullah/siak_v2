<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProfileSurveyor extends Model

{
    public $table = 'profile_surveyor';
    //public $primaryKey = 'id';
    protected $fillable = ['id_profile','name','file','alamat','create_at','deleted_at','updated_at','id_surveyor'];
}