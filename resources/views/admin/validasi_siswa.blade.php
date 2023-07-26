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
          <div class="card-body">
            
            <table id="table" class="display " style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Siswa</th>
                  <th>Gender</th>
                  <th>Tgl Lahir</th>
                  <th>Nama OrangTua/Wali</th>
                  <th>No hp</th>
                  <th>Jenis Pendaftaran</th>
                  <th>masuk rombel</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ( $get_data_registrasi as $register)
                    
                <td>{{$loop->iteration}}</td>
                <td>{{$register->nama_lengkap_siswa}}</td>
                <td></td>
                <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td>
                   <div class="d-flex justify-content-around">
                       <a href="{{url("/identitas_ortu/edit")}}">
                        <span class="icon text-dark-50">
                            <i class="fas fa-pen"></i>
                        </span>
                    </a>
                    
                    <a href="#" data-toggle="modal" data-target="#delete_identitas_ortu_Modal">
                        <span class="icon text-dark-50">
                            <i class="fas fa-trash"></i>
                        </span>
                    </a>
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

    

 <!-- Modal delete identitas siswa -->
 <div class="modal fade" id="delete_identitas_ortu_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus identitas ortu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{url("identitas_ortu")}}" method="POST">
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



@endsection