<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\VaksinController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\PamsimasController;
use App\Http\Controllers\PKHController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/website_desa', function () {
//     return view('layouts.master');
// });
// Route::get('/', function () {
//     return view('index');
// });


// Route::get('/register', function () {
//     return view('auth/register');
// });

// route login
Route::get('/login', [AuthController::class, 'index'])->name('login.index');
Route::post('/login', [AuthController::class, 'process'])->name('login.process');
Route::get('/register', [AuthController::class, 'register'])->name('register.index');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');

// route logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout.logout');

// route admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'login_check:admin']], function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('index');
    Route::get('/getData/{user_id}', [AdminDashboardController::class, 'getData'])->name('data');
});

// route user
Route::group(['as' => 'user.', 'middleware' => ['auth', 'login_check:user']], function () {
    Route::get('/', [UserDashboardController::class, 'index'])->name('index');
});

// route profile
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => 'auth'], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
});

// route struktur
Route::group(['prefix' => 'struktur', 'as' => 'struktur.', 'middleware' => 'auth'], function () {
    Route::get('/', [StrukturController::class, 'index'])->name('index');
});

// route penduduk
Route::group(['prefix' => 'penduduk', 'as' => 'penduduk.', 'middleware' => 'auth'], function () {
    Route::get('/', [PendudukController::class, 'index'])->name('index');
    Route::get('/create', [PendudukController::class, 'create'])->name('create');
    Route::post('/create', [PendudukController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PendudukController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [PendudukController::class, 'update'])->name('update');
    Route::post('/update2/{id}', [PendudukController::class, 'update2'])->name('update2');
    Route::post('/destroy/{id}', [PendudukController::class, 'delete'])->name('destroy');
    Route::get('/verification/{id}', [PendudukController::class, 'verif'])->name('verification');
});

// route pkh
Route::group(['prefix' => 'pkh', 'as' => 'pkh.', 'middleware' => 'auth'], function () {
    Route::get('/', [PKHController::class, 'index'])->name('index');
    Route::get('/create', [PKHController::class, 'create'])->name('create');
    Route::post('/create', [PKHController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PKHController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [PKHController::class, 'update'])->name('update');
    Route::post('/destroy/{id}', [PKHController::class, 'delete'])->name('destroy');
    Route::post('/ChangeStatus/{id}', [PKHController::class, 'ChangeStatus'])->name('ChangeStatus');
});

// route vaksin
Route::group(['prefix' => 'vaksin', 'as' => 'vaksin.', 'middleware' => 'auth'], function () {
    Route::get('/', [VaksinController::class, 'index'])->name('index');
    Route::get('/create', [VaksinController::class, 'create'])->name('create');
    Route::post('/create', [VaksinController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [VaksinController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [VaksinController::class, 'update'])->name('update');
    Route::post('/destroy/{id}', [VaksinController::class, 'delete'])->name('destroy');
});

// route umkm
Route::group(['prefix' => 'umkm', 'as' => 'umkm.', 'middleware' => 'auth'], function () {
    Route::get('/', [UmkmController::class, 'index'])->name('index');
    Route::get('/create', [UmkmController::class, 'create'])->name('create');
    Route::get('/create2', [UmkmController::class, 'create2'])->name('create2');
    Route::post('/create', [UmkmController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [UmkmController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [UmkmController::class, 'update'])->name('update');
    Route::post('/destroy/{id}', [UmkmController::class, 'delete'])->name('destroy');
    Route::post('/registrasi', [UmkmController::class, 'regis'])->name('registrasi');
});

// route pamsimas
Route::group(['prefix' => 'pamsimas', 'as' => 'pamsimas.', 'middleware' => 'auth'], function () {
    Route::get('/', [PamsimasController::class, 'index'])->name('index');
    Route::get('/create', [PamsimasController::class, 'create'])->name('create');
    Route::post('/store', [PamsimasController::class, 'store'])->name('store');
    Route::get('/payment/{id}', [PamsimasController::class, 'payment'])->name('payment');
    Route::get('/paymentConfirmation/{id}', [PamsimasController::class, 'confirm'])->name('confirm');
});
