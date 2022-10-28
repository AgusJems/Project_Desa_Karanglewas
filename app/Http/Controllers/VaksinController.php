<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Vaksin;
use Illuminate\Http\Request;

class VaksinController extends Controller
{
    public function index()
    {
        $vaksin = Vaksin::join('penduduks', 'vaksins.user_id', '=', 'penduduks.user_id')
            ->select('vaksins.*', 'penduduks.nik', 'penduduks.nama', 'penduduks.alamat', 'penduduks.tptLahir', 'penduduks.tglLahir', 'penduduks.kelamin')
            ->latest()
            ->paginate(10);
        // dd($vaksin);
        // , compact('vaksin'))->with('i', (request()->input('page', 1) - 1) * 10
        return view('vaksin', compact('vaksin'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $penduduk = Penduduk::latest()->get();
        // dd($penduduk);
        return view('create-vaksin', compact('penduduk'));
    }

    public function getData($user_id)
    {
        $data = Penduduk::where('user_id', $user_id)->first();
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $data = new Vaksin();
        $data->user_id = $request->nik;
        $data->telpon = $request->telepon;
        $data->penyakit = $request->penyakit;
        $data->vaksin = $request->vaksin;
        // dd($data);
        $data->save();

        return redirect()->route('vaksin.index')->with('success', 'Data Vaksin Berhasil Disimpan');
    }
}