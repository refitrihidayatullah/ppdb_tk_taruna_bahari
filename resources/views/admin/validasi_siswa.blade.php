@extends('layout.main')
@section('title','Data Registrasi Siswa')
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
            <h6 class="m-0 font-weight-bold text-primary">Data Registrasi Siswa</h6>
          </div>
          <div>

            <a href="{{url('/siswa_export')}}" class="btn-primary btn-sm">Excel</a>
            <a href="{{url('/siswa_export_csv')}}" class="btn-primary btn-sm">CSV</a>
            <a href="{{url('/siswa_export_pdf')}}" class="btn-primary btn-sm">PDF</a>
          </div>
          <div class="card-body">
            
            <table id="table" class="display " style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Siswa</th>
                  <th>Gender</th>
                  <th>Tgl Lahir</th>
                  <th>Nama Ayah</th>
                  <th>Nama Ibu</th>
                  <th>No hp</th>
                  <th>Jenis Pendaftaran</th>
                  <th>masuk rombel</th>
                  <th>validasi</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ( $get_data_registrasi as $register)
                    
                <td>{{$loop->iteration}}</td>
                <td>{{$register->nama_lengkap_siswa}}</td>
                <td>{{$register->jenis_kelamin_siswa }}</td>
                <td>{{$register->tanggal_lahir_siswa}}</td>
               <td>{{$register->nama_orangtua}}</td>
               <td>{{$register->nama_orangtua_dua}}</td>
               <td>{{$register->no_hp}}</td>
               <td>{{$register->jenis_pendaftaran}}</td>
               <td>{{$register->masuk_rombel_siswa}}</td>
               @if ($register->is_active == 1)
                   <td>
                    <span class="badge badge-pill badge-success">Validate Complete!</span>
                   </td>
               @else
                   <td>
                    <span class="badge badge-pill badge-warning">Not Validate</span>
                   </td>
               @endif
               <td>
                   <div class="d-flex justify-content-around">
                    <a href="#" data-toggle="modal" data-target="#edit_validasi_Modal{{$register->id_identitas_siswa}}">
                      <span class="icon text-dark-50">
                          <i class="fas fa-pen"></i>
                      </span>
                  </a>
                    
                    <a href="#" data-toggle="modal" data-target="#delete_validasi_Modal{{$register->id_identitas_siswa}}">
                        <span class="icon text-dark-50">
                            <i class="fas fa-trash"></i>
                        </span>
                    </a>
                    <a href="{{url("/siswa_pdf/".$register->id_identitas_siswa)}}" class="btn-primary btn-sm">Cetak</a>
                </div>
            </td>
            
        </tr>
        @endforeach
        
                
                
    
              </tbody>
            </table>
    
    
    
    
    
          </div>
        </div>
    
    
      </div>
    </div>

 <!-- Modal Validasi siswa -->
 @foreach ( $get_data_registrasi as $register)
 <div class="modal fade" id="edit_validasi_Modal{{$register->id_identitas_siswa}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Validasi Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url("validasi_siswa/".$register->id_identitas_siswa)}}" method="POST">
          @csrf
          @method('PUT')
          <label for="">current status: @if ($register->is_active == 0)
            <span class="badge badge-warning">not validate</span>
          @else
          <span class="badge badge-success">validate</span>
          @endif</label>
        <div class="form-check form-check-inline ml-3">
          <input class="form-check-input" type="radio" value="0" value="{{$register->is_active == 0 ? $register->is_active:1}}" name="not_active" id="inlineRadio1" value="option1">
          <label class="form-check-label" for="inlineRadio1">Not Validate</label>
          <input class="form-check-input ml-3" type="radio" value="1" value="{{$register->is_active == 1 ? 1:0}}"  name="is_active" id="inlineRadio1" value="option1">
          <label class="form-check-label " for="inlineRadio1">Validate Now</label>
        </div>
        <div class="d-flex flex-row-reverse">
          <button type="button" class="btn btn-secondary ml-3" data-dismiss="modal">Tidak</button>
              <button type="submit" name="submit" class="btn btn-primary">Update</button>
          </div>
      </form>





      </div>
    </div>
  </div>
</div>
@endforeach

    

 <!-- Modal delete identitas siswa -->
 @foreach ( $get_data_registrasi as $register)
 <div class="modal fade" id="delete_validasi_Modal{{$register->id_identitas_siswa}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus data siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{url("validasi_siswa/".$register->id_identitas_siswa)}}" method="POST">
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
@endforeach



@endsection