<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\IdentitasSiswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IdentitasSiswaExport;

// use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;

class DashboardAdmin extends Controller
{
    public function index()
    {

        $akun_pengguna = DB::table("users")->where("role", 1)->count();
        $akun_admin = DB::table('users')->where("role", 0)->count();
        $non_validate = DB::table('tb_identitas_siswa')->where("is_active", 0)->count();
        $validate = DB::table('tb_identitas_siswa')->where("is_active", 1)->count();

        return view(
            'admin.dashboard',
            [
                'akun_pengguna' => $akun_pengguna,
                'akun_admin' => $akun_admin,
                'non_validate' => $non_validate,
                'validate' => $validate,
            ]
        );
    }
    public function validasi_siswa()
    {
        $get_data_registrasi = DB::table('tb_identitas_siswa')->leftJoin('tb_identitas_orangtua', 'tb_identitas_siswa.id_identitas_siswa', '=', 'tb_identitas_orangtua.identitas_siswa_id')->leftJoin('tb_identitas_orangtua_dua', 'tb_identitas_siswa.id_identitas_siswa', '=', 'tb_identitas_orangtua_dua.identitas_siswa_id')->leftjoin('tb_periodik_siswa', 'tb_identitas_siswa.id_identitas_siswa', '=', 'tb_periodik_siswa.identitas_siswa_id')->leftJoin('tb_register_siswa', 'tb_identitas_siswa.id_identitas_siswa', '=', 'tb_register_siswa.identitas_siswa_id')->orderBy('is_active', 'asc')->get();
        // dd($get_data_registrasi);
        return view('admin.validasi_siswa', [
            'get_data_registrasi' => $get_data_registrasi,
        ]);
    }
    public function update_validasi_siswa(Request $request, $id)
    {
        try {
            if ($request->is_active) {
                DB::table('tb_identitas_siswa')->where('id_identitas_siswa', $id)->update(
                    [
                        'is_active' => $request->is_active,
                    ]
                );
            } else {
                DB::table('tb_identitas_siswa')->where('id_identitas_siswa', $id)->update(
                    [
                        'is_active' => $request->not_active,
                    ]
                );
            }
            return redirect('validasi_siswa')->with('success', 'Validasi Success');
        } catch (\Exception $e) {
            return redirect('validasi_siswa')->with('failed', 'Terjadi kesalahan' . $e->getMessage());
        }
    }
    public function destroy_validasi_siswa($id)
    {
        DB::table('tb_identitas_siswa')->where('id_identitas_siswa', $id)->delete();
        return redirect('validasi_siswa')->with('success', 'Data berhasil dihapus');
    }
    public function export()
    {
        return Excel::download(new IdentitasSiswaExport, 'data-register-siswa' . Carbon::now()->timestamp . '.xlsx');
    }
    public function exportCsv()
    {
        return Excel::download(new IdentitasSiswaExport, 'data-register-siswa' . Carbon::now()->timestamp . '.csv');
    }
    public function exportPdf()
    {
        return Excel::download(new IdentitasSiswaExport, 'data-register-siswa' . Carbon::now()->timestamp . '.pdf');
    }
    public function cetakPdf($id)
    {
        $get_data_user = DB::table('tb_identitas_siswa')->leftJoin('tb_identitas_orangtua', 'tb_identitas_siswa.id_identitas_siswa', '=', 'tb_identitas_orangtua.identitas_siswa_id')->leftJoin('tb_identitas_orangtua_dua', 'tb_identitas_siswa.id_identitas_siswa', '=', 'tb_identitas_orangtua_dua.identitas_siswa_id')->leftJoin('tb_periodik_siswa', 'tb_identitas_siswa.id_identitas_siswa', 'tb_periodik_siswa.identitas_siswa_id')->leftJoin('tb_register_siswa', 'tb_identitas_siswa.id_identitas_siswa', '=', 'tb_register_siswa.identitas_siswa_id')->where('id_identitas_siswa', $id)->select(
            'tb_identitas_siswa.id_identitas_siswa',
            'tb_identitas_siswa.nama_lengkap_siswa',
            'tb_identitas_siswa.jenis_kelamin_siswa',
            'tb_identitas_siswa.nik_siswa',
            'tb_identitas_siswa.tempat_lahir_siswa',
            'tb_identitas_siswa.tanggal_lahir_siswa',
            'tb_identitas_siswa.alamat_lengkap_siswa',
            'tb_identitas_siswa.tinggal_bersama_siswa',
            'tb_identitas_siswa.status_anak_ke',
            'tb_identitas_siswa.usia_siswa',
            'tb_identitas_siswa.no_hp',
            'tb_identitas_orangtua.nama_orangtua',
            'tb_identitas_orangtua.nik_orangtua',
            'tb_identitas_orangtua.tanggal_lahir_orangtua',
            'tb_identitas_orangtua.pendidikan_orangtua',
            'tb_identitas_orangtua.pekerjaan_orangtua',
            'tb_identitas_orangtua_dua.nama_orangtua_dua',
            'tb_identitas_orangtua_dua.nik_orangtua_dua',
            'tb_identitas_orangtua_dua.tanggal_lahir_orangtua_dua',
            'tb_identitas_orangtua_dua.pendidikan_orangtua_dua',
            'tb_identitas_orangtua_dua.pekerjaan_orangtua_dua',
            'tb_periodik_siswa.tinggi_badan_siswa',
            'tb_periodik_siswa.berat_badan_siswa',
            'tb_periodik_siswa.jarak_tempuh_siswa',
            'tb_periodik_siswa.jumlah_saudara_siswa',
            'tb_register_siswa.tanggal_pendaftaran_siswa',
            'tb_register_siswa.masuk_rombel_siswa',
            'tb_register_siswa.jenis_pendaftaran',
            'tb_identitas_siswa.is_active',
        )->first();

        $path = public_path() . '/logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $image = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $file_name = "bukti_pendaftaran_" . $get_data_user->nama_lengkap_siswa . Carbon::now()->translatedFormat('d_F_y') . ".pdf";

        // return view('pdf.siswa', ['image' => $image, 'get_data_user' => $get_data_user]);
        $pdf = Pdf::loadView('pdf.siswa', ['image' => $image, 'get_data_user' => $get_data_user])->setPaper('a4', 'potrate')->setWarnings(false)->save($file_name);
        $response =  $pdf->download($file_name);
        unlink(public_path() . "/" . $file_name);
        return $response;
    }
}
