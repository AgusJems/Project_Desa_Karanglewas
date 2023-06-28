<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\User;
use App\Models\Vaksin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    // nampilna tampilan tabel penduduk nggo admin
    public function index()
    {
        // ngambil seluruh data sekang database
        $penduduk = Penduduk::latest()->paginate(10);
        return view('penduduk.index', compact('penduduk'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    // nampilna tampilan form input penduduk
    public function create()
    {
        return view('penduduk.create');
    }

    // simpan data penduduk
    public function store(Request $request)
    {
        // validasi data nik
        $request->validate([
            'nik' => 'required|min:16|unique:penduduks|numeric',
        ]);
        // buat user baru untuk penduduk
        $user = new User();
        $user->name = $request->nama;
        $user->username = $request->nik;
        $user->password = Hash::make('123456');
        // $user->password = bcrypt('123456');
        $user->role = 'user';

        // nek user di simpan maka buat data penduduk baru, sesuai sing di input ng form input penduduk
        if ($user->save()) {
            $data = new Penduduk();
            $data->nik = $request->nik;
            $data->nama = $request->nama;
            $data->user_id = $user->id;
            $data->alamat = $request->alamat;
            $data->tptLahir = $request->tempatLahir;
            $data->tglLahir = $request->tanggalLahir;
            $data->kelamin = $request->jenisKelamin;
            $data->kawin = $request->kawin;
            $data->agama = $request->agama;
            $data->pendidikan = $request->pendidikan;
            $data->akta = $request->akta;
            $data->pam = $request->pam;
            // $data->save();

            // jika data penduduk disimpan otomatis generate data vaksin nggo penduduk
            if ($data->save()) {
                $vaksin = new Vaksin();
                $vaksin->user_id = $user->id;
                $vaksin->save();
            }
        }

        return redirect()->route('penduduk.index')->with('success', 'Data Penduduk Berhasil Disimpan');
        // dd($request->all());
    }

    // nampilna tanpilan form edit sesuai data sing dipilih
    public function edit($id)
    {
        $data = Penduduk::find($id);
        // dd($data);
        return view('penduduk.edit', compact('data'));
    }

    // meng update data penduduk
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|min:16|unique:penduduks|numeric'
        ]);
        $user = User::whereId($id)->update([
            'username' => $request->nik,
        ]);

        $data = Penduduk::where('user_id', $id)->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'pendidikan' => $request->pendidikan,
            'pam' => $request->pam,
        ]);
        // dd($data);
        return redirect()->route('penduduk.index')->with('success', 'Data Penduduk Berhasil Diubah');
    }

    public function update2(Request $request, $id)
    {
        // $request->validate([
        //     'nik' => 'required|min:16|unique:penduduks|numeric'
        // ]);
        $user = User::whereId($id)->update([
            'username' => $request->nik,
        ]);

        $data = Penduduk::where('user_id', $id)->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tptLahir' => $request->tempatLahir,
            'tglLahir' => $request->tanggalLahir,
            'kelamin' => $request->jenisKelamin,
            'kawin' => $request->kawin,
            'agama' => $request->agama,
            'pendidikan' => $request->pendidikan,
            'akta' => $request->akta,
            'pam' => $request->pam,
        ]);
        // dd($data);
        return redirect()->route('user.index');
    }

    // hapus data penduduk
    public function delete($id)
    {
        // dd($id);
        $data = Penduduk::whereId($id);
        $user = User::whereId($data->user_id);
        $data->delete();
        $user->delete();

        if ($data && $user) {
            //redirect dengan pesan sukses
            return redirect()->route('penduduk.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('penduduk.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
