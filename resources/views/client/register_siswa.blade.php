@extends('layout.main')
@section('title','Register Siswa')
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
                <h6 class="m-0 font-weight-bold text-primary">Register Siswa</h6>
            </div>
            <div class="card-body">
                <form action="{{url('/store_registerSiswa')}}" method="POST">
                  @csrf
                  <p style="font-size: 12px" class="text-danger mb-1">note: tanda * wajib diisi</p>
                 
         
                    <div class="form-row">
                      @php
                          use Carbon\Carbon;
                      @endphp
                 
                    <div class="form-group col-md-2">
                      <label for="tanggal_pendaftaran_siswa">Tanggal Pendaftaran: </label>
                      <span class="badge badge-pill badge-success">{{Carbon::now()->translatedFormat('d F Y')}}</span>
                      <input type="hidden" class="form-control @error('tanggal_pendaftaran_siswa') is-invalid @enderror" value="{{Carbon::now()->format('Y-m-d H:i:s')}}" name="tanggal_pendaftaran_siswa" id="tanggal_pendaftaran_siswa"  placeholder="masukkan tinggi siswa">
                      @error('tanggal_pendaftaran_siswa')
                      <div class="alert alert-danger" role="alert">
                          {{ $message}}
                      </div>
                         @enderror
                    </div>

                    <div class="form-group col-md-5">
                      <label for="masuk_rombel_siswa">Masuk Rombel*</label>
                      <select class="form-control" name="masuk_rombel_siswa" id="masuk_rombel_siswa">
                        @foreach ($pilihan_rombel as $rombel)
                            
                        <option value="{{$rombel}}">{{$rombel}}</option>
                        @endforeach
                      
                      </select>
                      @error('masuk_rombel_siswa')
                      <div class="alert alert-danger" role="alert">
                          {{ $message}}
                      </div>
                         @enderror
                      </div>

                    <div class="form-group col-md-5">
                      <label for="jenis_pendaftaran">Jenis Pendaftaran Siswa*</label>
                      <select class="form-control" name="jenis_pendaftaran" id="jenis_pendaftaran">
                        @foreach ($pilihan_pendaftaran as $pendaftaran)
                            
                        <option value="{{$pendaftaran}}">{{$pendaftaran}}</option>
                        @endforeach
                       
                      </select>
                      @error('jenis_pendaftaran')
                      <div class="alert alert-danger" role="alert">
                          {{ $message}}
                      </div>
                         @enderror
                      </div>


 
                    </div>

                    @if ($count_register < 1)
                    <button type="submit" class="btn btn-primary">Kirim</button>  
                    <a href="{{url('/periodik_siswa')}}" class="btn btn-primary">Kembali</a>
                    
                    @else
                    <a href="{{url('/dashboard')}}" class="btn btn-success">Selesai</a>
                        
                    @endif


             
                    
                          
             

                        
                      


              
                    
                  </form> 
            </div>
        </div>


    </div>
    </div>


    <div class="row">
      <!-- Content Column -->
      <div class="col-lg-12 mb-4">
        <!-- Approach -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Register Siswa</h6>
          </div>
          <div class="card-body">
            
            <table id="table" class="display " style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Siswa</th>
                  <th>Tanggal Pendaftaran</th>
                  <th>Masuk Rombel</th>
                  <th>Jenis Pendaftaran</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                 @foreach ($register_siswa as $register)
                     
                 <tr>
                   <td>{{$loop->iteration}}</td>
                   <td>{{$register->id_register_siswa === null ? '':$register->nama_lengkap_siswa}}</td>
                   <td>{{$register->tanggal_pendaftaran_siswa === null ?'':$register->tanggal_pendaftaran_siswa}}</td>
                   <td>{{$register->masuk_rombel_siswa === null ? '':$register->masuk_rombel_siswa}}</td>
                   @if ($register->jenis_pendaftaran === null)
                       <td></td>
                   @else
                  <td><span class="badge badge-pill badge-success">{{$register->jenis_pendaftaran}}</span></td>
                   @endif
                   
                   @if (is_null($count_register))
                   <td></td>
                   @else
                   <td>
                     <div class="d-flex justify-content-around">
                       <a href="{{url("/register_siswa/".$register->id_register_siswa."/edit")}}">
                        <span class="icon text-dark-50">
                          <i class="fas fa-pen"></i>
                        </span>
                      </a>
                      
                      <a href="#" data-toggle="modal" data-target="#delete_register_siswa_Modal{{$register->id_register_siswa}}">
                        <span class="icon text-dark-50">
                          <i class="fas fa-trash"></i>
                        </span>
                      </a>
                    </div>
                  </td>
                  @endif
                  
                  
                </tr>
                @endforeach 
                
                
                
                
                
              </tbody>
            </table>
            
            
            
    
    
          </div>
        </div>
    
    
      </div>
    </div>

    

 <!-- Modal delete identitas siswa -->
 @foreach ($register_siswa as $register)
 <div class="modal fade" id="delete_register_siswa_Modal{{$register->id_register_siswa}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus register siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{url("register_siswa/".$register->id_register_siswa)}}" method="POST">
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