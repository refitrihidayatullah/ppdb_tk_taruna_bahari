<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardClient;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardAdmin;
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

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', [UserController::class, 'login'])->name('login');
Route::get('register', [UserController::class, 'register']);
Route::post('store_register', [UserController::class, 'register_action']);
Route::post('store_login', [UserController::class, 'login_action']);
Route::get('logout', [UserController::class, 'logout_action']);


Route::middleware(['auth',  'user-auth'])->group(function () {
    Route::get('/dashboard', [DashboardClient::class, 'index']);
    Route::get('/identitas_siswa', [DashboardClient::class, 'identitasSiswa']);
    Route::get('/identitas_siswa/{id}/edit', [DashboardClient::class, 'identitasSiswaEdit']);
    Route::post('/store_indentitas_siswa', [DashboardClient::class, 'storeIdentitasSiswa']);
    Route::put('/update_indentitas_siswa/{id}', [DashboardClient::class, 'updateIdentitasSiswa']);
    Route::delete('/identitas_siswa/{id}', [DashboardClient::class, 'destroy']);
    Route::get('/identitas_ortu', [DashboardClient::class, 'identitasOrtu']);
    Route::post('/store_orangtua', [DashboardClient::class, 'storeOrtu']);
    Route::get('/identitas_ortu/{id}/edit', [DashboardClient::class, 'IdentitasOrtuEdit']);
    Route::put('/identitas_ortu/{id}', [DashboardClient::class, 'updateIdentitasOrtu']);
    Route::delete('/identitas_ortu/{id}', [DashboardClient::class, 'destroyIdentitasOrtu']);

    Route::get('/periodik_siswa', [DashboardClient::class, 'periodikSiswa']);
    Route::post('/store_periodik', [DashboardClient::class, 'storePeriodikSiswa']);
    Route::get('/periodik_siswa/{id}/edit', [DashboardClient::class, 'periodikSiswaEdit']);
    Route::put('/periodik_siswa/{id}', [DashboardClient::class, 'updatePeriodikSiswa']);
    Route::delete('/periodik_siswa/{id}', [DashboardClient::class, 'destroyPeriodikSiswa']);

    Route::get('/register_siswa', [DashboardClient::class, 'registerSiswa']);
    Route::post('/store_registerSiswa', [DashboardClient::class, 'storeRegistrasiSiswa']);
    Route::get('/register_siswa/{id}/edit', [DashboardClient::class, 'registerSiswaEdit']);
    Route::put('/register_siswa/{id}', [DashboardClient::class, 'update_registerSiswa']);
    Route::delete('/register_siswa/{id}', [DashboardClient::class, 'destory_registerSiswa']);

    Route::get('/bukti_pendaftaran/{id}', [DashboardClient::class, 'cetakBuktiPendaftaran']);
});

Route::middleware(['auth', 'admin-auth'])->group(function () {
    Route::get('/dashboard_admin', [DashboardAdmin::class, 'index']);
    Route::get('/validasi_siswa', [DashboardAdmin::class, 'validasi_siswa']);
    Route::put('/validasi_siswa/{id}', [DashboardAdmin::class, 'update_validasi_siswa']);
    Route::delete('/validasi_siswa/{id}', [DashboardAdmin::class, 'destroy_validasi_siswa']);
    Route::get('/siswa_export', [DashboardAdmin::class, 'export']);
    Route::get('/siswa_export_csv', [DashboardAdmin::class, 'exportCsv']);
    Route::get('/siswa_export_pdf', [DashboardAdmin::class, 'exportPdf']);
    Route::get('/siswa_pdf/{id}', [DashboardAdmin::class, 'cetakPdf']);
});
