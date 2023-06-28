<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\User;
use App\Models\Vaksin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // fungsi nggo login
    public function index()
    {
        if ($user = Auth::user()) {
            // nek user ws login cek apakah role e admin?, nek admin di tampilna tampilan nggo admin
            if ($user->role == 'admin') {
                return redirect()->route('admin.index');
                // cek user login nek role e user ditampilna tampilan nggo user
            } elseif ($user->role == 'user') {
                return redirect()->route('user.index');
            }
        }
        return view('auth.login');
    }

    public function register() {
        return view('auth.register');
    }

    public function registerProcess(Request $request) {
        // validasi data nik
        $request->validate([
            'nik' => 'required|min:16|unique:penduduks|numeric',
            'password' => 'required|min:6',
        ]);
        //registrasi penduduk
        $user = new User();
        $user->name = $request->nama;
        $user->username = $request->nik;
        $user->password = Hash::make($request->password);
        $user->role = 'user';

        if($user->save())
        {
            $data = new Penduduk();
            $data->nik = $request->nik;
            $data->nama = $request->nama;
            $data->user_id = $user->id;

            if ($data->save()) {
                $vaksin = new Vaksin();
                $vaksin->user_id = $user->id;

                if ($vaksin->save()) {
                    return redirect()->route('login.index')->withInput()->withErrors(['register_success' => 'Registrasi Berhasil, silahkan login.']);
                }
            }
        }
        else
        {
            return redirect()->route('register.index')->withInput()->withErrors(['register_failed' => 'Registration Failed.']);
        }
    }

    // proses login
    public function process(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('admin.index');
            } elseif ($user->role == 'user') {
                return redirect()->route('user.index');
            }
            return redirect()->route('/');
        }
        return redirect('login')->withInput()->withErrors(['login_failed' => 'These credentials do not match our records.']);
    }

    // fungsi logout
    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return Redirect('login');
    }
}
