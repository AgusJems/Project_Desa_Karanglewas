{{-- manggil file tampilan master ng folder layout --}}
@extends('layouts.master')

{{-- send nama page --}}
@section('title', 'Profile Desa')
{{-- send nama aplikasi --}}
@section('appName', 'Website Desa')
{{-- send tampilan profile --}}
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profil Desa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Profil Desa</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Pemerintah Desa Karanglewas</h2>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-12">
                    <article class="article article-style-c">
                        <div class="article-header">
                            <div class="article-image" data-background="../assets/img/krlws.png">
                            </div>
                        </div>
                        <div class="article-details">
                            <h6>Tentang Desa Karang Lewas</h6>
                            <p>Karanglewas adalah sebuah kecamatan di Kabupaten Banyumas, Provinsi Jawa Tengah, Indonesia.
                                Kecamatan ini berbatasan langsung dengan eks-kotif Purwokerto. Selain itu saat ini
                                Karanglewas merupakan salah satu kecamatan yang masuk dalam lingkungan perkotaan berdasarkan
                                RDTR sampai dengan Tahun 2034.</p>
                            <p>Kabupaten: Banyumas</p>
                            <p>Kode Pos: 53161</p>
                            <p>Provinsi: jawa Tengah</p>
                            <p>Desa/kelurahan: 13</p>
                            <p>Kode Kemedagri: 33.02.18</p>
                            <p>Luas: 32,48 km²</p>
                        </div>
                </div>
                </article>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('page_js')
    <script src="{{ asset('assets/js/page/components-table.js') }}"></script>
@endpush
