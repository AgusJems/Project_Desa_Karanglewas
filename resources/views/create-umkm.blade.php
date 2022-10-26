@extends('layouts.master-1')
@push('plugins_css')
<link rel="stylesheet" href="../node_modules/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="../node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
<link rel="stylesheet" href="../node_modules/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="../node_modules/selectric/public/selectric.css">
<link rel="stylesheet" href="../node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="../node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
@endpush

@section('title', 'Input Umkm')
@section('appName', 'Web Desa')
@section('content')
<section class="section">
  <div class="section-header">
    <h1>Form Tambah Vaksin</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{route('umkm.index')}}">UMKM</a></div>
      <div class="breadcrumb-item">Form Tambah UMKM</div>
    </div>
  </div>

  <div class="section-body">
    {{-- <h2 class="section-title">Advanced Forms</h2>
    <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so on.</p> --}}

    <div class="row">
      <div class="col-xl-12 col-md-6 col-lg-6">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('umkm.store') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" id="nik" name="nik" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="alamat">Lokasi</label>
                <input type="text" id="lokasi" name="lokasi" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori" class="form-control" required>
                  <option>--Pilih Kategori--</option>
                  <option value="jadi">Jadi</option>
                  <option value="setjadi">Setengah Jadi</option>
                  <option value="mentah">Mentah</option>
                </select>
                <div class="form-group">
                  <label for="file">Upload Gambar</label>
                  <input type="file" id="file" name="file" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label for="produk">Nama Produk</label>
                <input type="produk" id="produk" name="produk" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="harga">Harga</label>
                <input type="harga" id="harga" name="harga" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="satuan">Satuan Penjualan</label>
                <select id="satuan" name="satuan" class="form-control" required>
                  <option>--Pilih Satuan Penjualan--</option>
                  <option value="pcs">Pcs</option>
                  <option value="kg">Kg</option>
                  <option value="meter">Meter</option>
                  <option value="bungkus">Bungkus</option>
                  <option value="lembar">Lembar</option>
                </select>
              </div>
              <button class="btn btn-primary" type="submit">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('plugins_js')
<script src="../node_modules/cleave.js/dist/cleave.min.js"></script>
<script src="../node_modules/cleave.js/dist/addons/cleave-phone.us.js"></script>
<script src="../node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
<script src="../node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="../node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="../node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="../node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="../node_modules/select2/dist/js/select2.full.min.js"></script>
<script src="../node_modules/selectric/public/jquery.selectric.min.js"></script>
@endpush

@push('page_js')
<script src="../assets/js/page/forms-advanced-forms.js"></script>
@endpush