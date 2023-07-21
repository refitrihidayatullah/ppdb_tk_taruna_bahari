@extends('layout.main')
@section('title','Identitas Siswa')
@section('content')

<div class="row">
  <!-- Content Column -->
  <div class="col-lg-12 mb-4">
    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Identitas Ortu</h6>
      </div>
      <div class="card-body">
        <form action="{{url("/identitas_ortu/".$get_data_ortu->id_identitas_orangtua)}}" method="POST">
          @csrf
          @method('PUT')
          <p style="font-size: 12px" class="text-danger mb-1">note: tanda * wajib diisi</p>
          <p style="font-size: 12px" class="text-danger mb-1">Silahkan isi data ayah & ibu, atau dapat mengisi data wali</p>
          <fieldset class="form-group">
            <div class="row">
              <legend class="col-form-label col-sm-2 pt-0 ">Pilih Data Diri Orang Tua:*</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status_orangtua" value="1" id="gridRadios1" value="option1"{{$get_data_ortu->status_orangtua === '1' ? 'checked':''}}>
                  <label class="form-check-label" for="gridRadios1">
                    Data Diri Ayah
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status_orangtua" value="2" id="gridRadios2" value="option2" {{$get_data_ortu->status_orangtua === '2' ? 'checked':''}}>
                  <label class="form-check-label" for="gridRadios2">
                    Data Diri Ibu
                  </label>
                </div>
                <div class="form-check disabled">
                  <input class="form-check-input" type="radio" name="status_orangtua" value="3" id="gridRadios3" value="option3"{{$get_data_ortu->status_orangtua === '3' ? 'checked':''}} >
                  <label class="form-check-label" for="gridRadios3">
                    Data Diri Wali
                  </label>
                </div>
              </div>
            </div>
          </fieldset>
         
            <div class="form-group">
              <label for="nama_orangtua">Nama Lengkap Ayah/Ibu/Wali*</label>
              <input type="text" class="form-control @error('nama_orangtua') is-invalid @enderror" name="nama_orangtua" value="{{$get_data_ortu->nama_orangtua}}" id="nama_orangtua"  placeholder="masukkan nama orang tua siswa">
              @error('nama_orangtua')
              <div class="alert alert-danger" role="alert">
                  {{ $message}}
              </div>
                 @enderror
            </div>

            <div class="form-group">
              <label for="nik_siswa">Nik*</label>
              <input type="text" class="form-control @error('nik_orangtua') is-invalid @enderror" name="nik_orangtua" value="{{$get_data_ortu->nik_orangtua}}" id="nik_orangtua"  placeholder="masukkan nik orang tua">
              @error('nik_orangtua')
              <div class="alert alert-danger" role="alert">
                  {{ $message}}
              </div>
                 @enderror
            </div>

            <div class="form-row">
                
                <div class="form-group col-md-4">
                  <label for="tanggal_lahir_orangtua">Tanggal Lahir*</label>
                  <input type="date" class="form-control @error('tanggal_lahir_orangtua') is-invalid @enderror" value="{{$get_data_ortu->tanggal_lahir_orangtua}}" name="tanggal_lahir_orangtua" id="tanggal_lahir_siswa">
                  @error('tanggal_lahir_orangtua')
                  <div class="alert alert-danger" role="alert">
                      {{ $message}}
                  </div>
                  @enderror
                </div>
                <div class="form-group col-md-4">
                <label for="pendidikan_orangtua">Pendidikan Terakhir*</label>
                <select class="form-control" name="pendidikan_orangtua" id="pendidikan_orangtua">
                  @foreach ($pilihan_pendidikan as $pendidikan)
                  <option value="{{$get_data_ortu->pendidikan_orangtua === $pendidikan ? $get_data_ortu->pendidikan_orangtua : $pendidikan }}" {{$get_data_ortu->pendidikan_orangtua === $pendidikan ? 'selected':''}}       
                    >
                    {{$pendidikan}}
                  </option>
                      
                  @endforeach
                  
                </select>
                @error('pendidikan_orangtua')
                <div class="alert alert-danger" role="alert">
                    {{ $message}}
                </div>
                   @enderror
                </div>
                <div class="form-group col-md-4">
                  <label for="pekerjaan_orangtua">Pekerjaan*</label>
                  <select class="form-control" name="pekerjaan_orangtua" id="pekerjaan_orangtua">
                    @foreach ($pilihan_pekerjaan as $pekerjaan)
                        
                    <option value="{{$get_data_ortu->pekerjaan_orangtua === $pekerjaan ? $get_data_ortu->pekerjaan_orangtua : $pekerjaan}}" {{$get_data_ortu->pekerjaan_orangtua === $pekerjaan ? 'selected':''}}>{{$pekerjaan}}</option>
                    @endforeach

                    
                  </select>
                  @error('pekerjaan_orangtua')
                  <div class="alert alert-danger" role="alert">
                      {{ $message}}
                  </div>
                     @enderror
                </div>
            </div>
          <button type="submit" class="btn btn-primary">Kirim</button>
          <a href="{{url('/identitas_ortu')}}" class="btn btn-primary">Kembali</a>

        </form>
      </div>
    </div>



  </div>
</div>














@endsection