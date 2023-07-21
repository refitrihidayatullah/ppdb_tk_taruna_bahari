@extends('layout.main')
@section('title','Identitas Siswa')
@section('content')

<div class="row">
  <!-- Content Column -->
  <div class="col-lg-12 mb-4">
    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Identitas Siswa</h6>
      </div>
      <div class="card-body">
        <form action="{{url("/update_indentitas_siswa/".$get_data_siswa->id_identitas_siswa)}}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="nama_lengkap_siswa">Nama Lengkap Siswa</label>
            <input type="text" class="form-control" name="nama_lengkap_siswa" id="nama_lengkap_siswa" value="{{$get_data_siswa->nama_lengkap_siswa}}" placeholder="masukkan nama lengkap siswa">
          </div>

          <div class="form-group">
            <label for="nik_siswa">Nik</label>
            <input type="text" class="form-control" name="nik_siswa" id="nik_siswa" value="{{$get_data_siswa->nik_siswa}}" placeholder="masukkan nik siswa">
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="jenis_kelamin_siswa">Jenis Kelamin</label>
              <select class="form-control" name="jenis_kelamin_siswa" id="jenis_kelamin_siswa">
                @foreach ($pilihan_jeniskelamin as $jeniskelamin)
                <option value="{{$get_data_siswa->jenis_kelamin_siswa === $jeniskelamin ? $get_data_siswa->jenis_kelamin_siswa : $jeniskelamin }}" {{$get_data_siswa->jenis_kelamin_siswa === $jeniskelamin ? 'selected':''}}>{{$jeniskelamin === 'L'? 'Laki-Laki':'Perempuan'}}</option>     
                @endforeach

              </select>
            </div>
            <div class="form-group col-md-5">
              <label for="tempat_lahir_siswa">Tempat Lahir</label>
              <input type="text" class="form-control" value="{{$get_data_siswa->tempat_lahir_siswa}}" id="tempat_lahir_siswa" name="tempat_lahir_siswa">
            </div>
            <div class="form-group col-md-3">
              <label for="tanggal_lahir_siswa">Tanggal Lahir</label>
              <input type="date" class="form-control" name="tanggal_lahir_siswa" value="{{$get_data_siswa->tanggal_lahir_siswa}}" id="tanggal_lahir_siswa">
            </div>
          </div>
          <div class="form-group">
            <label for="alamat_siswa">Alamat Lengkap Siswa</label>
            <textarea class="form-control" id="alamat_lengkap_siswa" name="alamat_lengkap_siswa" value="{{$get_data_siswa->alamat_lengkap_siswa}}" rows="2">{{$get_data_siswa->alamat_lengkap_siswa}}</textarea>
          </div>

          <div class="form-group">
            <label for="tinggal_bersama_siswa">Tinggal Bersama</label>
            <select class="form-control" name="tinggal_bersama_siswa" value="{{$get_data_siswa->tinggal_bersama_siswa}}" id="tinggal_bersama_siswa">
              @foreach ($pilihan_tinggal as $tinggal)
                  
              <option value="{{ $get_data_siswa->tinggal_bersama_siswa === $tinggal ? $get_data_siswa->tinggal_bersama_siswa: $tinggal}}" {{$get_data_siswa->tinggal_bersama_siswa === $tinggal ? 'selected':''}}>{{ $tinggal === 'orangtua'?'Tinggal bersama Orang tua':'Tinggal bersama Wali' }}</option>
              @endforeach

            </select>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="status_anak_ke">Anak Ke-</label>
              <select class="form-control" name="status_anak_ke" value="{{$get_data_siswa->status_anak_ke}}" id="status_anak_ke">
                @for($i=0;$i<8;$i++) <option value="{{$i+1}}">{{$i+1}}</option>
                  @endfor
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="usia_siswa">Usia Siswa</label>
              <select class="form-control" name="usia_siswa" value="{{$get_data_siswa->usia_siswa}}" id="usia_siswa">
                @for($i=0;$i<8;$i++) <option value="{{$i+1}}">{{$i+1}} Tahun</option>
                  @endfor
              </select>
            </div>

            <div class="form-group col-md-4">
              <label for="no_hp">No Hp</label>
              <input type="number" class="form-control" value="{{$get_data_siswa->no_hp}}" id="no_hp" name="no_hp">
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Kirim</button>
          <a href="{{url('/identitas_siswa')}}" class="btn btn-primary">Kembali</a>

        </form>
      </div>
    </div>



  </div>
</div>














@endsection