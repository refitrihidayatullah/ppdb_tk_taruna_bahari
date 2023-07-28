<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class IdentitasSiswaExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles

{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return IdentitasSiswa::all();
        return DB::table('tb_identitas_siswa')->leftJoin('tb_identitas_orangtua', 'tb_identitas_siswa.id_identitas_siswa', '=', 'tb_identitas_orangtua.identitas_siswa_id')->leftJoin('tb_identitas_orangtua_dua', 'tb_identitas_siswa.id_identitas_siswa', '=', 'tb_identitas_orangtua_dua.identitas_siswa_id')->leftJoin('tb_periodik_siswa', 'tb_identitas_siswa.id_identitas_siswa', 'tb_periodik_siswa.identitas_siswa_id')->leftJoin('tb_register_siswa', 'tb_identitas_siswa.id_identitas_siswa', '=', 'tb_register_siswa.identitas_siswa_id')->select(
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
            'tb_identitas_orangtua_dua.nama_orangtua_dua',
            'tb_identitas_orangtua_dua.nik_orangtua_dua',
            'tb_identitas_orangtua_dua.tanggal_lahir_orangtua_dua',
            'tb_identitas_orangtua_dua.pendidikan_orangtua_dua',
            'tb_periodik_siswa.tinggi_badan_siswa',
            'tb_periodik_siswa.berat_badan_siswa',
            'tb_periodik_siswa.jarak_tempuh_siswa',
            'tb_register_siswa.tanggal_pendaftaran_siswa',
            'tb_register_siswa.masuk_rombel_siswa',
            'tb_register_siswa.jenis_pendaftaran',
            'tb_identitas_siswa.is_active',
        )->get();
    }
    public function headings(): array
    {
        return [
            'Id',
            'Nama_siswa',
            'Gender',
            'Nik_siswa',
            'Tempat_lahir_siswa',
            'Tanggal_lahir_siswa',
            'Alamat',
            'Tinggal_dengan',
            'Anak ke',
            'Usia_siswa',
            'No_hp',
            'Nama_Ayah',
            'Nik_Ayah',
            'Tanggal_lahir',
            'Pendidikan',
            'Nama_Ibu',
            'Nik_Ibu',
            'Tanggal_lahir',
            'Pendidikan',
            'Tinggi_badan_siswa',
            'Berat_badan_siswa',
            'Jarak_tempuh_siswa',
            'Tgl_pendaftaran',
            'Rombel_siswa',
            'Jenis_pendaftaran',
            'Validasi',
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' => 20,
            'M' => 20,
            'N' => 20,
            'O' => 20,
            'P' => 20,
            'Q' => 20,
            'R' => 20,
            'S' => 20,
            'T' => 20,
            'U' => 20,
            'V' => 20,
            'W' => 20,
            'X' => 20,
            'Y' => 20,
            'Z' => 20,
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true, 'size' => 12]],

            // // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }
}
