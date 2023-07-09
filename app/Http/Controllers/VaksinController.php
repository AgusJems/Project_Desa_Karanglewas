<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Vaksin;
use App\Models\vaksinDetails;
use Illuminate\Http\Request;

class VaksinController extends Controller
{
    // nampilna tabel vaksin sekang database
    public function index()
    {
        $vaksin = Vaksin::join('penduduks', 'vaksins.user_id', '=', 'penduduks.user_id')
            ->select(
                'vaksins.*',
                'penduduks.nik',
                'penduduks.nama',
                'penduduks.alamat',
                'penduduks.tptLahir',
                'penduduks.tglLahir',
                'penduduks.kelamin'
            )
            ->with(['children' => function ($query) {
                $query->latest();
            }])
            ->latest()
            ->paginate(10);
        // $vaksin = Vaksin::with(['children' => function ($query) {
        //     $query->latest();
        // }])->get();
        // dd($vaksin->children->first());
        // $data = vaksinDetails::where('vaksin_id', $vaksin->id)
        // ->latest();

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
        // dd($request->all());
        $penyakit = implode(',', $request->penyakit);
        $vaksin = Vaksin::where('user_id', $request->nik)
            ->first();
        if ($vaksin) {
            $data = new vaksinDetails();
            $data->vaksin_id = $vaksin->id;
            $data->penyakit = $penyakit;
            $data->dosis = $request->vaksin;
            $data->tanggal = $request->tanggalVaksin;
            // dd($vaksin);
            $data->save();
            // return redirect()->route('vaksin.index')->with('failed', 'Data Vaksin Sudah Tersedia');
            return redirect()->route('vaksin.index')->with('success', 'Data Vaksin Berhasil Disimpan');
        } else {
            $data = new Vaksin();
            $data->user_id = $request->nik;
            $data->telpon = $request->telepon;
            $data->save();
            $vaksin = new vaksinDetails();
            $vaksin->vaksin_id = $data->id;
            $vaksin->penyakit = $penyakit;
            $vaksin->dosis = $request->vaksin;
            $vaksin->tanggal = $request->tanggalVaksin;
            // dd($vaksin);
            $vaksin->save();

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
        $vaksin = vaksinDetails::latest()->get();
        return view('vaksin.detail', compact('vaksin'));
    }
}
