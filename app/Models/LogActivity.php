<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

class LogActivity extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $table = 'logs';

    protected $guarded = [];


}
