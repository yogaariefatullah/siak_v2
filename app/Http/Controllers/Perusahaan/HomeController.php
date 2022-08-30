<?php

namespace App\Http\Controllers\Perusahaan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:traders');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function master_negara_pemasaran(Request $request)
    {
        $db_2 = \DB::connection('pgsql2');

        if ($request->id == '6a79dcd6-1eb1-4a6c-95b9-b61480b2b934') {
            $data = $db_2->table('master_negara')->where('negara', '!=', 'INDONESIA')->get();
        } else {
            $data = $db_2->table('master_negara')->where('negara', 'INDONESIA')->get();
        }
        return $data;
    }
}
