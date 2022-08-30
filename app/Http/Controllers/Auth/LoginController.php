<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\LogActivity;

class LoginController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getLogin()
    {
        return view('template.front_login.login');
    }



    public function postLogin(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // Attempt to log the user in
        // Passwordnya pake bcrypt

        if (Auth::check()) { }
        $log = 'User ' . $request->email . ' Login Aplikasi';
        if (Auth::guard('traders')->attempt(['email' => $request->email, 'password' => $request->password, 'aktifasi' => true, 'jenis_komoditas' => '1b5f47a9-e6c9-46e2-b957-c113ef39c787'])) {
            addToLog($log, null);
            return redirect()->route('traders.dashboard.bb');
        } else if (Auth::guard('traders')->attempt(['email' => $request->email, 'password' => $request->password, 'aktifasi' => true, 'jenis_komoditas' => 'b40a547d-dc5e-4bc0-b062-738f34e73922'])) {
            addToLog($log, null);
            return redirect()->route('traders.dashboard.mn');
        } else if (Auth::guard('surveyors')->attempt(['email' => $request->email, 'password' => $request->password, 'aktifasi' => true, 'id_perusahaan_surveyor' => null])) {
            addToLog($log, null);
            return redirect()->route('surveyors.dashboard');
        } else if (Auth::guard('surveyors')->attempt(['email' => $request->email, 'password' => $request->password, 'aktifasi' => true, 'nama_pic' => null])) {
            addToLog($log, null);
            return redirect()->route('surveyors.dashboard.surveyors');
        } else if (Auth::guard('adminstrator')->attempt(['email' => $request->email, 'password' => $request->password, 'type' => 'BATUBARA'])) {
            addToLog($log, null);
            return redirect()->route('admin.index');
        } else if (Auth::guard('adminstrator')->attempt(['email' => $request->email, 'password' => $request->password, 'type' => 'MINERAL'])) {
            addToLog($log, null);
            return redirect()->route('admin.index');
        } else {
            $log = 'User ' . $request->email . 'Gagal Login Aplikasi';
            addToLog($log, null);
            return redirect()->intended('/login');
        }
    }

    public function logout(Request $request)
    {
        $log = 'User ' . $request->email . 'Logout Aplikasi';

        if (Auth::guard('traders')->check()) {
            Auth::guard('traders')->logout();
            $request->session()->flush();
        } elseif (Auth::guard('surveyors')->check()) {
            Auth::guard('surveyors')->logout();
            $request->session()->flush();
        } elseif (Auth::guard('surveyors_perusahaan')->check()) {
            Auth::guard('surveyors_perusahaan')->logout();
            $request->session()->flush();
        } elseif (Auth::guard('adminstrator')->check()) {
            Auth::guard('adminstrator')->logout();
            $request->session()->flush();
        }

        return redirect('/');
    }
}
