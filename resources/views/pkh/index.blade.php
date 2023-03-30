{{-- manggil file tampilan master ng folder layout --}}
@extends('layouts.master')

{{-- send nama page --}}
@section('title', 'Pkh')
{{-- send nama aplikasi --}}
@section('appName', 'Website Desa')
{{-- send tampilan pkh --}}
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data PKH</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">PKH</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tabel Data PKH Desa Karanglewas</h2>
            <p class="section-lead">Example of some Bootstrap table components.</p>
            <div class="row">
                <div class="col-xl-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Overview</h4>
                            <div class="card-header-action">
                                <a href="{{ route('pkh.create') }}" class="btn btn-icon icon-left btn-primary"><i
                                        class="fas fa-plus"></i>&nbsp;Tambah PKH</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="col-xl-12 col-md-6 col-lg-6" style="overflow-x: auto">
                                <!-- Kiye fungsi ketika data berhasil ditambah muncul notif berhasil/succes -->
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif
                                <!-- Fungsi nggo nambah data penduduk -->
                                <table class="table table-bordered" style="width:120rem">
                                    <tbody>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Anak</th>
                                            <th>Kendaraan</th>
                                            <th>Pendapatan /Bulan</th>
                                            <th>Penerimaan PKH</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse ($pkh as $value)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $value->nik }}</td>
                                                <td>{{ $value->nama }}</td>
                                                <td>{{ $value->alamat }}</td>
                                                <td>{{ $value->anak }}</td>
                                                <td>{{ $value->kendaraan }}</td>
                                                <td>{{ $value->pendapatan }}</td>
                                                <td>{{ $value->penerimaan }}</td>
                                                <td>
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                        action="{{ route('pkh.destroy', $value->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('pkh.edit', $value->id) }}"
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
                                                Data PKH belum Tersedia.
                                            </div>
                                        @endforelse
                                        {!! $pkh->links() !!}
                                    <tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('plugins_js')
    <script src="node_modules/jquery-ui-dist/jquery-ui.min.js"></script>
@endpush

@push('page_js')
    <script src="{{ asset('assets/js/page/components-table.js') }}"></script>
@endpush
