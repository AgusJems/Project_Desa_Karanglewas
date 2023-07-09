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
@section('title', 'Edit Pkh')
{{-- send nama aplikasi --}}
@section('appName', 'Website Desa')
{{-- send tampilan form edit pkh --}}
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Form Tambah Pkh</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('pkh.index') }}">PKH</a></div>
                <div class="breadcrumb-item">Form Edit PKH</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-xl-12 col-md-6 col-lg-6">
                    <div class="card">
                        <!-- Fungsi kondisi error message/pringatan -->
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
                            <form action="{{ route('pkh.update', $data->user_id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" id="nik" name="nik" class="form-control"
                                        value="{{ $data->nik }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" id="nama" name="nama" class="form-control"
                                        value="{{ $data->nama }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" id="alamat" name="alamat" class="form-control"
                                        value="{{ $data->alamat }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="anak">Status Anak</label>
                                    <select id="anak" name="anak" class="form-control" required>
                                        <option selected disabled>--Pilih Status Anak-</option>
                                        <option value="Sekolah">Sekolah</option>
                                        <option value="Tidak Sekolah">Tidak Sekolah</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kendaraan">Kendaraan</label>
                                    <select id="kendaraan" name="kendaraan" class="form-control" required>
                                        <option selected disabled>--Pilih Status Kendaraan--</option>
                                        <option value="Punya">Punya</option>
                                        <option value="Tidak Punya">Tidak Punya</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pendapatan">Pendapatan / bulan</label>
                                    <select id="pendapatan" name="pendapatan" class="form-control" required>
                                        <option selected disabled>--Pilih Pendapatan--</option>
                                        <option value="gol1"> < 1 Juta </option>
                                        <option value="gol2"> < 3 Juta </option>
                                        <option value="gol3"> < 5 Juta </option>
                                        <option value="gol3"> > 5 Juta </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Penerima PKH</label>
                                    <select id="status" name="status" class="form-control" required>
                                        <option selected disabled>--Pilih Penerimaan--</option>
                                        <option value="akan"> Akan Menerima </option>
                                        <option value="tidak"> Belum Menerima </option>
                                    </select>
                                </div>
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
@endpush
