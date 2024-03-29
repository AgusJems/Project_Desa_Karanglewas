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
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Overview</h4>
                        <div class="card-header-action">
                            <a href="{{ route('pamsimas.create') }}" class="btn btn-icon icon-left btn-primary"><i
                                class="fas fa-plus"></i>&nbsp;Buat Tagihan</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="col-xl-12 col-md-12 col-lg-12" style="overflow-x: auto">
                            {{-- nampilna pesan sukses --}}
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                            @endif
                            <table class="table table-bordered" style="width:100rem">
                                <tbody>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
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
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->bulan }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->harga }}</td>
                                        <td>
                                            <img class="mb-3 open-ShowBillDialog" src="{{ asset('/images/'.$item->gambar) }}"
                                            width="100px" alt="{{ $item->gambar }}" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{$item->gambar}}">
                                            {{-- <a data-toggle="modal" data-id="ISBN-001122" title="Add this item" class="open-AddBookDialog btn btn-primary" href="#addBookDialog">test</a> --}}
                                        </td>
                                        <td class="text-center">
                                            @if ($item->status == 'sudah')
                                            <div class="badge badge-pill badge-success mb-1">
                                                Sudah Bayar
                                            </div>
                                            @elseif($item->status == 'tolak')
                                            <div class="badge badge-pill badge-warning mb-1">
                                                Pembayaran Ditolak
                                            </div>
                                            @else
                                            <div class="badge badge-pill badge-danger mb-1">
                                                Belum Bayar
                                            </div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div onclick="bayar({{ $item->id }})" style="cursor:pointer" class="badge badge-pill badge-success mb-1 mr-1">
                                                ACC
                                            </div>
                                            <div onclick="reject({{ $item->id }})" style="cursor:pointer" class="badge badge-pill badge-danger mb-1">
                                                Tolak
                                            </div>
                                            <div onclick="sendNotif({{ $item->id }})" style="cursor:pointer" class="badge badge-pill badge-warning mb-1 ml-1">
                                                Kirim Notifikasi
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

            <div class="section-body">
                <h2 class="section-title">Rekap Pamsimas Desa Karanglewas</h2>
                <p class="section-lead">Example of some Bootstrap table components.</p>

                <div class="row">
                    <div class="col-xl-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Rekap Pamsimas</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="col-xl-12 col-md-6 col-lg-6" style="overflow-x: auto">
                                    <table class="table table-bordered" style="width:100rem">
                                        <tbody>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama</th>
                                                <th>Bulan</th>
                                                <th>Tanggal</th>
                                                <th>Harga</th>
                                                <th>Bukti Pembayaran</th>
                                            </tr>
                                            @forelse ($rekap as $item)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->bulan }}</td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>{{ $item->harga }}</td>
                                                <td>
                                                    <img class="mb-3 open-ShowBillDialog" src="{{ asset('/images/'.$item->gambar) }}"
                                                    width="100px" alt="{{ $item->gambar }}" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{$item->gambar}}">
                                                    {{-- <a data-toggle="modal" data-id="ISBN-001122" title="Add this item" class="open-AddBookDialog btn btn-primary" href="#addBookDialog">test</a> --}}
                                                </td>
                                                <td class="text-center">
                                                    @if ($item->status == 'sudah')
                                                    <div class="badge badge-pill badge-success mb-1">
                                                        Sudah Bayar
                                                    </div>
                                                    @elseif($item->status == 'tolak')
                                                    <div class="badge badge-pill badge-warning mb-1">
                                                        Pembayaran Ditolak
                                                    </div>
                                                    @else
                                                    <div class="badge badge-pill badge-danger mb-1">
                                                        Belum Bayar
                                                    </div>
                                                    @endif
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
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0">
                                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><i
                                                    class="fas fa-chevron-left"></i></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1 <span
                                                    class="sr-only">(current)</span></a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#"><i
                                                    class="fas fa-chevron-right"></i></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
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
                                    <table class="table table-bordered" style="width:100rem">
                                        <tbody>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama</th>
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
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->bulan }}</td>
                                                    <td>{{ $item->tanggal }}</td>
                                                    <td>{{ $item->harga }}</td>
                                                    <td class="text-center">
                                                        @if ($item->status == 'sudah')
                                                            <div class="badge badge-pill badge-success mb-1">
                                                                Sudah Bayar
                                                            </div>
                                                        @else
                                                            <div class="badge badge-pill badge-danger mb-1">
                                                                Belum Bayar
                                                            </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('pamsimas.upload', $item->id) }}"
                                                            class="badge badge-pill badge-primary mb-1"
                                                            style="cursor:pointer">
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
                                <li class="page-item active"><a class="page-link" href="#">1 <span
                                            class="sr-only">(current)</span></a></li>
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

@push('page_js')
    <script src="{{ asset('assets/js/page/components-table.js') }}"></script>
    <script>

        $(document).on("click", ".open-ShowBillDialog", function () {
            var billImage = $(this).data('id');

            // alert(billImage);
            var myImage = document.getElementById('billImage');

            var imageData = `{{ asset('/images/`+billImage+`') }}`;
            // alert(imageData);

            myImage.src = imageData;

            $('#myModal').modal('show')
        });

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

        function reject(id) {
            $.ajax({
                method: 'GET',
                url: 'pamsimas/paymentReject/' + id,
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    window.open('https://wa.me/62'+res['telpon']+'?text=Halo%20'+res['nama']+',%20tagihan%20anda%20untuk%20bulan%20'+res['bulan']+'%20ditolak.');
                    // window.location.href = `{{ route('pamsimas.index') }}`;
                }
            });
        }

        function sendNotif(id) {
            $.ajax({
                method: 'GET',
                url: 'pamsimas/sendNotif/' + id,
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    window.open('https://wa.me/62'+res['telpon']+'?text=Halo%20'+res['nama']+',%20tagihan%20anda%20untuk%20bulan%20'+res['bulan']+'%20dapat%20dibayarkan.');
                }
            });
        }
    </script>
@endpush
