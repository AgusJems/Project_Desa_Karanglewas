{{-- manggil file tampilan master ng folder layout --}}
@extends('layouts.master')

{{-- send nama page --}}
@section('title', 'Penduduk')
{{-- send nama aplikasi --}}
@section('appName', 'Website Desa')
{{-- send tampilan penduduk --}}
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Penduduk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Penduduk</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tabel Data Penduduk Desa Karanglewas</h2>
            <p class="section-lead">Example of some Bootstrap table components.</p>
            <div class="row">
                <div class="col-xl-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Overview</h4>
                            <div class="card-header-action">
                                <a href="{{ route('penduduk.create') }}" class="btn btn-icon icon-left btn-primary"><i
                                        class="fas fa-plus"></i>&nbsp;Tambah Penduduk</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="col-xl-12 col-md-12 col-lg-12" style="overflow-x: auto">
                                <!-- Kiye fungsi ketika data berhasil ditambah muncul notif berhasil/succes -->
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif
                                <!-- Fungi nggo nambah data penduduk -->
                                <table class="table table-bordered" style="width:120rem">
                                    <tbody>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIK</th>
                                            <th>Name</th>
                                            <th>Alamat</th>
                                            <th>No Telepon</th>
                                            <th>Tampat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Status Kawin</th>
                                            <th>Agama</th>
                                            <th>No. Akta</th>
                                            <th>Pamsimas</th>
                                            <th>Registrasi</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse ($penduduk as $value)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $value->nik }}</td>
                                                <td>{{ $value->nama }}</td>
                                                <td>{{ $value->alamat }}</td>
                                                <td>+62{{ $value->telpon }}</td>
                                                <td>{{ $value->tptLahir }}</td>
                                                <td>{{ $value->tglLahir }}</td>
                                                <td>{{ $value->kelamin }}</td>
                                                <td>{{ $value->kawin }}</td>
                                                <td>{{ $value->agama }}</td>
                                                <td>{{ $value->akta }}</td>
                                                <td>{{ $value->pam }}</td>
                                                <td>
                                                    @if ($value->regis == 'sudah')
                                                        <div class="badge badge-pill badge-success mb-1 float-right">
                                                            Sudah Registrasi
                                                        </div>
                                                    @elseif ($value->regis == 'belum')
                                                        <div onclick="verif({{ $value->id }})"
                                                            class="badge badge-pill badge-danger mb-1 float-right" style="cursor:pointer">
                                                            Belum Verifikasi
                                                        </div>
                                                    @else
                                                        <div class="badge badge-pill badge-warning mb-1 float-right">
                                                            Belum Registrasi
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                        action="{{ route('penduduk.destroy', $value->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('penduduk.edit', $value->id) }}"
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
                                                Data Penduduk belum Tersedia.
                                            </div>
                                        @endforelse
                                        {!! $penduduk->links() !!}
                                    <tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-header">
            <h1>Data Penduduk Luar Desa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Penduduk</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tabel Data Penduduk Luar Desa Karanglewas</h2>
            <p class="section-lead">Example of some Bootstrap table components.</p>
            <div class="row">
                <div class="col-xl-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="col-xl-12 col-md-12 col-lg-12" style="overflow-x: auto">
                                <!-- Kiye fungsi ketika data berhasil ditambah muncul notif berhasil/succes -->
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif
                                <!-- Fungi nggo nambah data penduduk -->
                                <table class="table table-bordered" style="width:120rem">
                                    <tbody>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIK</th>
                                            <th>Name</th>
                                            <th>Alamat</th>
                                            <th>Tampat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Status Kawin</th>
                                            <th>Agama</th>
                                            <th>No. Akta</th>
                                            <th>Pamsimas</th>
                                            <th>Registrasi</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse ($pendudukluar as $value)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $value->nik }}</td>
                                                <td>{{ $value->nama }}</td>
                                                <td>{{ $value->alamat }}</td>
                                                <td>{{ $value->tptLahir }}</td>
                                                <td>{{ $value->tglLahir }}</td>
                                                <td>{{ $value->kelamin }}</td>
                                                <td>{{ $value->kawin }}</td>
                                                <td>{{ $value->agama }}</td>
                                                <td>{{ $value->akta }}</td>
                                                <td>{{ $value->pam }}</td>
                                                <td>
                                                    @if ($value->regis == 'sudah')
                                                        <div class="badge badge-pill badge-success mb-1 float-right">
                                                            Sudah Registrasi
                                                        </div>
                                                    @elseif ($value->regis == 'belum')
                                                        <div onclick="verif({{ $value->id }})"
                                                            class="badge badge-pill badge-danger mb-1 float-right" style="cursor:pointer">
                                                            Belum Verifikasi
                                                        </div>
                                                    @else
                                                        <div class="badge badge-pill badge-warning mb-1 float-right">
                                                            Belum Registrasi
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                        action="{{ route('penduduk.destroy', $value->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('penduduk.edit', $value->id) }}"
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
                                                Data Penduduk belum Tersedia.
                                            </div>
                                        @endforelse
                                        {!! $penduduk->links() !!}
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

@push('page_js')
    <script src="{{ asset('assets/js/page/components-table.js') }}"></script>
    <script>
        // nggo rubah status registrasi
        function verif(id) {
            $.ajax({
                method: 'GET',
                url: '/penduduk/verification/' + id,
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function() {
                    window.location.href = `{{ route('penduduk.index') }}`;
                }
            });
        }
    </script>
@endpush
