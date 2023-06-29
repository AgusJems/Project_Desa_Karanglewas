<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\Umkm;
use Illuminate\Http\Request;

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
        $vaksin = Penduduk::join('vaksins', 'penduduks.user_id', '=', 'vaksins.user_id')->where('vaksins.vaksin', '>', '0')->count();

        // nggo nampilna data vaksin kabeh penduduk sekang sing terbaru
        $dataVaksin = Penduduk::join('vaksins', 'vaksins.user_id', '=', 'penduduks.user_id')->select('vaksins.*', 'penduduks.nama')->latest()->get();
        // nggo nampilna data pemmbayaran pamsimas sekang penduduk sing terbaru
        $dataPamsimas = Penduduk::join('pams', 'penduduks.user_id', '=', 'pams.user_id')->select('pams.*', 'penduduks.nama')->latest()->get();
        // dd($dataPamsimas);
        $umkms = Umkm::join('penduduks', 'umkms.user_id', '=', 'penduduks.user_id')->select('umkms.*', 'penduduks.nik', 'penduduks.nama')->latest()->paginate(10);
        // nggo manggil file tampilan we, nggawa data sing ws di gawe ng nduwur
        return view('dashboard.index', compact('penduduk', 'laki', 'perempuan', 'vaksin', 'dataVaksin', 'dataPamsimas','umkms'))->with('i');
    }

    public function getData($user_id)
    {
        // nggo ngambil data penduduk sesuai nik sing dipilih
        $data = Penduduk::where('user_id', $user_id)->first();
        // mbalekna data dalam bentuk json, karena di request kang ajax
        return response()->json($data, 200);
    }
}
