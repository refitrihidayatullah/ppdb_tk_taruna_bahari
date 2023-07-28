<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Form Register</title>

</head>

<body>
  @php
  use Carbon\carbon;
  // dd($image);
  @endphp
  <div>
    <table style="width:100%;border-bottom: 5px solid green;">
      <tr style="text-align: center">
        <td style="width: 10%"><img style="height: 70px" width="70px" src="{{$image}}" alt="logo"></td>
        <td style="width: 90%">
          <h5 style="line-height:3px;">PENERIMAAN PESERTA DIDIK BARU (PPDB)</h5>
          <h6 style="line-height:3px;">TAHUN AJARAN {{Carbon::now()->format('Y')}} - {{ Carbon::now()->addYear(1)->year}}</h6>
          <h6 style="line-height:3px;">PENDIDIKAN ANAK USIA DINI(PAUD)</h6>
        </td>
      </tr>
    </table>
    <h6 style="text-align: center;margin-top:8px;margin-bottom:10px;">Formulir Pendaftaran Penerimaan Peserta Didik Baru (PPDB)</h6>
    <table style="width:100%;border-bottom: 1px solid green;">
      <p style="font-size:13px; font-weight: bold;text-decoration: underline;">IDENTITAS SISWA</p>
      <tr>
        <td style="font-weight: bold; font-size:12px;">1. Nama Lengkap</td>
        <td style="font-size:12px;">: {{$get_data_user->nama_lengkap_siswa}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">2. Jenis Kelamin</td>
        <td style="font-size:12px;">: {{$get_data_user->jenis_kelamin_siswa}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">3. Nik</td>
        <td style="font-size:12px;">: {{$get_data_user->nik_siswa}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">4. Tempat/Tanggal Lahir</td>
        <td style="font-size:12px;">: {{$get_data_user->tempat_lahir_siswa}} / {{Carbon::parse($get_data_user->tanggal_lahir_siswa)->translatedFormat('d F Y')}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">5. Alamat Lengkap</td>
        <td style="font-size:12px;">: {{$get_data_user->alamat_lengkap_siswa}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">6. Tinggal Bersama</td>
        <td style="font-size:12px;">: {{$get_data_user->tinggal_bersama_siswa}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">7. Anak ke</td>
        <td style="font-size:12px;">: {{$get_data_user->status_anak_ke}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">8. Usia</td>
        <td style="font-size:12px;">: {{$get_data_user->usia_siswa}} Tahun</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;width:50%">9. No Hp</td>
        <td style="font-size:12px;width:50%">: {{$get_data_user->no_hp}}</td>
      </tr>
    </table>



    <table style="width:100%;border-bottom: 1px solid green;">
      <p style="font-size:13px; font-weight: bold;text-decoration: underline;width:50%;">ORANG TUA</p>
      <tr>
        <td style="font-weight: bold; font-size:12px;width:50%;">1. Nama Ayah</td>
        <td style="font-size:12px; ">: {{$get_data_user->nama_orangtua}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">&nbsp; &nbsp; Nik</td>
        <td style="font-size:12px;">: {{$get_data_user->nik_orangtua}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">&nbsp; &nbsp;Tanggal Lahir</td>
        <td style="font-size:12px;">: {{Carbon::parse($get_data_user->tanggal_lahir_orangtua)->translatedFormat('d F Y')}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">&nbsp; &nbsp;Pendidikan</td>
        <td style="font-size:12px;">: {{$get_data_user->pendidikan_orangtua}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">&nbsp; &nbsp;Pekerjaan</td>
        <td style="font-size:12px;">: {{$get_data_user->pekerjaan_orangtua}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">2. Nama Ibu</td>
        <td style="font-size:12px;">: {{$get_data_user->nama_orangtua_dua}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">&nbsp; &nbsp;Nik</td>
        <td style="font-size:12px;">: {{$get_data_user->nik_orangtua_dua}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">&nbsp; &nbsp;Tanggal Lahir</td>
        <td style="font-size:12px;">: {{Carbon::parse($get_data_user->tanggal_lahir_orangtua_dua)->translatedFormat('d F Y')}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">&nbsp; &nbsp;Pendidikan</td>
        <td style="font-size:12px;">: {{$get_data_user->pendidikan_orangtua_dua}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">&nbsp; &nbsp;Pekerjaan</td>
        <td style="font-size:12px;">: {{$get_data_user->pekerjaan_orangtua_dua}}</td>
      </tr>
    </table>



    <table style="width:100%;border-bottom: 1px solid green;">
      <p style="font-size:13px; font-weight: bold;text-decoration: underline;">PERIODIK</p>
      <tr>
        <td style="font-weight: bold; font-size:12px;width:50%;">1. Tinggi Badan</td>
        <td style="font-size:12px;width:50%;">: {{$get_data_user->tinggi_badan_siswa}} cm</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">2. Berat Badan</td>
        <td style="font-size:12px;">: {{$get_data_user->berat_badan_siswa}} kg</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">3. Jarak Tempuh</td>
        <td style="font-size:12px;">: {{$get_data_user->jarak_tempuh_siswa}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">4. Jumlah Saudara</td>
        <td style="font-size:12px;">: {{$get_data_user->jumlah_saudara_siswa}} Bersaudara</td>
      </tr>
    </table>


    <table style="width:100%;border-bottom: 1px solid green;">
      <p style="font-size:13px; font-weight: bold;text-decoration: underline;">REGISTER/DAFTAR ULANG</p>
      <tr>
        <td style="font-weight: bold; font-size:12px;width:50%;">1. Tanggal Pendaftaran</td>
        <td style="font-size:12px;width:50%;">: {{Carbon::parse($get_data_user->tanggal_pendaftaran_siswa)->translatedFormat('d F Y')}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">2. Masuk Rombel</td>
        <td style="font-size:12px;">: {{$get_data_user->masuk_rombel_siswa}}</td>
      </tr>
      <tr>
        <td style="font-weight: bold; font-size:12px;">3. Jenis Pendaftaran/ Daftar Ulang</td>
        <td style="font-size:12px;">: {{$get_data_user->jenis_pendaftaran}}</td>
      </tr>


    </table>
    <table style="margin-left: 500px;margin-top:25px;">
      <tr>
        <td>Jember,{{Carbon::parse($get_data_user->tanggal_pendaftaran_siswa)->translatedFormat('l d F Y')}}</td>
      </tr>
      <tr>
        <td style="text-align: center">Orang Tua</td>
      </tr>
    </table>
    <table style="margin-left: 500px;margin-top:35px;">
      <tr>
        <td>............................................</td>
      </tr>
    </table>

  </div>



</body>

</html>