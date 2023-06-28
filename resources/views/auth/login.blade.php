{{-- manggil file tampilan master ng folder layout --}}
@extends('layouts/master')

{{-- push plugin_css page ming tampilan layout master --}}
@push('plugins_css')
    <link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">
@endpush

{{-- send nama page --}}
@section('title', 'Login')
{{-- send nama aplikasi --}}
@section('appName', 'Website Desa')
{{-- send tampilan login --}}
@section('content_2')
    <section class="section">
        <div class="d-flex flex-wrap align-items-stretch">
            <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                <div class="text-center p-2 mt-5">
                    <img src="../assets/img/Desa.png" alt="logo" width="180">
                </div>
                <div class="p-4 m-3">
                    <p class="text-muted">Sebelum memulai, Anda harus login atau mendaftar jika Anda belum memiliki akun.
                    </p>

                    <!-- Kiye fungsi nggo login -->
                    <form method="POST" action="{{ route('login.process') }}" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-group">
                            @error('login_failed')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <span class="alert-inner--text"><strong>Warning!</strong> {{ $message }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @enderror
                            @error('register_success')
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-inner--text"><strong>Success!</strong> {{ $message }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @enderror
                            <label for="username">Username/NIK</label>
                            <input id="username" type="text" class="form-control" name="username" tabindex="1"
                                required autofocus>
                            @if ($errors->has('username'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">Password</label>
                            </div>
                            <input id="password" type="password" class="form-control" name="password" tabindex="2"
                                required>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-lg" tabindex="4">
                                Login
                            </button>
                            <a href="{{ route('register.index') }}" class="btn btn-success btn-lg" tabindex="4">
                                Daftar
                            </a>
                        </div>
                    </form>

                    <div class="text-center mt-5 text-small">
                        Desa Karanglewas. Create by Jwaadul
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
                data-background="../assets/img/unsplash/login-bg.jpg">
                <div class="absolute-bottom-left index-2">
                    <div class="text-light p-5 pb-2">
                        <div class="mb-5 pb-3">
                            <h1 class="mb-2 display-4 font-weight-bold">Selamat Datang</h1>
                            <h5 class="font-weight-normal text-muted-transparent">Website Desa Karanglewas</h5>
                        </div>
                        Banyumas, <a class="text-light bb" target="_blank"
                            href="https://unsplash.com/photos/a8lTjWJJgLA">Jawa Tengah</a> on <a class="text-light bb"
                            target="_blank" href="https://unsplash.com">Indonesia</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
