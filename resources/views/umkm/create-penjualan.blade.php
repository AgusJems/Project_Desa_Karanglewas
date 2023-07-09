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
@endpush

{{-- send nama page --}}
@section('title', 'Input Penjualan')
{{-- send nama aplikasi --}}
@section('appName', 'Web Desa')
{{-- send tampilan form input umkm --}}
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Form Tambah Penjualan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('umkm.index') }}">UMKM</a></div>
                <div class="breadcrumb-item">Form Tambah UMKM</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-xl-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
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
                            <form action="{{ route('umkm.transaction') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="produk">Produk</label>
                                    <select type="text" id="produk" name="produk" class="form-control" required
                                        onchange="getData(this)">
                                        <option disabled selected>--Pilih Produk--</option>
                                        @foreach ($produk as $item)
                                            <option value="{{ $item->id }}">{{ $item->produk }} - {{$item->nama}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="nama">Nama Produsen</label>
                                    <input type="text" id="nama" name="nama" class="form-control" value="{{Auth::user()->penduduk->nama}}" disabled>
                                </div> --}}
                                <div class="form-group">
                                    <label for="qty">Qty</label>
                                    <input type="number" id="qty" name="qty" min="1" class="form-control" oninput="calcTotal(event)" required>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" id="harga" name="harga" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="total">Total Penjualan</label>
                                    <input type="text" id="total" name="total" class="form-control" readonly>
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

@push('page_js')
    <script src="{{ asset('assets/js/page/forms-advanced-forms.js') }}"></script>
    <script>

        function calcTotal(bct) {
            let qty = bct.target.value;
            let harga = $('#harga').val();
            let total = parseInt(qty) * parseInt(harga);
            $('#total').val(total);
        }

        // fungsi njukut data produk sekang database penduduk
        function getData(produk) {
            let produk_id = produk.value;
            $.ajax({
                method: 'GET',
                url: '/umkm/getProduk/' + produk_id,
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(result) {
                    // alert(result); //for testing
                    $('#nama').val(result['nama']);
                    $('#harga').val(result['harga']);
                }
            });
        }
    </script>
@endpush
