@extends('layout.main')
@section('title','Periodik Siswa')
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
                <h6 class="m-0 font-weight-bold text-primary">Edit Periodik Siswa</h6>
            </div>
            <div class="card-body">
                <form action="{{url("/periodik_siswa/".$get_data_periodik->id_periodik_siswa)}}" method="POST">
                  @csrf
                  @method('PUT')
                  <p style="font-size: 12px" class="text-danger mb-1">note: tanda * wajib diisi</p>
                 
         
                    <div class="form-row">
   
                 
                    <div class="form-group col-md-6">
                      <label for="tinggi_badan_siswa">Tinggi Badan Siswa(cm)*</label>
                      <input type="number" class="form-control @error('tinggi_badan_siswa') is-invalid @enderror" value="{{$get_data_periodik->tinggi_badan_siswa}}" name="tinggi_badan_siswa" id="tinggi_badan_siswa"  placeholder="masukkan tinggi siswa">
                      @error('tinggi_badan_siswa')
                      <div class="alert alert-danger" role="alert">
                          {{ $message}}
                      </div>
                         @enderror
                    </div>

                    <div class="form-group col-md-6">
                      <label for="">Berat Badan Siswa(kg)*</label>
                      <input type="number" class="form-control @error('berat_badan_siswa') is-invalid @enderror" value="{{$get_data_periodik->berat_badan_siswa}}" name="berat_badan_siswa" id="berat_badan_siswa"  placeholder="masukkan berat badan siswa">
                      @error('berat_badan_siswa')
                      <div class="alert alert-danger" role="alert">
                          {{ $message}}
                      </div>
                         @enderror
                    </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="jarak_tempuh_siswa">Jarak Tempuh Siswa*</label>
                        <select class="form-control" name="jarak_tempuh_siswa" id="jarak_tempuh_siswa">
                          @foreach ($pilihan_jarak as $jarak)
                          <option value="{{$get_data_periodik->jarak_tempuh_siswa === $jarak ? $get_data_periodik->jarak_tempuh_siswa:$jarak}}"{{$get_data_periodik->jarak_tempuh_siswa === $jarak ? 'selected':''}}>{{$jarak}}</option>
                          @endforeach
                        </select>
                        @error('jarak_tempuh_siswa')
                        <div class="alert alert-danger" role="alert">
                            {{ $message}}
                        </div>
                           @enderror
                        </div>
                        <div class="form-group col-md-6">
                        <label for="jumlah_saudara_siswa">Jumlah Saudara Siswa*</label>
                        <select class="form-control" name="jumlah_saudara_siswa" id="jumlah_saudara_siswa">
                          @for ($i = 0; $i < 13; $i++)
                          <option value="{{$get_data_periodik->jumlah_saudara_siswa == $i+1 ? $get_data_periodik->jumlah_saudara_siswa : $i+1}}" {{$get_data_periodik->jumlah_saudara_siswa == $i+1 ? 'selected':''}}>{{$i+1}} saudara</option>
                          @endfor
                      
                        </select>
                        @error('jumlah_saudara_siswa')
                        <div class="alert alert-danger" role="alert">
                            {{ $message}}
                        </div>
                           @enderror
                        </div>
                    </div>
             
             
                    
                        <button type="submit" class="btn btn-primary">Update</button>  
                        <a href="{{url('/periodik_siswa')}}" class="btn btn-primary">Kembali</a>  
                       
             
                        
                      


              
                    
                  </form> 
            </div>
        </div>


    </div>
    </div>



    




@endsection