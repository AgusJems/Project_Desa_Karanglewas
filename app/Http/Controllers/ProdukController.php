<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Umkm::latest()->get();
        return view('produk.index', compact('produk'));
    }

    public function buy($id){
        $data = Umkm::findOrFail($id);

        return redirect('https://wa.me/'.$data->telpon.'?text=Saya%20ingin%20membeli%20'.$data->produk);
    }
}
