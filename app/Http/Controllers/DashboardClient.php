<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DashboardClient extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.dashboard');
    }

    public function identitasSiswa()
    {
        $id_siswa = Auth::user()->id;
        $cek_siswa = DB::table('tb_identitas_siswa')->where('user_id', $id_siswa)->first();
        $identitas_siswa = DB::table('tb_identitas_siswa')->where('user_id', $id_siswa)->first();
        $pilihan_jeniskelamin = ['L', 'P'];
        $pilihan_tinggal = ['orangtua', 'wali'];
        return view(
            'client.identitas_siswa',
            [
                'identitas_siswa' => $identitas_siswa,
                'cek_siswa' => $cek_siswa,
                'pilihan_jeniskelamin' => $pilihan_jeniskelamin,
                'pilihan_tinggal' => $pilihan_tinggal,
            ]
        );
    }

    function identitasOrtu()
    {
        $id_siswa = Auth::user()->id;


        $count_ortu = DB::table('tb_identitas_orangtua')->where('user_id', $id_siswa)->count();

        $identitas_ortu = DB::table('tb_identitas_siswa')->leftjoin('tb_identitas_orangtua', 'tb_identitas_siswa.id_identitas_siswa', '=', 'tb_identitas_orangtua.identitas_siswa_id')->where('tb_identitas_siswa.user_id', $id_siswa)->get();
        $pilihan_pendidikan = ['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'];
        $pilihan_pekerjaan = ['PNS', 'Pengusaha', 'Karyawan Swasta', 'Wiraswasta', 'Sopir', 'Guru/Dosen', 'Dokter', 'Pensiunan', 'Programmer', 'Lainnya'];
        return view(
            'client.identitas_ortu',
            [
                'identitas_ortu' => $identitas_ortu,
                'count_ortu' => $count_ortu,
                'pilihan_pendidikan' => $pilihan_pendidikan,
                'pilihan_pekerjaan' => $pilihan_pekerjaan,
            ]
        );
    }
    public function periodikSiswa()
    {
        $id_user = Auth::user()->id;
        $count_periodik = DB::table('tb_periodik_siswa')->where('user_id', $id_user)->count();
        $periodik_siswa = DB::table('tb_identitas_siswa')->leftJoin('tb_periodik_siswa', 'tb_identitas_siswa.id_identitas_siswa', '=', 'tb_periodik_siswa.identitas_siswa_id')->where('tb_identitas_siswa.user_id', $id_user)->get();
        $pilihan_jarak = ['kurang dari 1km', '1 - 2km', '2 - 5km', '5 - 10km', 'lebih dari 10km'];
        return view(
            'client.periodik_siswa',
            [
                'pilihan_jarak' => $pilihan_jarak,
                'periodik_siswa' =>  $periodik_siswa,
                'count_periodik' => $count_periodik,
            ]
        );
    }

    public function storeIdentitasSiswa(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'nama_lengkap_siswa' => 'required',
                'jenis_kelamin_siswa' => 'required',
                'nik_siswa' => 'unique:App\Models\IdentitasSiswa,nik_siswa',
                'tempat_lahir_siswa' => 'required',
                'tanggal_lahir_siswa' => 'required',
                'alamat_lengkap_siswa' => 'required',
                'tinggal_bersama_siswa' => 'required',
                'status_anak_ke' => 'required',
                'usia_siswa' => 'required',
                'no_hp' => 'required',
            ], [
                'nama_lengkap_siswa.required' => 'Nama Siswa Harus diisi',
                'jenis_kelamin_siswa.required' => 'Jenis Kelamin Siswa Harus diisi',
                'nik_siswa.unique' => 'nik siswa sudah terdaftar',
                'tempat_lahir_siswa.required' => 'tempat lahir siswa harus diisi',
                'tanggal_lahir_siswa.required' => 'tanggal lahir siswa harus diisi',
                'alamat_lengkap_siswa.required' => 'alamat siswa harus diisi',
                'tinggal_bersama_siswa.required' => 'status tinggal siswa harus diisi',
                'status_anak_ke.required' => 'status anak ke harus diisi',
                'usia_siswa.required' => 'usia siswa harus diisi',
                'no_hp.required' => 'no hp orangtua harus diisi',
            ]);

            DB::beginTransaction();
            DB::table('tb_identitas_siswa')->insert([
                'nama_lengkap_siswa' => $request->nama_lengkap_siswa,
                'user_id' => Auth::user()->id,
                'jenis_kelamin_siswa' => $request->jenis_kelamin_siswa,
                'nik_siswa' => $request->nik_siswa,
                'tempat_lahir_siswa' => $request->tempat_lahir_siswa,
                'tanggal_lahir_siswa' => $request->tanggal_lahir_siswa,
                'alamat_lengkap_siswa' => $request->alamat_lengkap_siswa,
                'tinggal_bersama_siswa' => $request->tinggal_bersama_siswa,
                'status_anak_ke' => $request->status_anak_ke,
                'usia_siswa' => $request->usia_siswa,
                'no_hp' => $request->no_hp,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            DB::commit();
            return redirect('identitas_siswa')->with('success', 'Selanjutnya Klik NEXT dan Silahkan Lengkapi Identitas Orang Tua Siswa');
        } catch (\Exception $e) {
            return redirect('identitas_siswa')->withErrors($validator)->with('failed', 'Terjadi Kesalahan');
        }
    }

    public function storeOrtu(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'nama_orangtua' => 'required',
                    'status_orangtua' => 'required',
                    'nik_orangtua' => 'required:unique:App\Models\IdentitasOrtu,nik_orangtua',
                    'tanggal_lahir_orangtua' => 'required',
                    'pendidikan_orangtua' => 'required',
                    'pekerjaan_orangtua' => 'required',
                ],
                [
                    'nama_orangtua.required' => 'Nama orangtua harus diisi',
                    'status_orangtua.required' => 'status orang tua harus diisi',
                    'nik_orangtua.required' => 'nik orang tua harus diisi',
                    'nik_orangtua.unique' => 'nik sudah terdaftar',
                    'tanggal_lahir_orangtua.required' => 'tanggal lahir harus diisi',
                    'pendidikan_orangtua.required' => 'pendidikan harus diisi',
                    'pekerjaan_orangtua.required' => 'pekerjaan harus diisi',
                ]
            );
            if ($validator->fails()) {
                return redirect('identitas_ortu')->withErrors($validator)->with('failed', 'Terjadi kesalahan');
            }
            $id_siswa = Auth::user()->id;
            $get_id_siswa = DB::table('tb_identitas_siswa')->select('id_identitas_siswa')->where('user_id', $id_siswa)->first();

            DB::table('tb_identitas_orangtua')->insert([
                'identitas_siswa_id' => $get_id_siswa->id_identitas_siswa,
                'user_id' => $id_siswa,
                'nama_orangtua' => $request->nama_orangtua,
                'status_orangtua' => $request->status_orangtua,
                'nik_orangtua' => $request->nik_orangtua,
                'tanggal_lahir_orangtua' => $request->tanggal_lahir_orangtua,
                'pendidikan_orangtua' => $request->pendidikan_orangtua,
                'pekerjaan_orangtua' => $request->pekerjaan_orangtua,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return redirect('identitas_ortu')->with('success', 'Data berhasil di tambahkan');
        } catch (\Exception $e) {
            return redirect('identitas_ortu')->with('failed', 'Terjadi kesalahan' . $e->getMessage());
        }
    }
    public function storePeriodikSiswa(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'tinggi_badan_siswa' => 'required',
                'berat_badan_siswa' => 'required',
                'jarak_tempuh_siswa' => 'required',
                'jumlah_saudara_siswa' => 'required',
            ],
            [
                'tinggi_badan_siswa.required' => 'Tinggi badan siswa harus diisi',
                'berat_badan_siswa.required' => 'Berat badan siswa harus diisi',
                'jarak_tempuh_siswa.required' => 'Jarak tempuh siswa harus diisi',
                'jumlah_saudara_siswa.required' => 'Jumlah saudara siswa harus diisi',
            ]
        );
        if ($validator->fails()) {
            return redirect('periodik_siswa')->withErrors($validator)->with('failed', 'terjadi kesalahan');
        } else {
            $id_user = Auth::user()->id;
            $id_siswa = DB::table('tb_identitas_siswa')->select('id_identitas_siswa')->where('user_id', $id_user)->first();
            $id_ortu = DB::table('tb_identitas_orangtua')->select('id_identitas_orangtua')->where('user_id', $id_user)->first();

            DB::table('tb_periodik_siswa')->insert([
                'user_id' => $id_user,
                'identitas_siswa_id' => $id_siswa->id_identitas_siswa,
                'identitas_orangtua_id' => $id_ortu->id_identitas_orangtua,
                'tinggi_badan_siswa' => $request->tinggi_badan_siswa,
                'berat_badan_siswa' => $request->berat_badan_siswa,
                'jarak_tempuh_siswa' => $request->jarak_tempuh_siswa,
                'jumlah_saudara_siswa' => $request->jumlah_saudara_siswa,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return redirect('periodik_siswa')->with('success', 'Data berhasil ditambahkan');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public function identitasSiswaEdit($id)
    {
        $get_data_siswa = DB::table('tb_identitas_siswa')->where('id_identitas_siswa', $id)->first();
        $pilihan_jeniskelamin = ['L', 'P'];
        $pilihan_tinggal = ['orangtua', 'wali'];
        return view(
            'client.edit_identitas_siswa',
            [
                'get_data_siswa' => $get_data_siswa,
                'pilihan_jeniskelamin' => $pilihan_jeniskelamin,
                'pilihan_tinggal' => $pilihan_tinggal,
            ]
        );
    }
    public function IdentitasOrtuEdit($id)
    {
        $pilihan_pendidikan = ['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'];
        $pilihan_pekerjaan = ['PNS', 'Pengusaha', 'Karyawan Swasta', 'Wiraswasta', 'Sopir', 'Guru/Dosen', 'Dokter', 'Pensiunan', 'Programmer', 'Lainnya'];
        $get_data_ortu = DB::table('tb_identitas_orangtua')->where('id_identitas_orangtua', $id)->first();
        return view('client.edit_identitas_ortu', ['get_data_ortu' => $get_data_ortu, 'pilihan_pendidikan' => $pilihan_pendidikan, 'pilihan_pekerjaan' => $pilihan_pekerjaan]);
    }
    public function periodikSiswaEdit($id)
    {
        $id_user = Auth::user()->id;
        $pilihan_jarak = ['kurang dari 1km', '1 - 2km', '2 - 5km', '5 - 10km', 'lebih dari 10km'];
        $get_data_periodik = DB::table('tb_identitas_siswa')->leftJoin('tb_periodik_siswa', 'tb_identitas_siswa.id_identitas_siswa', '=', 'tb_periodik_siswa.identitas_siswa_id')->where('tb_periodik_siswa.user_id', $id_user)->first();

        return view(
            'client.edit_periodik_siswa',
            [
                'pilihan_jarak' => $pilihan_jarak,
                'get_data_periodik' => $get_data_periodik,
            ]
        );
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function updateIdentitasSiswa(Request $request, $id)
    {
        try {

            $validator = Validator::make($request->all(), [
                'nama_lengkap_siswa' => 'required',
                'jenis_kelamin_siswa' => 'required',
                'tempat_lahir_siswa' => 'required',
                'tanggal_lahir_siswa' => 'required',
                'alamat_lengkap_siswa' => 'required',
                'tinggal_bersama_siswa' => 'required',
                'status_anak_ke' => 'required',
                'usia_siswa' => 'required',
                'no_hp' => 'required',
            ], [
                'nama_lengkap_siswa.required' => 'Nama Siswa Harus diisi',
                'jenis_kelamin_siswa.required' => 'Jenis Kelamin Siswa Harus diisi',
                'tempat_lahir_siswa.required' => 'tempat lahir siswa harus diisi',
                'tanggal_lahir_siswa.required' => 'tanggal lahir siswa harus diisi',
                'alamat_lengkap_siswa.required' => 'alamat siswa harus diisi',
                'tinggal_bersama_siswa.required' => 'status tinggal siswa harus diisi',
                'status_anak_ke.required' => 'status anak ke harus diisi',
                'usia_siswa.required' => 'usia siswa harus diisi',
                'no_hp.required' => 'no hp orangtua harus diisi',
            ]);

            DB::beginTransaction();
            DB::table('tb_identitas_siswa')->where('id_identitas_siswa', $id)->update([
                'nama_lengkap_siswa' => $request->nama_lengkap_siswa,
                'jenis_kelamin_siswa' => $request->jenis_kelamin_siswa,
                'nik_siswa' => $request->nik_siswa,
                'tempat_lahir_siswa' => $request->tempat_lahir_siswa,
                'tanggal_lahir_siswa' => $request->tanggal_lahir_siswa,
                'alamat_lengkap_siswa' => $request->alamat_lengkap_siswa,
                'tinggal_bersama_siswa' => $request->tinggal_bersama_siswa,
                'status_anak_ke' => $request->status_anak_ke,
                'usia_siswa' => $request->usia_siswa,
                'no_hp' => $request->no_hp,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            DB::commit();
            return redirect('identitas_siswa')->with('success', 'Selanjutnya Klik NEXT dan Silahkan Lengkapi Identitas Orang Tua Siswa');
        } catch (\Exception $e) {

            return redirect('identitas_siswa')->with('failed', 'Terjadi Kesalahan');
        }
    }
    public function updateIdentitasOrtu(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_orangtua' => 'required',
                'status_orangtua' => 'required',
                'nik_orangtua' => 'required:unique:App\Models\IdentitasOrtu,nik_orangtua',
                'tanggal_lahir_orangtua' => 'required',
                'pendidikan_orangtua' => 'required',
                'pekerjaan_orangtua' => 'required',
            ],
            [
                'nama_orangtua.required' => 'Nama orangtua harus diisi',
                'status_orangtua.required' => 'status orang tua harus diisi',
                'nik_orangtua.required' => 'nik orang tua harus diisi',
                'nik_orangtua.unique' => 'nik sudah terdaftar',
                'tanggal_lahir_orangtua.required' => 'tanggal lahir harus diisi',
                'pendidikan_orangtua.required' => 'pendidikan harus diisi',
                'pekerjaan_orangtua.required' => 'pekerjaan harus diisi',
            ]
        );
        if ($validator->fails()) {
            return redirect('identitas_ortu')->with('failed', 'Terjadi Kesalahan');
        } else {
            DB::table('tb_identitas_orangtua')->where('id_identitas_orangtua', $id)->update(
                [
                    'nama_orangtua' => $request->nama_orangtua,
                    'status_orangtua' => $request->status_orangtua,
                    'nik_orangtua' => $request->nik_orangtua,
                    'tanggal_lahir_orangtua' => $request->tanggal_lahir_orangtua,
                    'pendidikan_orangtua' => $request->pendidikan_orangtua,
                    'pekerjaan_orangtua' => $request->pekerjaan_orangtua,
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]
            );
            return redirect('identitas_ortu')->with('success', 'Data Berhasil Diupdate');
        }
    }
    public function updatePeriodikSiswa(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'tinggi_badan_siswa' => 'required',
                'berat_badan_siswa' => 'required',
                'jarak_tempuh_siswa' => 'required',
                'jumlah_saudara_siswa' => 'required',
            ],
            [
                'tinggi_badan_siswa.required' => 'Tinggi badan siswa harus diisi',
                'berat_badan_siswa.required' => 'Berat badan siswa harus diisi',
                'jarak_tempuh_siswa.required' => 'Jarak tempuh siswa harus diisi',
                'jumlah_saudara_siswa.required' => 'Jumlah saudara siswa harus diisi',
            ]
        );
        if ($validator->fails()) {
            return redirect('periodik_siswa')->with('failed', 'Terjadi Kesalahan');
        } else {
            DB::table('tb_periodik_siswa')->where('id_periodik_siswa', $id)->update(
                [
                    'tinggi_badan_siswa' => $request->tinggi_badan_siswa,
                    'berat_badan_siswa' => $request->berat_badan_siswa,
                    'jarak_tempuh_siswa' => $request->jarak_tempuh_siswa,
                    'jumlah_saudara_siswa' => $request->jumlah_saudara_siswa,
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]
            );
            return redirect('periodik_siswa')->with('success', 'Data berhasil diupdate');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            DB::table('tb_identitas_siswa')->where('id_identitas_siswa', $id)->delete();
            return redirect('identitas_siswa')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {

            return redirect('identitas_siswa')->with('failed', 'Terjadi Kesalahan');
        }
    }
    public function destroyIdentitasOrtu($id)
    {

        DB::table('tb_identitas_orangtua')->where('id_identitas_orangtua', $id)->delete();

        return redirect('identitas_ortu')->with('success', 'Data Berhasil didelete');
    }
    public function destroyPeriodikSiswa($id)
    {
        DB::table('tb_periodik_siswa')->where('id_periodik_siswa', $id)->delete();
        return redirect('periodik_siswa')->with('success', 'data berhasil dihapus');
    }
}
