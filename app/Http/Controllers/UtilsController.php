<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class UtilsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:surveyors');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cek_email(Request $request)
    {
        $cek = DB::table('treader')->where('email', $request->email)->count();
        return $cek;
    }

    public function cek_modi(Request $request)
    {
        try {
            $cek = DB::table('treader')->where('notrader', $request->modi_id)->count();
            if ($cek > 0) {
                return 1;
            } else {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_PORT => "8020",
                    CURLOPT_URL => "http://modi.minerba.esdm.go.id:8020/v1/perizinan_opk?modi_id=" . $request->modi_id,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache" //,
                    ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                $y = json_decode($response, true);
                if (!empty($y['data'])) {
                    $ws = $y['data'][0]['data_perizinan'];
                    for ($i = 0; $i < count($ws); $i++) {
                        if ($ws[$i]['jenis_operasi'] == 'angkut-jual') {
                            return 0;
                        }
                        return 2;
                    }
                } 
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
