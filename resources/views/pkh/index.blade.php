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
                                <table class="table table-bordered" style="width:140rem">
                                    <tbody>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Anak</th>
                                            <th>Kendaraan</th>
                                            <th>Pendapatan /Bulan</th>
                                            <th>Status PKH</th>
                                            <th>Jenis Bantuan</th>
                                            <th>Nominal Bantuan</th>
                                            <th>Tahap 1</th>
                                            <th>Tahap 2</th>
                                            <th>Tahap 3</th>
                                            <th>Tahap 4</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse ($pkh as $value)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $value->penduduk->nik }}</td>
                                                <td>{{ $value->penduduk->nama }}</td>
                                                <td>{{ $value->penduduk->alamat }}</td>
                                                <td>{{ $value->anak }}</td>
                                                <td>{{ $value->kendaraan }}</td>

                                                @if ($value->pendapatan === 'gol1')
                                                    <td>
                                                        < 1 Juta </td>
                                                        @elseif($value->pendapatan === 'gol2')
                                                    <td>
                                                        < 3 Juta </td>
                                                        @elseif($value->pendapatan === 'gol3')
                                                    <td>
                                                        < 5 Juta </td>
                                                        @elseif($value->pendapatan === 'gol4')
                                                    <td> > 5 Juta </td>
                                                @endif

                                                <td>
                                                    @if ($value->penerimaan == 'akan')
                                                        {{-- <div class="badge badge-pill badge-success mb-1"> --}}
                                                            Sudah Menerima
                                                        {{-- </div> --}}
                                                    @else
                                                        {{-- <div class="badge badge-pill badge-danger mb-1"> --}}
                                                            Belum Menerima
                                                        {{-- </div> --}}
                                                    @endif
                                                </td>

                                                <td>{{ $value->jenis }}</td>
                                                <td>{{ $value->nominal }}</td>
                                                @if (isset($value->tahap1))
                                                    <td>{{ $value->tahap1 }}</td>
                                                    @if ($value->tahap2)
                                                        <td>{{ $value->tahap2 }}</td>
                                                        @if ($value->tahap3)
                                                            <td>{{ $value->tahap3 }}</td>
                                                            @if ($value->tahap4)
                                                                <td>{{ $value->tahap4 }}</td>
                                                            @else
                                                                <td>
                                                                    <div onclick="terima({{ $value->id }})"
                                                                        class="badge badge-pill badge-success mb-1">
                                                                        Terima
                                                                    </div>
                                                                </td>
                                                            @endif
                                                        @else
                                                            <td>
                                                                <div onclick="terima({{ $value->id }})"
                                                                    class="badge badge-pill badge-success mb-1">
                                                                    Terima
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                        @endif
                                                    @else
                                                        <td>
                                                            <div onclick="terima({{ $value->id }})"
                                                                class="badge badge-pill badge-success mb-1">
                                                                Terima
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                @else
                                                    <td>
                                                        <div onclick="terima({{ $value->id }})"
                                                            class="badge badge-pill badge-success mb-1">
                                                            Terima
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                @endif
                                                <td>
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                        action="{{ route('pkh.destroy', $value->id) }}" method="POST">
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
    <script>
        function terima(id) {
            $.ajax({
                method: 'POST',
                url: '/pkh/ChangeStatus/' + id,
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function() {
                    window.location.href = `{{ route('pkh.index') }}`;
                }
            });
        }
    </script>
@endpush
