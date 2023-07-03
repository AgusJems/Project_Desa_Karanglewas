<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Penjualan;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UmkmController extends Controller
{
    //nampilna tabel umkm sekang database
    public function index()
    {
        $umkms = Umkm::join('penduduks', 'umkms.user_id', '=', 'penduduks.user_id')
            ->select('umkms.*', 'penduduks.nik', 'penduduks.nama')
            ->latest()
            ->paginate(10);
        $penjualan = Umkm::join('penjualans', 'umkms.id', '=', 'penjualans.umkm_id')
            ->join('penduduks', 'umkms.user_id', '=', 'penduduks.user_id')
            ->select('penjualans.*', 'penduduks.nik', 'penduduks.nama', 'umkms.harga')
            ->latest()
            ->paginate(10);
        return view('umkm.index', compact('umkms', 'penjualan'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // nampilna form tambah data umkm
    public function create()
    {

        $penduduk = Penduduk::latest()->get();
        return view('umkm.create', compact('penduduk'));
    }

    public function create2()
    {
        $produk = Umkm::where('user_id', Auth::user()->id)->get();
        return view('umkm.create-penjualan', compact('produk'));
    }

    // input data umkm
    public function store(Request $request)
    {
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $productImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $productImage);
            $request->image = "$productImage";
        }

        $umkm = new Umkm();
        $umkm->user_id = Auth::user()->id;
        $umkm->lokasi = $request->lokasi;
        $umkm->kategori = $request->kategori;
        $umkm->produk = $request->produk;
        $umkm->telpon = $request->telpon;
        $umkm->gambar = $request->image;
        $umkm->harga = $request->harga;
        $umkm->satuan = $request->satuan;

        if ($umkm->save()) {
            return redirect()->route('umkm.index')->with('success', 'Data UMKM Berhasil Disimpan');
        }
    }

    // nampilna form edit data umkm sing dipilih
    public function edit($id)
    {
        $data = Umkm::join('penduduks', 'umkms.user_id', '=', 'penduduks.user_id')
            ->select('umkms.*', 'penduduks.nik', 'penduduks.nama')
            ->first();

        return view('umkm.edit', compact('data'));
    }

    // nyimpen perubahan data umkm sing dipilih
    public function update(Request $request, $id)
    {
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $productImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $productImage);
            $request->image = "$productImage";
        }

        $data = Umkm::whereId($id)->update([
            'lokasi' => $request->lokasi,
            'produk' => $request->produk,
            'telpon' => $request->telpon,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'gambar' => $request->image,
        ]);
        return redirect()->route('umkm.index')->with('success', 'Data UMKM Berhasil Diubah');
    }

    // hapus data umkm sing dipilih
    public function delete($id)
    {
        $data = Umkm::whereId($id);
        $data->delete();

        if ($data) {
            //redirect dengan pesan sukses
            return redirect()->route('umkm.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('umkm.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

    public function regis(Request $request)
    {

        $data = Penduduk::where('nik', $request->nik)->first();

        $data->regis = 'belum';

        if (!$data->save()) {
            return redirect()->route('umkm.index')->with(['error' => 'Registrasi Gagal!']);
        }
        return redirect()->route('umkm.index')->with(['success' => 'Registrasi berhasil!']);
    }

    public function getProduk($id)
    {
        // nggo ngambil detail produk sesuai produk sing dipilih
        $produk = Umkm::findOrFail($id);
        // dd($data);
        // mbalekna data dalam bentuk json, karena di request kang ajax
        return response()->json($produk, 200);
    }

    public function penjualan(Request $request)
    {

        $data = new Penjualan();
        $data->user_id = Auth::user()->id;
        $data->umkm_id = $request->produk;
        $data->jumlah = $request->qty;
        $data->total = $request->total;
        $data->save();

        return redirect()->route('umkm.index')->with(['success' => 'Data penjuan berhasil dimasukkan.']);
    }
}
