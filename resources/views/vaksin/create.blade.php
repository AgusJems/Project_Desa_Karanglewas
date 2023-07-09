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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

{{-- send nama page --}}
@section('title', 'Input Vaksin')
{{-- send nama aplikasi --}}
@section('appName', 'Website Desa')
{{-- send tampilan form input vaksin --}}
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Form Tambah Vaksin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('vaksin.index') }}">Vaksin</a></div>
                <div class="breadcrumb-item">Form Tambah Vaksin</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-xl-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <!-- Fungsi peringatan error ketika data urung di isi -->
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

                            <!-- Fungsi nambah data vaksin -->
                            <form action="{{ route('vaksin.store') }}" method="post">
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
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" id="nama" name="nama" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" id="alamat" name="alamat" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="tempatLahir">Tempat Lahir</label>
                                    <input type="text" id="tempatLahir" name="tempatLahir" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="tanggalLahir">Tanggal Lahir</label>
                                    <input type="text" id="tanggalLahir" name="tanggalLahir" class="form-control"
                                        disabled>
                                </div>
                                <div class="form-group">
                                    <label for="jenisKelamin">Jenis Kelamin</label>
                                    <input type="text" id="jenisKelamin" name="jenisKelamin" class="form-control"
                                        disabled>
                                </div>
                                <div class="form-group">
                                    <label for="telepon">Nomor Handphone</label>
                                    <input type="text" id="telepon" name="telepon" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="penyakit">Riwayat Penyakit</label>
                                    <select class="js-example-basic-single" multiple name="penyakit[]" id="penyakit">
                                        <option value="Demam">Demam</option>
                                        <option value="Jantung">Jantung</option>
                                        <option value="Lupus">Lupus</option>
                                        <option value="Positif Covid-19">Positif Covid-19</option>
                                        <option value="Alergi Parah Setelah Dosis Pertama">Alergi Dosis Pertama</option>
                                        <option value="Pembekuan Darah">Pembekuan Darah</option>
                                        <option value="Darah Tinggi">Darah Tinggi</option>
                                        <option value="Kanker">Kanker</option>
                                        <option value="HIV">HIV</option>
                                        <option value="Ginjal Kronis">Ginjal Kronis</option>
                                        <option value="Tidak Ada">Tidak Ada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="vaksin">Dosis Vaksin</label>
                                    <select id="vaksin" name="vaksin" class="form-control" required>
                                        <option>--Pilih Status Vaksin--</option>
                                        <option value="0">Belum Vaksin</option>
                                        <option value="1">Vaksin 1</option>
                                        <option value="2">Vaksin 2</option>
                                        <option value="3">Vaksin 3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tanggalVaksin">Tanggal Vaksin</label>
                                    <input type="date" id="tanggalVaksin" name="tanggalVaksin" class="form-control"
                                        required>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Fungsi njiot data kang penduduk -->
    <script>
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
                    $('#tempatLahir').val(result['tptLahir']);
                    $('#tanggalLahir').val(result['tglLahir']);
                    $('#jenisKelamin').val(result['kelamin']);
                }
            });
        }
    </script>

    <script>
    $(document).ready(function(){
        $('.js-example-basic-single').select2({
            theme: "classic"
        });
    });
    </script>
@endpush
