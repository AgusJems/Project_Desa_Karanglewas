<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    //nampilna tabel umkm sekang database
    public function index()
    {
        $umkms = Umkm::join('penduduks', 'umkms.user_id', '=', 'penduduks.user_id')
            ->select('umkms.*', 'penduduks.nik', 'penduduks.nama')
            ->latest()
            ->paginate(10);
        return view('umkm.index', compact('umkms'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // nampilna form tambah data umkm
    public function create()
    {

        $penduduk = Penduduk::latest()->get();
        return view('umkm.create', compact('penduduk'));
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
        $umkm->user_id = $request->nik;
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
}
