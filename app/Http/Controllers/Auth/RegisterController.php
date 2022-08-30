<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Traits\Guzzle;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use App\Models\Trader;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;
    use Guzzle;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama_pic' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'modi_id' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        try {
            $arr = $this->dataModi($data['modi_id']);
            // dd($arr, $data);
            $result =  DB::table('treader')->create([
                'pic' => $data['nama_pic'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),

            ]);
            return redirect()->route('login');
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function register(Request $request)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_PORT => "8020",
                CURLOPT_URL => "http://103.87.161.193:8020/v1/perizinan_opk?modi_id=" . $request->modi_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache", //,
                    //"postman-token: 85a68047-bca2-37af-044e-93fe075c4d72"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            $jsonDecode = json_decode($response, true);
            $ws = $jsonDecode["data"][0]["data_perizinan"];
            for ($i = 0; $i < count($ws); $i++) {
                if ($ws[$i]['modi_id'] == $request->modi_id) {
                    if ($ws[$i]["jenis_komoditas"] == "Batubara") {
                        $status = "1b5f47a9-e6c9-46e2-b957-c113ef39c787";
                        $jenis = 1;
                    } else {
                        $status = "b40a547d-dc5e-4bc0-b062-738f34e73922";
                        $jenis = 2;
                    }
                }
            }
            if ($request->hasFile('uploadpenugasan')) {
                $filename = 'SP-' . uniqid() . '.' . $request->file("uploadpenugasan")->getClientOriginalExtension();
                $destination = public_path() . '/suratpenugasan/';
                $request->file('uploadpenugasan')->move($destination, $filename);
            } else {
                $filename = null;
            }

            $arr['nama'] =  $jsonDecode["data"][0]["nama_perusahaan"];
            $arr['email'] = strtolower($request->email);
            $arr['password'] = Hash::make($request->password);
            $arr['created_at'] = date('Y-m-d H:i:s');
            $arr['id_perusahaan'] = Uuid::generate(4);
            $arr['jenis_komoditas'] = $status;
            $arr['status'] = 1;
            $arr['aktifasi'] = false;
            $arr['remember_token'] = $request->_token;
            $arr['notrader'] =  $request->modi_id;
            $arr['pic'] = strtoupper($request->nama_pic);
            $arr['surat_penugasan'] = $filename;
            $arr['jenis_trader'] = $jenis;
            $insert = Trader::insertGetId($arr);

            $email = $request->email;
            $message = '<h4>Yth,' . strtoupper($request->nama_pic) . '</h4>';
            $message .= '<p>Proses registrasi akun perusahaan Anda di sistem MVP telah <strong>TERKIRIM</strong></p>';
            $message .= '<p>Kami sedang melakukan verifikasi terhadap akun Anda dalam tenggat waktu maksimal 1x24 jam.</p>';
            $message .= '<p>Jika proses registrasi akun Anda disetujui, Anda akan menerima email notifikasi berikutnya.</p>';
            $message .= '<br />';
            $message .= '<p>Terima kasih,</p>';
            $message .= '<p>Admin MVP</p>';
            $message .= '<p>Direktorat Jenderal Mineral dan Batubara</p>';
            $message .= '<p>Kementerian ESDM</p>';

            $this->sendmailService($email, '[MVP Self-Service] Informasi Registrasi Akun', $message);

            Session::flash('success', 'Silahkan menunggu verifikasi dari Admin. Silahkan cek inbox / spam email anda secara berkala.');

            return redirect()->route('login');
        } catch (\Throwable $th) {
            Session::flash('error', 'Terjadi Kesalahan');

            return redirect()->back();
        }
    }
}
