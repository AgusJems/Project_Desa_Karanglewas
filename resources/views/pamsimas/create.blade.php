@extends('layouts.master')

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
                                        <label for="nik">Input Pemakaian</label>
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

@push('plugins_js')
    <script src="node_modules/jquery-ui-dist/jquery-ui.min.js"></script>
@endpush

@push('page_js')
    <script src="{{ asset('assets/js/page/components-table.js') }}"></script>
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
@endpush
