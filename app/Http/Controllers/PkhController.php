<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Pkh;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PKHController extends Controller
{
    public function index()
    {
        // ngambil seluruh data sekang database
        $pkh = Pkh::latest()->paginate(10);
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
        $pkh = Pkh::where('user_id', $request->nik)->first();
        // dd($request->all());
        if ($pkh) {
            return redirect()->route('pkh.index')->with('failed', 'Data PKH Sudah Tersedia');
        } else {
            $data = new Pkh();
            $data->user_id = $request->nik;
            $data->anak = $request->anak;
            $data->kendaraan = $request->kendaraan;
            $data->pendapatan = $request->pendapatan;
            $data->status = $request->status;
            if ($request->status == 'akan') {
                $data->jenis = $request->jenis;
                if ($request->jenis == 'ibuhamil') {
                    $data->nominal = '750000';
                } elseif ($request->jenis == 'balita') {
                    $data->nominal = '750000';
                }elseif ($request->jenis == 'sd') {
                    $data->nominal = '225000';
                }elseif ($request->jenis == 'smp') {
                    $data->nominal = '375000';
                }elseif ($request->jenis == 'sma') {
                    $data->nominal = '500000';
                }elseif ($request->jenis == 'lansia') {
                    $data->nominal = '600000';
                }elseif ($request->jenis == 'disabilitas') {
                    $data->nominal = '600000';
                }else {
                    $data->nominal = null;
                }
            }
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

    // nyimpen data pkh sing ws di ubah
    public function update(Request $request, $id)
    {
        $data = Pkh::whereId($id)->update([
            'anak' => $request->anak,
            'kendaraan' => $request->kendaraan,
            'pendapatan' => $request->pendapatan,
            'status' => $request->status,
        ]);
        return redirect()->route('pkh.index')->with('success', 'Data PKH Berhasil Diubah');
    }

    public function ChangeStatus($id)
    {
        $data = Pkh::findOrFail($id);
        if (is_null($data->tahap1)) {
            $data->tahap1 = Carbon::now()->format('d-F-Y');
        }elseif (is_null($data->tahap2)) {
            $data->tahap2 = Carbon::now()->format('d-F-Y');
        }elseif (is_null($data->tahap3)) {
            $data->tahap3 = Carbon::now()->format('d-F-Y');
        }elseif (is_null($data->tahap4)) {
            $data->tahap4 = Carbon::now()->format('d-F-Y');
        }
        $data->save();

        return redirect()->route('pkh.index')->with('success', 'Tahap Bantuan PKH Berhasil Diubah');
    }
}
