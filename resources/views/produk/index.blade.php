{{-- manggil file tampilan master ng folder layout --}}
@extends('layouts.master')

{{-- send nama page --}}
@section('title', 'Produk')
{{-- send nama aplikasi --}}
@section('appName', 'Website Desa')
{{-- send tampilan produk --}}
@section('content')
<section class="section">
        <div class="section-header">
            <h1>Produk UMKM Desa Karanglewas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Usaha Mikro Kecil Dan Menengah (UMKM)</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Dukung UMKM Desa Karanglewas</h2>
            <p class="section-lead">Example of some Bootstrap table components.</p>

            <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <article class="article">
                            <div class="article-header">
                                <div class="article-image" data-background="/images">
                                </div>
                            </div>
                            <div class="article-details">
                                <p>Mendoan</p>
                                <p>RT 12/ RW 12</p>
                                <p>Rp. 1000</p>
                                <div class="article-cta">
                                    <a class="btn btn-primary"
                                        href="">Beli
                                        Sekarang</a>
                                </div>
                            </div>
                        </article>
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
