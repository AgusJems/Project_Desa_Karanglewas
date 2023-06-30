@extends('layouts.master')

@section('title', 'pamsimas')
@section('appName', 'Website Desa')
@section('content')
    <section class="section">
        {{-- tampilan user --}}
        @if (Auth::user()->role == 'user')
            <div class="section-header">
                <h1>Pembayaran Pamsimas</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Pamsimas</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Input Bukti Pembayaran</h2>
                <p class="section-lead">Silahkan isi form pembayaran pamsimas sesuai dengan penggunaan anda.</p>

                <div class="row">
                    <div class="col-xl-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('pamsimas.upload') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="image">Upload Gambar</label>
                                        <input type="file" id="image" name="image" class="form-control" required
                                            accept=".png, .jpg, .jpeg">
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="float-right pt-1 pb-1">
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
