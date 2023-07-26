<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdmin extends Controller
{
    public function index()
    {

        return view('admin.dashboard');
    }
    public function validasi_siswa()
    {
        $get_data_registrasi = DB::table('tb_identitas_siswa')->leftJoin('tb_identitas_orangtua', 'tb_identitas_siswa.id_identitas_siswa', '=', 'tb_identitas_orangtua.identitas_siswa_id')->leftjoin('tb_periodik_siswa', 'tb_identitas_siswa.id_identitas_siswa', '=', 'tb_periodik_siswa.identitas_siswa_id')->leftJoin('tb_register_siswa', 'tb_identitas_siswa.id_identitas_siswa', '=', 'tb_register_siswa.identitas_siswa_id')->orderBy('tb_identitas_siswa.is_active', 'asc')->select('tb_identitas_siswa.nama_lengkap_siswa', 'tb_identitas_orangtua.nama_orangtua')->distinct()->groupBy('nama_orangtua')->get();
        // dd($get_data_registrasi);
        return view('admin.validasi_siswa', [
            'get_data_registrasi' => $get_data_registrasi,
        ]);
    }
}
