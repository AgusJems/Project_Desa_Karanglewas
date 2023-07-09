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
@section('title', 'Form PKH')
{{-- send nama aplikasi --}}
@section('appName', 'Website Desa')
{{-- send tampilan form tambah PKH --}}
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Form Tambah PKH</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('pkh.index') }}">PKH</a></div>
                <div class="breadcrumb-item">Form Tambah PKH</div>
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
                            <form action="{{ route('pkh.store') }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <select id="nik" name="nik" class="form-control" required
                                        onchange="getData(this)">
                                        <option disabled selected>--Pilih NIK--</option>
                                        @foreach ($penduduk as $item)
                                            <option value="{{ $item->user_id }}">{{ $item->nik }} ({{ $item->nama }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Nek required kue ngadu di isi ora olih kosong -->
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" id="nama" name="nama" class="form-control" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" id="alamat" name="alamat" class="form-control" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="anak">Status Anak</label>
                                    <select id="anak" name="anak" class="form-control" required>
                                        <option disabled selected>--Pilih Status Anak--</option>
                                        <option value="sekolah">Sekolah</option>
                                        <option value="tidakSekolah">Tidak Sekolah</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kendaraan">Kendaraan</label>
                                    <select id="kendaraan" name="kendaraan" class="form-control" required>
                                        <option disabled selected>--Pilih Status Kendaraan--</option>
                                        <option value="Punya">Punya</option>
                                        <option value="Tidak Punya">Tidak Punya</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pendapatan">Pendapatan /bulan</label>
                                    <select id="pendapatan" name="pendapatan" class="form-control" required>
                                        <option disabled selected>--Pilih Pendapatan--</option>
                                        <option value="gol1">
                                            < 1 Juta </option>
                                        <option value="gol2">
                                            < 3 Juta </option>
                                        <option value="gol3">
                                            < 5 Juta </option>
                                        <option value="gol4"> > 5 Juta </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Penerimaan PKH</label>
                                    <select id="status" name="status" class="form-control" required>
                                        <option disabled selected>--Pilih Penerimaan--</option>
                                        <option value="akan"> Akan Menerima </option>
                                        <option value="tidak"> Tidak Menerima </option>
                                    </select>
                                </div>
                                {{-- <div id="frmTahap" class="form-group">
                                    <label for="tahap">Tahap Bantuan</label>
                                    <select id="tahap" name="tahap" class="form-control" required>
                                        <option disabled selected>--Pilih Tahap--</option>
                                        <option value="t1"> Tahap 1 </option>
                                        <option value="t2"> Tahap 2 </option>
                                        <option value="t3"> Tahap 3 </option>
                                        <option value="t4"> Tahap 4 </option>
                                    </select>
                                </div> --}}
                                <div id="frmJenis" class="form-group">
                                    <label for="jenis">Jenis Nominal Bantuan</label>
                                    <select id="jenis" name="jenis" class="form-control" required>
                                        <option disabled selected>--Pilih Jenis Nominal Bantuan--</option>
                                        <option value="ibuhamil"> IBU HAMIL </option>
                                        <option value="balita"> BALITA / ANAK USIA DINI </option>
                                        <option value="sd"> SISWA SD </option>
                                        <option value="smp"> SISWA SMP </option>
                                        <option value="sma"> SISWA SMA </option>
                                        <option value="lansia"> LANSIA </option>
                                        <option value="disabilitas"> PENYANDANG DISABILITAS </option>
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

    <script>
        $(document).ready(function() {
            $('#frmJenis').hide()
            // $('#frmTahap').hide()
            $('#status').on('change', function() {
                if ($(this).val() == 'akan') {
                    $('#frmJenis').show(100)
                    // $('#frmTahap').show(100)
                } else {
                    $('#frmJenis').hide(100)
                    // $('#frmTahap').hide(100)
                }
            })
        });

        function getData(nik) {
            let user_id = nik.value;
            $.ajax({
                method: 'GET',
                url: '/admin/getData/' + user_id,
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(result) {
                    console.log(result);
                    $('#nama').val(result['nama']);
                    $('#alamat').val(result['alamat']);
                }
            });
        }
    </script>
@endpush
