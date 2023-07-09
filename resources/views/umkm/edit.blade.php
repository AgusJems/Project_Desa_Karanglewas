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
@section('title', 'Edit Umkm')
{{-- send nama aplikasi --}}
@section('appName', 'Web Desa')
{{-- send tampilan form edit umkm --}}
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Form Edit UMKM</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('umkm.index') }}">UMKM</a></div>
                <div class="breadcrumb-item">Form Edit UMKM</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-xl-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('umkm.update', $data->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" id="nik" name="nik" value="{{ $data->nik }}"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" id="nama" name="nama" value="{{ $data->nama }}"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" id="lokasi" name="lokasi" value="{{ $data->lokasi }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <input type="text" id="kategori" name="kategori" value="{{ $data->kategori }}"
                                        class="form-control" readonly>
                                    <div class="form-group">
                                        <label for="image">Upload Gambar</label>
                                        <input type="file" id="image" name="image" value="{{ $data->gambar }}"
                                            class="form-control" required>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="produk">Nama Produk</label>
                                    <input type="produk" id="produk" name="produk" value="{{ $data->produk }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="harga" id="harga" name="harga" value="{{ $data->harga }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="satuan">Satuan Penjualan</label>
                                    <select id="satuan" name="satuan" class="form-control" required>
                                        <option value="{{ $data->satuan }}" selected disabled>{{ $data->satuan }}</option>
                                        <option value="pcs">Pcs</option>
                                        <option value="kg">Kg</option>
                                        <option value="meter">Meter</option>
                                        <option value="bungkus">Bungkus</option>
                                        <option value="lembar">Lembar</option>
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

@push('page_js')
    <script src="{{ asset('assets/js/page/forms-advanced-forms.js') }}"></script>
@endpush
