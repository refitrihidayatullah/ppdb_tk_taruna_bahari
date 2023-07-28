@extends('layout.main')
@section('title','Identitas Siswa')
@section('content')
@if(Session::has('failed'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Failed!</strong> {{Session::get('failed')}}.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@elseif(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> {{Session::get('success')}}.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@else
@endif
<div class="row">
  <!-- Content Column -->
  <div class="col-lg-12 mb-4">
    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Identitas Siswa</h6>
      </div>
      <div class="card-body">
        <form action="{{url('/store_indentitas_siswa')}}" method="POST">
          @csrf
          <p style="font-size: 12px" class="text-danger mb-1">note: tanda * wajib diisi</p>
          <div class="form-group">
            <label for="nama_lengkap_siswa">Nama Lengkap Siswa*</label>
            <input type="text" class="form-control @error('nama_lengkap_siswa') is-invalid @enderror" name="nama_lengkap_siswa" id="nama_lengkap_siswa" value="{{old('nama_lengkap_siswa')}}" placeholder="masukkan nama lengkap siswa">
            @error('nama_lengkap_siswa')
            <div class="alert alert-danger" role="alert">
                {{ $message}}
            </div>
               @enderror
          </div>

          <div class="form-group">
            <label for="nik_siswa">Nik</label>
            <input type="text" class="form-control @error('nik_siswa') is-invalid @enderror" name="nik_siswa" id="nik_siswa" value="{{old('nik_siswa')}}" placeholder="masukkan nik siswa">
            @error('nik_siswa')
            <div class="alert alert-danger" role="alert">
                {{ $message}}
            </div>
               @enderror
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="jenis_kelamin_siswa">Jenis Kelamin*</label>
              <select class="form-control @error('jenis_kelamin_siswa') is-invalid @enderror" name="jenis_kelamin_siswa" value="{{old('jenis_kelamin_siswa')}}" id="jenis_kelamin_siswa">
                @foreach ($pilihan_jeniskelamin as $kelamin)
                <option value="{{$kelamin}}">{{$kelamin === 'L' ? 'Laki-Laki':'Perempuan'}}</option>
                @endforeach
              </select>
              @error('jenis_kelamin_siswa')
              <div class="alert alert-danger" role="alert">
                  {{ $message}}
              </div>
                 @enderror
            </div>
            <div class="form-group col-md-5">
              <label for="tempat_lahir_siswa">Tempat Lahir*</label>
              <input type="text" class="form-control @error('tempat_lahir_siswa') is-invalid @enderror" value="{{old('tempat_lahir_siswa')}}" id="tempat_lahir_siswa" name="tempat_lahir_siswa">
              @error('tempat_lahir_siswa')
              <div class="alert alert-danger" role="alert">
                  {{ $message}}
              </div>
                 @enderror
            </div>
            <div class="form-group col-md-3">
              <label for="tanggal_lahir_siswa">Tanggal Lahir*</label>
              <input type="date" class="form-control @error('tanggal_lahir_siswa') is-invalid @enderror" name="tanggal_lahir_siswa" value="{{old('tanggal_lahir_siswa')}}" id="tanggal_lahir_siswa">
              @error('tanggal_lahir_siswa')
              <div class="alert alert-danger" role="alert">
                  {{ $message}}
              </div>
                 @enderror
            </div>
          </div>
          <div class="form-group">
            <label for="alamat_siswa">Alamat Lengkap Siswa*</label>
            <textarea class="form-control @error('alamat_lengkap_siswa') is-invalid @enderror" id="alamat_lengkap_siswa" name="alamat_lengkap_siswa" value="{{old('alamat_lengkap_siswa')}}" rows="2"></textarea>
            @error('alamat_lengkap_siswa')
            <div class="alert alert-danger" role="alert">
                {{ $message}}
            </div>
               @enderror
          </div>

          <div class="form-group">
            <label for="tinggal_bersama_siswa">Tinggal Bersama*</label>
            <select class="form-control @error('tinggal_bersama_siswa') is-invalid @enderror" name="tinggal_bersama_siswa" value="{{old('tinggal_bersama_siswa')}}" id="tinggal_bersama_siswa">
              @foreach ($pilihan_tinggal as $tinggal)
              <option value="{{$tinggal}}">{{$tinggal === 'orangtua'?'Tinggal bersama Orang tua':'Tinggal bersama Wali'}}</option>
              @endforeach
            </select>
            @error('tinggal_bersama_siswa')
            <div class="alert alert-danger" role="alert">
                {{ $message}}
            </div>
               @enderror
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="status_anak_ke">Anak Ke-*</label>
              <select class="form-control @error('status_anak_ke') is-invalid @enderror" name="status_anak_ke" value="{{old('status_anak_ke')}}" id="status_anak_ke">
                @for($i=0;$i<8;$i++) <option value="{{$i+1}}">{{$i+1}}</option>
                  @endfor
              </select>
              @error('status_anak_ke')
              <div class="alert alert-danger" role="alert">
                  {{ $message}}
              </div>
                 @enderror
            </div>
            <div class="form-group col-md-4">
              <label for="usia_siswa">Usia Siswa*</label>
              <select class="form-control @error('usia_siswa') is-invalid @enderror" name="usia_siswa" value="{{old('usia_siswa')}}" id="usia_siswa">
                @for($i=0;$i<8;$i++) <option value="{{$i+1}}">{{$i+1}} Tahun</option>
                  @endfor
              </select>
              @error('usia_siswa')
              <div class="alert alert-danger" role="alert">
                  {{ $message}}
              </div>
                 @enderror
            </div>

            <div class="form-group col-md-4">
              <label for="no_hp">No Hp*</label>
              <input type="number" class="form-control @error('no_hp') is-invalid @enderror" value="{{old('no_hp')}}" id="no_hp" name="no_hp">
            </div>
            @error('no_hp')
            <div class="alert alert-danger" role="alert">
                {{ $message}}
            </div>
               @enderror
          </div>

          @if ($cek_siswa)    
          <a href="{{url('/identitas_ortu')}}" class="btn btn-primary">Next</a>
          @else
          <button type="submit" class="btn btn-primary">Kirim</button>  
          @endif
          

        </form>
      </div>
    </div>



  </div>
</div>





@php
    use Carbon\carbon;
@endphp


<div class="row">
  <!-- Content Column -->
  <div class="col-lg-12 mb-4">
    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Identitas Siswa</h6>
      </div>
      <div class="card-body">

        <table id="table" class="display " style="width:100%">
          <thead>
            <tr>
              <th>Nama Siswa</th>
              <th>Nik</th>
              <th>Jenis Kelamin</th>
              <th>Tempat / Tanggal Lahir</th>
              <th>Alamat</th>
              <th>Tinggal</th>
              <th>Anak Ke-</th>
              <th>Usia Siswa</th>
              <th>No Hp</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <tr>
              
              <td>{{$identitas_siswa->nama_lengkap_siswa ?? ''}}</td>
              <td>{{$identitas_siswa->nik_siswa ?? '' }}</td>
              <td>{{$identitas_siswa->jenis_kelamin_siswa ?? ''}}</td>
              <td>{{$identitas_siswa->tempat_lahir_siswa ?? ''}}  {{Carbon::parse($identitas_siswa->tanggal_lahir_siswa)->translatedFormat('d F Y') ??''}}</td>
              <td>{{$identitas_siswa->alamat_lengkap_siswa ?? ''}}</td>
              <td>{{$identitas_siswa->tinggal_bersama_siswa ?? ''}}</td>
              <td>{{$identitas_siswa->status_anak_ke ?? ''}}</td>
              <td>{{$identitas_siswa->usia_siswa??''}}</td>
              <td>{{$identitas_siswa->no_hp ?? ''}}</td>
            
                @if (is_null($identitas_siswa))
                  <td></td> 
                @else
                <td>
                  <div class="d-flex justify-content-around">
                <a href="{{url("/identitas_siswa/". $identitas_siswa->id_identitas_siswa ."/edit")}}">
                    <span class="icon text-dark-50"> 
                        <i class="fas fa-pen"></i>
                    </span>
                </a>
                
                <a href="#" data-toggle="modal" data-target="#delete_identitas_siswa_Modal{{$identitas_siswa->id_identitas_siswa}}">
                    <span class="icon text-dark-50">
                        <i class="fas fa-trash"></i>
                    </span>
                </a>
                  </div>
                </td>
                @endif

            </tr>



          </tbody>
        </table>





      </div>
    </div>


  </div>
</div>

@if (is_null($identitas_siswa))

@else
 <!-- Modal delete identitas siswa -->

 <div class="modal fade" id="delete_identitas_siswa_Modal{{ $identitas_siswa->id_identitas_siswa }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Misi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{url("identitas_siswa/".$identitas_siswa->id_identitas_siswa)}}" method="POST">
              @csrf
              @method('delete')
              <h5>Yakin Akan Menghapus Data?</h5>
              <div class="d-flex flex-row-reverse">
          <button type="button" class="btn btn-secondary ml-3" data-dismiss="modal">Tidak</button>
              <button type="submit" name="submit" class="btn btn-primary">Yakin</button>
          </div>
      </form>
      </div>
    </div>
  </div>
</div>

@endif

     


@endsection