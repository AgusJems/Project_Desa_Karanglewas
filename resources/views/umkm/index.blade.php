{{-- manggil file tampilan master ng folder layout --}}
@extends('layouts.master')

{{-- send nama page --}}
@section('title', 'Bahan Jadi')
{{-- send nama aplikasi --}}
@section('appName', 'Website Desa')
{{-- send tampilan umkm --}}
@section('content')
    <section class="section">
        {{-- tampilan nggo admin --}}
        @if (Auth::user()->role == 'admin')
            <div class="section-header">
                <h1>Usaha Mikro Kecil Dan Menengah (UMKM)</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">UMKM</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Produk UMKM Desa Karanglewas</h2>
                <p class="section-lead">Example of some Bootstrap table components.</p>

                <div class="row">
                    <div class="col-xl-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Overview</h4>
                                {{-- tambah produk nggo admin --}}
                                @if (Auth()->user()->role == 'admin')
                                    <div class="card-header-action">
                                        <a href="{{ route('umkm.create') }}" class="btn btn-icon icon-left btn-primary"><i
                                                class="fas fa-plus"></i>&nbsp;Tambah Produk</a>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body p-0">
                                <div class="col-xl-12 col-md-6 col-lg-6" style="overflow-x: auto">
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                    <table class="table table-bordered" style="width:100rem">
                                        <tbody>
                                            <tr>
                                                <th>No.</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Lokasi</th>
                                                <th>Kategori</th>
                                                <th>Gambar</th>
                                                <th>Nama Produk</th>
                                                <th>Harga</th>
                                                <th>Satuan Penjualan</th>
                                                <th>Action</th>
                                            </tr>
                                            @forelse ($umkms as $item)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $item->nik }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->lokasi }}</td>
                                                    <td>{{ $item->kategori }}</td>
                                                    <td>
                                                        <img class="mb-3" src="/images/{{ $item->gambar }}" width="100px"
                                                            alt="{{ $item->gambar }}">
                                                    </td>
                                                    <td>{{ $item->produk }}</td>
                                                    <td>{{ $item->harga }}</td>
                                                    <td>{{ $item->satuan }}</td>
                                                    <td>
                                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                            action="{{ route('umkm.destroy', $item->id) }}" method="POST">
                                                            <a href="{{ route('umkm.edit', $item->id) }}"
                                                                class="btn btn-sm btn-primary"><i
                                                                    class="fas fa-pencil-alt"></i></a>
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit" class="btn btn-sm btn-danger"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <div class="alert alert-danger">
                                                    Data UMKM belum Tersedia.
                                                </div>
                                            @endforelse
                                        <tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1"><i
                                                    class="fas fa-chevron-left"></i></a>
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
            </div>
        @endif
    </section>
@endsection

@push('plugins_js')
    <script src="node_modules/jquery-ui-dist/jquery-ui.min.js"></script>
@endpush

@push('page_js')
    <script src="{{ asset('assets/js/page/components-table.js') }}"></script>
@endpush
