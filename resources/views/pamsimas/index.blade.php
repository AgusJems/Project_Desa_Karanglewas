@extends('layouts.master')

@section('title', 'pamsimas')
@section('appName', 'Website Desa')
@section('content')
<section class="section">
    {{-- tampilan admin --}}
    @if (Auth::user()->role == 'admin')
    <div class="section-header">
        <h1>Data Pamsimas</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Pamsimas</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Tabel Data Pamsimas Desa Karanglewas</h2>
        <p class="section-lead">Example of some Bootstrap table components.</p>

        <div class="row">
            <div class="col-xl-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Overview</h4>
                        <div class="card-header-action">
                            <a href="{{ route('pamsimas.create') }}" class="btn btn-icon icon-left btn-primary"><i
                                class="fas fa-plus"></i>&nbsp;Bayar</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="col-xl-12 col-md-6 col-lg-6" style="overflow-x: auto">
                            {{-- nampilna pesan sukses --}}
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                            @endif
                            <table class="table table-bordered" style="width:80rem">
                                <tbody>
                                    <tr>
                                        <th>No.</th>
                                        <th>Bulan</th>
                                        <th>Tanggal</th>
                                        <th>Harga</th>
                                        <th>Bukti Pembayaran</th>
                                        <th class="text-center">Status Pembayaran</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    {{-- nampilna data pamsimas --}}
                                    @forelse ($pamsimas as $item)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $item->bulan }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->harga }}</td>
                                        <td>
                                            <img class="mb-3" src="{{ asset('/images/'.$item->gambar) }}"
                                            width="100px" alt="{{ $item->gambar }}">
                                        </td>
                                        <td class="text-center">
                                            @if ($item->status == 'sudah')
                                            <div class="badge badge-pill badge-success mb-1">
                                                Sudah Bayar
                                            </div>
                                            @else
                                            <div class="badge badge-pill badge-danger mb-1">
                                                Belum Bayar
                                            </div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div onclick="bayar({{ $item->id }})" style="cursor:pointer" class="badge badge-pill badge-primary mb-1">
                                                ACC Pembayaran
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- nek data pamsimas kosong --}}
                                    @empty
                                    <div class="alert alert-danger">
                                        Data Pamsimas belum Tersedia.
                                    </div>
                                    @endforelse
                                <tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- tampilan user --}}
    @if (Auth::user()->role == 'user')
    <div class="section-header">
        <h1>Data Pamsimas</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Pamsimas</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Tabel Data Pamsimas Desa Karanglewas</h2>
        <p class="section-lead">Example of some Bootstrap table components.</p>

        <div class="row">
            <div class="col-xl-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Overview</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="col-xl-12 col-md-6 col-lg-6" style="overflow-x: auto">
                            {{-- nampilna pesan sukses --}}
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                            @endif
                            <table class="table table-bordered" style="width:80rem">
                                <tbody>
                                    <tr>
                                        <th>No.</th>
                                        <th>Bulan</th>
                                        <th>Tanggal</th>
                                        <th>Harga</th>
                                        <th>Status Pembayaran</th>
                                        <th>Pembayaran</th>
                                    </tr>
                                    {{-- nampilna data pamsimas --}}
                                    @forelse ($pamsimas as $item)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $item->bulan }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->harga }}</td>
                                        <td>
                                        @if ($item->status == 'sudah')
                                            <div class="badge badge-pill badge-success mb-1 float-right">
                                                Sudah Bayar
                                            </div>
                                            @else
                                            <div class="badge badge-pill badge-danger mb-1 float-right">
                                                Belum Bayar
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('pamsimas.upload', $item->id) }}" class="badge badge-pill badge-primary mb-1" style="cursor:pointer">
                                                Bayar
                                            </a>
                                        </td>
                                        @endif
                                    </tr>
                                    {{-- nek data pamsimas kosong --}}
                                    @empty
                                    <div class="alert alert-danger">
                                        Data Pamsimas belum Tersedia.
                                    </div>
                                    @endforelse
                                <tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
@endsection

@push('plugins_js')
<script src="node_modules/jquery-ui/dist/jquery-ui.min.js"></script>
@endpush

@push('page_js')
<script src="{{ asset('assets/js/page/components-table.js') }}"></script>
<script>
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
