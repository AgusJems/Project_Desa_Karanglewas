{{-- manggil file tampilan master ng folder layout --}}
@extends('layouts.master')

{{-- send nama page --}}
@section('title', 'Vaksin')
{{-- send nama aplikasi --}}
@section('appName', 'Website Desa')
{{-- send tampilan vaksin --}}
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Vaksin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Vaksin</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tabel Data Vaksin Desa Karanglewas</h2>
            <p class="section-lead">Example of some Bootstrap table components.</p>

            <div class="row">
                <div class="col-xl-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Overview</h4>
                            <div class="card-header-action">
                                <a href="{{ route('vaksin.create') }}" class="btn btn-icon icon-left btn-primary"><i
                                        class="fas fa-plus"></i>&nbsp;Tambah Vaksin</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="col-xl-12 col-md-6 col-lg-6" style="overflow-x: auto">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif
                                @if ($message = Session::get('failed'))
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif
                                <table class="table table-bordered" style="width:140rem">
                                    <tbody>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIK</th>
                                            <th>Name</th>
                                            <th>Alamat</th>
                                            <th>Tampat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>No, Handphone</th>
                                            <th>Riwayat Penyakit</th>
                                            <th class="text-center">Status Vaksin</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        <!-- Fungsi nggo nambah data penduduk -->
                                        @forelse ($vaksin as $value)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $value->nik }}</td>
                                                <td>{{ $value->nama }}</td>
                                                <td>{{ $value->alamat }}</td>
                                                <td>{{ $value->tptLahir }}</td>
                                                <td>{{ $value->tglLahir }}</td>
                                                <td>{{ $value->kelamin }}</td>
                                                <td>{{ $value->telpon }}</td>
                                                <td>{{ $value->children->first()->penyakit ? $value->children->first()->penyakit : '' }}</td>
                                                @if ($value->children->first()->dosis == 1)
                                                    <td class="text-center">
                                                        <div class="badge badge-pill badge-success mb-1 float-center">
                                                            Vaksin 1
                                                        </div>
                                                    </td>
                                                @elseif ($value->children->first()->dosis == 2)
                                                    <td class="text-center">
                                                        <div class="badge badge-pill badge-success mb-1 float-center">
                                                            Vaksin 2
                                                        </div>
                                                    </td class="text-center">
                                                @elseif ($value->children->first()->dosis == 3)
                                                    <td>
                                                        <div class="badge badge-pill badge-success mb-1 float-center">
                                                            Vaksin 3
                                                        </div>
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <div class="badge badge-pill badge-danger mb-1 float-center">
                                                            Belum Vaksin
                                                        </div>
                                                    </td>
                                                @endif
                                                <td class="text-center">
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                        action="{{ route('vaksin.destroy', $value->id) }}" method="POST">
                                                        <a href="{{ route('vaksin.edit', $value->id) }}"
                                                            class="btn btn-sm btn-primary mr-2"><i
                                                                class="fas fa-pencil-alt"></i></a>
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                                class="fas fa-trash"></i></button>
                                                        <a href="{{ route('vaksin.detail', $value->id) }}"
                                                            class="btn btn-sm btn-success ml-2"><i
                                                                class="fas fa-address-card"></i></a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Data Vaksin belum Tersedia.
                                            </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1"><i
                                                    class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1
                                                <span class="sr-only">(current)</span></a></li>
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
        </div>
    </section>
@endsection

@push('page_js')
    <script src="{{ asset('assets/js/page/components-table.js') }}"></script>
@endpush
