<?php

namespace App\Http\Controllers;

use App\Models\Pam;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $pam->user_id = $request->nik;
        $pam->bulan = $request->bulan;
        $pam->harga = $request->total;
        $pam->status = 'belum';
        // nek data disimpan direct wa ke nomor admin
        if ($pam->save()) {
            return redirect()->route('pamsimas.index')->with('success', 'Pembayaran pamsimas atas nama, ' . $request->nama . ' berhasil di atur');
        }
    }

    // konfirmasi pembayaran ng admin
    public function confirm($id)
    {
        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->format('Y-m-d');
        $confirm = Pam::whereId($id)->update([
            'status' => 'sudah',
            'tanggal' => $formattedDateTime
        ]);
        $data = Pam::join('penduduks', 'pams.user_id', '=', 'penduduks.user_id')->select('pams.*', 'penduduks.nama', 'penduduks.telpon')->where('pams.id',$id)->latest()->first();

        return response()->json($data, 200);
        return redirect()->route('pamsimas.index')->with('success', 'Status Pembayaran Pamsimas Berhasil Diubah');
    }

    public function reject($id)
    {
        $reject = Pam::whereId($id)->update([
            'status' => 'tolak'
        ]);
        $data = Pam::join('penduduks', 'pams.user_id', '=', 'penduduks.user_id')->select('pams.*', 'penduduks.nama', 'penduduks.telpon')->where('pams.id',$id)->latest()->first();

        return response()->json($data, 200);
        // return redirect()->route('pamsimas.index')->with('success', 'Status Pembayaran Pamsimas Berhasil Diubah');
    }

    public function notification($id)
    {
        $data = Pam::join('penduduks', 'pams.user_id', '=', 'penduduks.user_id')->select('pams.*', 'penduduks.nama', 'penduduks.telpon')->where('pams.id',$id)->latest()->first();

        return response()->json($data, 200);
    }

    public function create()
    {
        $penduduk = Penduduk::latest()->get();

        return view('pamsimas.create', compact('penduduk'));
    }

    public function upload($id)
    {
        return view('pamsimas.upload', compact('id'));
    }

    public function upProcess(Request $request)
    {
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $productImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $productImage);
            $request->image = "$productImage";

            $bayar = Pam::whereId($request->id)->update(['gambar' => $request->image]);
            return redirect()->route('pamsimas.index')->with('success', 'Bukti Pembayaran Berhasil Di Upload');
        } else {
            return redirect()->route('pamsimas.index')->with('success', 'Bukti Pembayaran Gagal Di Upload');
        }
    }

    public function payment($id)
    {
        $pay = Pam::find($id);
        $data = Penduduk::where('id', $pay->user_id)->first();

        return redirect('https://wa.me/6281225614582?text=Halo%20Admin,%20saya%20ingin%20melakukan%20pembayaran%20pamsimas%20pada%20bulan%20' . $pay->bulan);
        // return redirect('https://api.whatsapp.com/send?phone=6281225614582&text=Halo%20Admin,%20saya%20ingin%20melakukan%20pembayaran%20pamsimas%20pada%20bulan%20' . $pay->bulan);
    }
}
