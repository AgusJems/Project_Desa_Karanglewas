{{-- manggil file tampilan master ng folder layout --}}
@extends('layouts.master')

{{-- push plugin_css page ming tampilan layout master --}}
@push('plugins_css')
    <link rel="stylesheet" href="node_modules/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="node_modules/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="node_modules/selectric/public/selectric.css">
    <link rel="stylesheet" href="node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
@endpush

{{-- send nama page --}}
@section('title', 'Input Produk')
{{-- send nama aplikasi --}}
@section('appName', 'Web Desa')
{{-- send tampilan form input umkm --}}
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Form Tambah Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('umkm.index') }}">UMKM</a></div>
                <div class="breadcrumb-item">Form Tambah UMKM</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-xl-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Peringatan!</strong> Data yang dimasukan tidak sesuai.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('umkm.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                {{-- <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <select type="text" id="nik" name="nik" class="form-control" required
                                        onchange="getData(this)">
                                        <option disabled selected>--Pilih NIK--</option>
                                        @foreach ($penduduk as $item)
                                            <option value="{{ $item->user_id }}">{{ $item->nik }} ({{ $item->nama }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" id="nama" name="nama" class="form-control" disabled>
                                </div> --}}
                                <div class="form-group">
                                    <label for="produk">Nama Produk</label>
                                    <input type="text" id="produk" name="produk" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" id="lokasi" name="lokasi" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select id="kategori" name="kategori" class="form-control" required>
                                        <option disabled selected>--Pilih Kategori--</option>
                                        <option value="Jadi">Jadi</option>
                                        <option value="Setengah Jadi">Setengah Jadi</option>
                                        <option value="Mentah">Mentah</option>
                                    </select>
                                    <div class="form-group">
                                        <label for="image">Upload Gambar</label>
                                        <input type="file" id="image" name="image" class="form-control" required
                                            accept=".png, .jpg, .jpeg">
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="telpon">Nomor telepon / WA</label>
                                    <input type="text" id="telpon" name="telpon" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" id="harga" name="harga" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="satuan">Satuan Penjualan</label>
                                    <select id="satuan" name="satuan" class="form-control" required>
                                        <option disabled selected>--Pilih Satuan Penjualan--</option>
                                        <option value="Pcs">Pcs</option>
                                        <option value="Kg">Kg</option>
                                        <option value="Meter">Meter</option>
                                        <option value="Bungkus">Bungkus</option>
                                        <option value="Lembar">Lembar</option>
                                    </select>
                                </div>
                                <div class="text-center pt-1 pb-1">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('plugins_js')
    <script src="node_modules/cleave.js/dist/cleave.min.js"></script>
    <script src="node_modules/cleave.js/dist/addons/cleave-phone.us.js"></script>
    <script src="node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="node_modules/select2/dist/js/select2.full.min.js"></script>
    <script src="node_modules/selectric/public/jquery.selectric.min.js"></script>
@endpush

@push('page_js')
    <script src="{{ asset('assets/js/page/forms-advanced-forms.js') }}"></script>

    <!-- Fungsi njiot data kang penduduk -->
    <script>
        function getData(nik) {
            let user_id = nik.value;
            // alert(user_id)
            $.ajax({
                method: 'GET',
                url: '/admin/getData/' + user_id,
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(result) {
                    // alert(result);
                    $('#nama').val(result['nama']);
                }
            });
        }
    </script>
@endpush
