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
                <h6 class="m-0 font-weight-bold text-primary">Edit Register Siswa</h6>
            </div>
            <div class="card-body">
                <form action="{{url("/register_siswa/".$register_siswa->id_register_siswa)}}" method="POST">
                  @csrf
                  @method('PUT')
                  <p style="font-size: 12px" class="text-danger mb-1">note: tanda * wajib diisi</p>
                 
         
                    <div class="form-row">

                    <div class="form-group col-md-6">
                      <label for="masuk_rombel_siswa">Masuk Rombel*</label>
                      <select class="form-control" name="masuk_rombel_siswa" id="masuk_rombel_siswa">
                        @foreach ($pilihan_rombel as $rombel)
                            
                        <option value="{{$register_siswa->masuk_rombel_siswa === $rombel ? $register_siswa->masuk_rombel_siswa :$rombel}}"{{ $register_siswa->masuk_rombel_siswa === $rombel ? 'selected':''}}>{{$rombel}}</option>
                        @endforeach
                      
                      </select>
                      @error('masuk_rombel_siswa')
                      <div class="alert alert-danger" role="alert">
                          {{ $message}}
                      </div>
                         @enderror
                      </div>

                    <div class="form-group col-md-6">
                      <label for="jenis_pendaftaran">Jenis Pendaftaran Siswa*</label>
                      <select class="form-control" name="jenis_pendaftaran" id="jenis_pendaftaran">
                        @foreach ($register_pendaftaran as $register)
                            
                        <option value="{{$register_siswa->jenis_pendaftaran === $register ?$register_siswa->jenis_pendaftaran : $register}}" {{$register_siswa->jenis_pendaftaran === $register ? 'selected':''}}>{{$register}}</option>
                        @endforeach
                       
                      </select>
                      @error('jenis_pendaftaran')
                      <div class="alert alert-danger" role="alert">
                          {{ $message}}
                      </div>
                         @enderror
                      </div>


 
                    </div>

         

                      <button type="submit" class="btn btn-primary">Update</button>  
                        <a href="{{url('/register_siswa')}}" class="btn btn-primary">Kembali</a>
                    

             
                    
                          
             
                        
                      


              
                    
                  </form> 
            </div>
        </div>


    </div>
    </div>


   
    





@endsection