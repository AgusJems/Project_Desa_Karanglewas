{{-- manggil file tampilan master ng folder layout --}}
@extends('layouts.master')

{{-- push plugin_css page ming tampilan layout master --}}
@push('plugins_css')
    <link href="css/style.css" rel="stylesheet" type="text/css" />
@endpush

{{-- send nama page --}}
@section('title', 'Struktur Organisasi Desa')
{{-- send nama aplikasi --}}
@section('appName', 'Website Desa')
{{-- send tampilan struktur --}}
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Struktur Organisasi Desa</h1>
        </div>

        <div class="section-body">
            <div class="col-lg-12 col-md-6 col-8 order-lg-1 min-vh-100 order-2 bg-white">
                <div class="text-center p-2 mt-5">
                    <img alt="image" src="../assets/img/struktur.png" alt="logo" width="900">
                </div>
                @if (Auth::user()->role == 'admin')
                    <br></br>
                    <div class="row">
                        <div class="col-xl-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="col-xl-12 col-md-6 col-lg-6" style="overflow-x: auto">
                                        <table class="table table-bordered" style="width:80rem">
                                            <tbody>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama</th>
                                                    <th>Tempat & Tanggal Lahir</th>
                                                    <th>Kelamin</th>
                                                    <th>Pendidikan</th>
                                                    <th>Jabatan</th>
                                                    <th>Mulai Bekerja</th>
                                                    <th>Alamat</th>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Dwi Noto Suhino</td>
                                                    <td>Banyumas, 04-11-1992</td>
                                                    <td>L</td>
                                                    <td>SLTA</td>
                                                    <td>Kepala Desa</td>
                                                    <td>11 Juli 2019</td>
                                                    <td>Karanglewas, RT 001/003</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Rokhim Imam S</td>
                                                    <td>Salatiga, 19-06-1968</td>
                                                    <td>L</td>
                                                    <td>SLTA</td>
                                                    <td>Sekertaris Desa</td>
                                                    <td>11 Juli 2011</td>
                                                    <td>Karanglewas, RT 002/002</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Teguh Pujiono</td>
                                                    <td>Banyumas, 03-090-1970</td>
                                                    <td>L</td>
                                                    <td>SLTA</td>
                                                    <td>Kadus I</td>
                                                    <td>29 Januari 2009</td>
                                                    <td>Karanglewas, RT 002/001</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Sobirin</td>
                                                    <td>Banyumas, 10-01-1970</td>
                                                    <td>L</td>
                                                    <td>SLTA</td>
                                                    <td>Kadus II</td>
                                                    <td>29 Januari 2009</td>
                                                    <td>Karanglewas, RT 001/002</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Hartini</td>
                                                    <td>Banyumas, 12-09-1971</td>
                                                    <td>P</td>
                                                    <td>SLTA</td>
                                                    <td>Kadus III</td>
                                                    <td>30 Juni 2011</td>
                                                    <td>Karanglewas, RT 001/003</td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Samdi Wasono</td>
                                                    <td>Banyumas, 25-12-1965</td>
                                                    <td>L</td>
                                                    <td>SLTA</td>
                                                    <td>Kasi Pemerintahan</td>
                                                    <td>30 Juni 2011</td>
                                                    <td>Karanglewas, RT 001/003</td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>Sumini</td>
                                                    <td>Banyumas, 03-05-1981</td>
                                                    <td>P</td>
                                                    <td>SLTA</td>
                                                    <td>Kasi Kesejahteraan</td>
                                                    <td>30 Juni 2011</td>
                                                    <td>Karanglewas, RT 006/001</td>
                                                </tr>
                                                <tr>
                                                    <td>8</td>
                                                    <td>Sugono</td>
                                                    <td>Cilacap, 23-09-1972</td>
                                                    <td>L</td>
                                                    <td>SLTA</td>
                                                    <td>Kasi Pelayanan</td>
                                                    <td>29 Januari 2009</td>
                                                    <td>Karanglewas, RT 001/002</td>
                                                </tr>
                                                <tr>
                                                    <td>9</td>
                                                    <td>Warsem</td>
                                                    <td>Banyumas, 04-06-1972</td>
                                                    <td>P</td>
                                                    <td>SLTP</td>
                                                    <td>Kaur Keuangan</td>
                                                    <td>30 Juni 2011</td>
                                                    <td>Karanglewas, RT 001/002</td>
                                                </tr>
                                                <tr>
                                                    <td>10</td>
                                                    <td>Nasirin</td>
                                                    <td>Banyumas, 01-05-1966</td>
                                                    <td>L</td>
                                                    <td>SLTP</td>
                                                    <td>Kaur Umum</td>
                                                    <td>29 Januari 2009</td>
                                                    <td>Karanglewas, RT 001/002</td>
                                                </tr>
                                                <tr>
                                                    <td>11</td>
                                                    <td>Endah Nurhayati .SE</td>
                                                    <td>Banyumas, 06-04-1988</td>
                                                    <td>P</td>
                                                    <td>S1</td>
                                                    <td>Kaur Perencanaan</td>
                                                    <td>1 januari 2018</td>
                                                    <td>Karanglewas, RT 006/002</td>
                                                </tr>

                                            <tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('page_js')
    <script src="{{ asset('assets/js/page/components-table.js') }}"></script>
@endpush
