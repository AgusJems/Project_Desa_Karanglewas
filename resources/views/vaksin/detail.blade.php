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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

{{-- send nama page --}}
@section('title', 'Riwayat Vaksin')
{{-- send nama aplikasi --}}
@section('appName', 'Website Desa')
{{-- send tampilan form riwayat vaksin --}}
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Riwayat Vaksin</h1>
    </div>
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Informasi Vaksin</h4>
                <div class="card-header-action">
                    <a href="" class="btn btn-primary">View More <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            <div class="card-body" style="height:375px;overflow-y:scroll">
                <div class="list-unstyled list-unstyled-border">
                    <table class="table table-striped" style="width:80rem">
                        <tr>
                            <th>Nama</th>
                            <th>Dosis Vaksin</th>
                            <th>Riwayat Penyakit</th>
                            <th>Tanggal Vaksin</th>
                        </tr>
                        {{-- nampilna data vaksin --}}
                        <tr>
                            <td class="font-weight-600">Ewoks</td>
                            <td>
                                <div class="badge badge-danger">Belum</div>
                                <div class="badge badge-success">Sudah</div>
                            </td>
                            <td>Picinta Ep Ep</td>
                            <td>Picinta Ep Ep</td>
                        </tr>
                        {{-- nek data vaksin urung ana --}}
                        <tr class="text-danger">
                            Data Belum Tersedia
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('plugins_js')
<script src="node_modules/cleave.js/dist/cleave.min.js"></script>
<script src="node_modules/cleave.js/dist/addons/cleave-phone.us.js"></script>
<script src="node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
<script src="node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="node_modules/select2/dist/js/select2.full.min.js"></script>
<script src="node_modules/selectric/public/jquery.selectric.min.js"></script>
@endpush

@push('page_js')
<script src="{{ asset('assets/js/page/forms-advanced-forms.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Fungsi njiot data kang penduduk -->
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
                $('#tempatLahir').val(result['tptLahir']);
                $('#tanggalLahir').val(result['tglLahir']);
                $('#jenisKelamin').val(result['kelamin']);
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            theme: "classic"
        });
    });
</script>
@endpush
