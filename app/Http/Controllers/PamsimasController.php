<?php

namespace App\Http\Controllers;

use App\Models\Pam;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PamsimasController extends Controller
{
    // nampilna tampilan tabel pamsimas
    public function index()
    {
        // ngambil data nggo admin
        $pamsimas = Pam::join('penduduks', 'pams.user_id', '=', 'penduduks.user_id')
            ->select('pams.*', 'penduduks.nik', 'penduduks.nama', 'penduduks.alamat')
            ->latest()
            ->paginate(10);
        // ngambil data nggo user
        $penduduk = Penduduk::where('user_id', Auth::user()->id)->first();

        // ngambil data nggo user
        $data = Pam::join('penduduks', 'pams.user_id', '=', 'penduduks.user_id')
            ->select('pams.*', 'penduduks.nik', 'penduduks.nama', 'penduduks.alamat')
            ->where('pams.user_id', Auth::user()->id)
            // ->whereNotNull('pams.bulan')
            ->latest()
            ->first();
        // dd($data);
        return view('pamsimas.index', compact('pamsimas', 'penduduk', 'data'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    // simpan data pembayaran sing dilakukan user/penduduk
    public function store(Request $request)
    {
        $pam = new Pam();
        $pam->user_id = $request->user_id;
        $pam->bulan = $request->bulan;
        $pam->tanggal = $request->tanggal;
        $pam->harga = $request->harga;
        $pam->status = $request->statuspembayaran;
        // dd($pam);
        // nek data disimpan direct wa ke nomor admin
        if ($pam->save()) {
            //ganti nomor telepon sesuai dengan nomor admiin
            return redirect('https://api.whatsapp.com/send?phone=(ganti nomor telepon disini, pakai format 62, hilangkan kurung)&text=Halo%20Admin,%20saya%20ingin%20melakukan%20pembayaran%20pamsimas%20pada%20bulan%20' . $request->bulan);
        }
    }

    // konfirmasi pembayaran ng admin
    public function confirm($id)
    {
        $confirm = Pam::findOrFail($id)->update([
            'status' => 'Sudah Bayar'
        ]);

        return redirect()->route('pamsimas.index')->with('success', 'Status Pembayaran Pamsimas Berhasil Diubah');
    }
}
