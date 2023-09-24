<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\Pkh;
use App\Models\Umkm;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // ngoo ngitung total jumlah penduduk
        $penduduk = Penduduk::count();
        // nggo ngitung jumlah penduduk lanang
        $laki = Penduduk::where('kelamin', 'laki-laki')->count();
        // nggo ngitung jumlah penduduk wadon
        $perempuan = Penduduk::where('kelamin', 'perempuan')->count();
        // nggo ngitung jumlah penduduk sing ws vaksin
        $vaksin = Penduduk::join('vaksins', 'penduduks.user_id', '=', 'vaksins.user_id')->count();

        // nggo nampilna data diri user/penduduk sing login
        $data = Penduduk::where('user_id', Auth::user()->id)->first();
        // nggo nampilna riwayat pembayaran pamsimas user/penduduk sing login
        $dataPamsimas = Penduduk::join('pams', 'penduduks.user_id', '=', 'pams.user_id')->select('pams.*', 'penduduks.nama')->where('pams.user_id', Auth::user()->id)->latest()->get();
        $umkms = Umkm::join('penduduks', 'umkms.user_id', '=', 'penduduks.user_id')->select('umkms.*', 'penduduks.nik', 'penduduks.nama')->latest()->paginate(10);
        $produk = Umkm::latest()->get();
        $pkh = Pkh::where('user_id', Auth::user()->id)->first();
        // nggo manggil file tampilan we, nggawa data sing ws di gawe ng nduwur
        // dd($data);
        return view('dashboard.index', compact('penduduk', 'laki', 'perempuan', 'vaksin', 'data', 'dataPamsimas', 'umkms', 'produk', 'pkh'))->with('i');
    }
}
