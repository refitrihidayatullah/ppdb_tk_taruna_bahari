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
                <h6 class="m-0 font-weight-bold text-primary">Periodik Siswa</h6>
            </div>
            <div class="card-body">
                <form action="{{url('/store_periodik')}}" method="POST">
                  @csrf
                  <p style="font-size: 12px" class="text-danger mb-1">note: tanda * wajib diisi</p>
                 
         
                    <div class="form-row">
   
                 
                    <div class="form-group col-md-6">
                      <label for="tinggi_badan_siswa">Tinggi Badan Siswa(cm)*</label>
                      <input type="number" class="form-control @error('tinggi_badan_siswa') is-invalid @enderror" name="tinggi_badan_siswa" id="tinggi_badan_siswa"  placeholder="masukkan tinggi siswa">
                      @error('tinggi_badan_siswa')
                      <div class="alert alert-danger" role="alert">
                          {{ $message}}
                      </div>
                         @enderror
                    </div>

                    <div class="form-group col-md-6">
                      <label for="">Berat Badan Siswa(kg)*</label>
                      <input type="number" class="form-control @error('berat_badan_siswa') is-invalid @enderror" name="berat_badan_siswa" id="berat_badan_siswa"  placeholder="masukkan berat badan siswa">
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
                          <option value="{{$jarak}}">{{$jarak}}</option>
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
                          <option value="{{$i+1}}">{{$i+1}} saudara</option>
                          @endfor
                      
                        </select>
                        @error('jumlah_saudara_siswa')
                        <div class="alert alert-danger" role="alert">
                            {{ $message}}
                        </div>
                           @enderror
                        </div>
                    </div>
             
             
                    
                        <button type="submit" class="btn btn-primary">Kirim</button>  
                        <a href="{{url('/identitas_ortu')}}" class="btn btn-primary">Back</a>  
                        <a href="{{url('/periodik_siswa')}}" class="btn btn-primary">Next</a>
             
                        
                      


              
                    
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
            <h6 class="m-0 font-weight-bold text-primary">Periodik Siswa</h6>
          </div>
          <div class="card-body">
            
            <table id="table" class="display " style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Siswa</th>
                  <th>Tinggi Badan</th>
                  <th>Berat Badan</th>
                  <th>Jarak Tempuh</th>
                  <th>Jumlah Saudara</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach ( $periodik_siswa as $siswa)
                  
              <tr>
                <td>{{$loop->iteration ??''}}</td>
                <td>{{$siswa->nama_lengkap_siswa ?? ''}}</td>
                <td>{{$siswa->tinggi_badan_siswa.'cm'  ?? ''}}</td>
                <td>{{$siswa->berat_badan_siswa .'kg'?? ''}}</td>
                <td>{{$siswa->jarak_tempuh_siswa ?? ''}}</td>
                <td>{{$siswa->jumlah_saudara_siswa.' saudara' ?? ''}}</td>
              
             
                  <td>
                    <div class="d-flex justify-content-around">
                      <a href="{{url("/periodik_siswa/edit")}}">
                        <span class="icon text-dark-50">
                          <i class="fas fa-pen"></i>
                        </span>
                      </a>
                      
                      <a href="#" data-toggle="modal" data-target="#delete_periodik_siswa_Modal">
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
 <div class="modal fade" id="delete_periodik_siswa_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus periodik siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{url("identitas_priodik/")}}" method="POST">
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