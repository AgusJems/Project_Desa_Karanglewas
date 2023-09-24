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

@section('title', 'pamsimas')
@section('appName', 'Website Desa')
@section('content')
    <section class="section">
        {{-- tampilan user --}}
        @if (Auth::user()->role == 'admin')
            <div class="section-header">
                <h1>Pembayaran Pamsimas</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Pamsimas</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Input Data Pembayaran</h2>
                <p class="section-lead">Silahkan isi form pembayaran pamsimas sesuai dengan penggunaan anda.</p>

                <div class="row">
                    <div class="col-xl-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('pamsimas.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        {{-- <input type="text" id="nik" name="nik" class="form-control"> --}}
                                        <select id="nik" name="nik" class="form-control" required
                                            onchange="getData(this)">
                                            <option disabled selected>--Pilih NIK--</option>
                                            @foreach ($penduduk as $item)
                                                <option value="{{ $item->user_id }}">{{ $item->nik }}
                                                    ({{ $item->nama }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nik">Input Pemakaian M<sup>3</sup></label>
                                        <input type="number" id="pemakaian" name="pemakaian" oninput="calcTotal(event)"
                                            value="0" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" id="nama" name="nama" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="bulan">Bulan</label>
                                        <input type="text" id="bulan" name="bulan" class="form-control" value="{{ Carbon\Carbon::now()->format('F') }}" readonly>
                                    </div>
                                    <div class="form-group">
                                    <label for="penyakit">Bulan</label>
                                    <select class="js-example-basic-single" multiple name="penyakit[]" id="penyakit">
                                        <option value="januari">Januari</option>
                                        <option value="februari">Februari</option>
                                        <option value="maret">Maret</option>
                                        <option value="april">April</option>
                                        <option value="mei">Mei</option>
                                        <option value="juni">Juni</option>
                                        <option value="juli">Juli</option>
                                        <option value="agustus">Agustus</option>
                                        <option value="september">September</option>
                                        <option value="oktober">Oktober</option>
                                        <option value="november">November</option>
                                        <option value="desember">Desember</option>
                                    </select>
                                </div>
                                    {{-- <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="text" id="tanggal" name="tanggal" class="form-control" readonly
                                            required>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" id="alamat" name="alamat" class="form-control" readonly>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="statuspembayaran">Status Pembayaran</label>
                                        <input type="text" style="color: red" id="statuspembayaran"
                                            name="statuspembayaran" class="form-control" readonly>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="text" id="harga" name="harga" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Total Bayar</label>
                                        <input type="text" id="harga" name="harga" class="form-control" readonly
                                            required>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary" type="submit">Bayar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection

@push('page_js')
    <script src="{{ asset('assets/js/page/components-table.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                }
            });
        }

        // nggo ngitung total harga
        function calcTotal(bct) {
            let pmk = bct.target.value;
            let total = parseInt(pmk) * 500;
            $('#harga').val(total);
        }

        // nggo rubah status pembayaran
        function bayar(id) {
            $.ajax({
                method: 'GET',
                url: '/pamsimas/paymentConfirmation/' + id,
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function() {
                    window.location.href = `{{ route('pamsimas.index') }}`;
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
