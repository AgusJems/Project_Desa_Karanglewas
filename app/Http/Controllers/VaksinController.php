<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Vaksin;
use Illuminate\Http\Request;

class VaksinController extends Controller
{
    // nampilna tabel vaksin sekang database
    public function index()
    {
        $vaksin = Vaksin::join('penduduks', 'vaksins.user_id', '=', 'penduduks.user_id')
            ->select('vaksins.*', 'penduduks.nik', 'penduduks.nama', 'penduduks.alamat', 'penduduks.tptLahir', 'penduduks.tglLahir', 'penduduks.kelamin')
            ->latest()
            ->paginate(10);
        return view('vaksin.index', compact('vaksin'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    // nampilna form tamabah data vaksin
    public function create()
    {
        $penduduk = Penduduk::latest()->get();
        // dd($penduduk);
        return view('vaksin.create', compact('penduduk'));
    }

    // nyimpen data vaksin sing ws di input
    public function store(Request $request)
    {
        $vaksin = Vaksin::where('user_id', $request->nik)
        ->first();
        // dd($vaksin);
        if ($vaksin) {
            return redirect()->route('vaksin.index')->with('failed', 'Data Vaksin Sudah Tersedia');
        }else {
            $data = new Vaksin();
            $data->user_id = $request->nik;
            $data->telpon = $request->telepon;
            $data->penyakit = $request->penyakit;
            $data->vaksin = $request->vaksin;
            $data->save();

            return redirect()->route('vaksin.index')->with('success', 'Data Vaksin Berhasil Disimpan');
        }
    }

    // nampilna form edit data vaksin sing dipilih
    public function edit($id)
    {
        $data = Vaksin::join('penduduks', 'vaksins.user_id', '=', 'penduduks.user_id')
            ->select('vaksins.*', 'penduduks.nik', 'penduduks.nama', 'penduduks.alamat', 'penduduks.tptLahir', 'penduduks.tglLahir', 'penduduks.kelamin')
            ->where('vaksins.id', $id)
            ->first();
        return view('vaksin.edit', compact('data'));
    }

    // nyimpen data vaksin sing ws di ubah
    public function update(Request $request, $id)
    {
        $data = Vaksin::whereId($id)->update([
            'telpon' => $request->telepon,
            'penyakit' => $request->penyakit,
            'vaksin' => $request->vaksin,
        ]);
        return redirect()->route('vaksin.index')->with('success', 'Data Vaksin Berhasil Diubah');
    }

    // hapus data vaksin sing dipilih
    public function delete($id)
    {
        $data = Vaksin::whereId($id);
        $data->delete();

        if ($data) {
            //redirect dengan pesan sukses
            return redirect()->route('vaksin.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('vaksin.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

    public function detail()
    {
        return view('vaksin.detail');
    }
}
