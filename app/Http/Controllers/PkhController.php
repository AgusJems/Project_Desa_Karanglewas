<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Pkh;

use Illuminate\Http\Request;

class PKHController extends Controller
{
    public function index()
    {
        // ngambil seluruh data sekang database
        $pkh = Penduduk::latest()->paginate(10);
        return view('pkh.index', compact('pkh'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $penduduk = Penduduk::latest()->get();
        return view('pkh.create', compact('penduduk'));
    }

    // nyimpen data pkh sing ws di input
    public function store(Request $request)
    {
        $pkh = Pkh::where('user_id', $request->nik)
        ->first();
        dd($request);
        if ($pkh) {
            return redirect()->route('pkh.index')->with('failed', 'Data PKH Sudah Tersedia');
        }else {
            $data = new Pkh();
            $data->user_id = $request->nik;
            $data->anak = $request->anak;
            $data->kendaraan = $request->kendaraan;
            $data->pendapatan = $request->pendapatan;
            $data->save();

            return redirect()->route('pkh.index')->with('success', 'Data PKH Berhasil Disimpan');
        }
    }

    public function edit($id)
    {
        $data = Pkh::join('penduduks', 'pkhs.user_id', '=', 'penduduks.user_id')
            ->select('pkhs.*', 'penduduks.nik', 'penduduks.nama', 'penduduks.alamat')
            ->where('pkhs.id', $id)
            ->first();
        return view('pkh.edit', compact('data'));
    }

    // nyimpen data vaksin sing ws di ubah
    public function update(Request $request, $id)
    {
        $data = Pkh::whereId($id)->update([
            'telpon' => $request->telepon,
            'penyakit' => $request->penyakit,
            'vaksin' => $request->vaksin,
        ]);
        return redirect()->route('vaksin.index')->with('success', 'Data Vaksin Berhasil Diubah');
    }

}
