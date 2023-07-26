@extends('layout.main')
@section('title','Identitas Orang Tua/ Wali')
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
                <h6 class="m-0 font-weight-bold text-primary">Identitas Orang tua/Wali</h6>
            </div>
            <div class="card-body">
                <form action="{{url('/store_orangtua')}}" method="POST">
                  @csrf
                  <p style="font-size: 12px" class="text-danger mb-1">note: tanda * wajib diisi</p>
                  <p style="font-size: 12px" class="text-danger mb-1">Silahkan isi data ayah & ibu</p>
                  <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0 ">Pilih Data Diri Orang Tua:*</legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="status_orangtua" value="1" id="gridRadios1" value="option1" {{$cek_ortu1 == 1 ?'disabled':''}}>
                          <label class="form-check-label" for="gridRadios1">
                            Data Diri Ayah
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="status_orangtua" value="2" id="gridRadios2" value="option2"{{$cek_ortu1 == 0 || $cek_ortu2->nama_orangtua_dua != null ?'disabled':''}}>
                          <label class="form-check-label" for="gridRadios2">
                            Data Diri Ibu
                          </label>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                 
                    <div class="form-group">
                      <label for="nama_orangtua">Nama Lengkap Ayah/Ibu*</label>
                      <input type="text" class="form-control @error('nama_orangtua') is-invalid @enderror" name="nama_orangtua" id="nama_orangtua"  placeholder="masukkan nama orang tua siswa">
                      @error('nama_orangtua')
                      <div class="alert alert-danger" role="alert">
                          {{ $message}}
                      </div>
                         @enderror
                    </div>

                    <div class="form-group">
                      <label for="nik_siswa">Nik*</label>
                      <input type="text" class="form-control @error('nik_orangtua') is-invalid @enderror" name="nik_orangtua" id="nik_orangtua"  placeholder="masukkan nik orang tua">
                      @error('nik_orangtua')
                      <div class="alert alert-danger" role="alert">
                          {{ $message}}
                      </div>
                         @enderror
                    </div>

                    <div class="form-row">
                        
                        <div class="form-group col-md-4">
                          <label for="tanggal_lahir_orangtua">Tanggal Lahir*</label>
                          <input type="date" class="form-control @error('tanggal_lahir_orangtua') is-invalid @enderror" name="tanggal_lahir_orangtua" id="tanggal_lahir_siswa">
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
                          <option value="{{$pendidikan}}">{{ $pendidikan }}</option>
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
                            <option value="{{ $pekerjaan }}">{{ $pekerjaan }}</option>
                            @endforeach
                      
                            
                          </select>
                          @error('pekerjaan_orangtua')
                          <div class="alert alert-danger" role="alert">
                              {{ $message}}
                          </div>
                             @enderror
                        </div>
                    </div>
             
             
                        @if($count_ortu == null || $cek_ortu2->nama_orangtua_dua == null )
                        <button type="submit" class="btn btn-primary">Kirim</button>  
                        <a href="{{url('/identitas_siswa')}}" class="btn btn-primary">Kembali</a>
                        @else
                        <a href="{{url('/identitas_siswa')}}" class="btn btn-primary">Kembali</a> 
                        <a href="{{url('/periodik_siswa')}}" class="btn btn-primary">Next</a>
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
            <h6 class="m-0 font-weight-bold text-primary">Identitas Orangtua</h6>
          </div>
          <div class="card-body">
            
            <table id="table" class="display " style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Siswa</th>
                  <th>Nama Ayah</th>
                  <th>Nama Ibu</th>
                  <th>Pendidikan Ayah</th>
                  <th>Pendidikan Ibu</th>
                  <th>Pekerjaan Ayah</th>
                  <th>Pekerjaan Ibu</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                
                @foreach ($identitas_ortu as $ortu)
                <tr>
                  <td>{{$ortu->id_identitas_orangtua == null ? '': $loop->iteration}}</td>
                  <td>{{  $ortu->id_identitas_orangtua == null ?'': $ortu->nama_lengkap_siswa  }}</td>
                  <td>{{$ortu->nama_orangtua ?? ''}} 
                      <span class="badge badge-pill badge-primary">{{ $ortu->status_orangtua ==='1' ? 'Ayah': '' }}</span>
                  </td>
                  <td>{{$ortu->nama_orangtua_dua ?? ''}} 
                    <span class="badge badge-pill badge-warning">{{ $ortu->status_orangtua_dua ==='2' ? 'Ibu': '' }}</span>
                </td>
           
                  <td>{{  $ortu->pendidikan_orangtua ?? '' }}</td>
                  <td>{{  $ortu->pendidikan_orangtua_dua ?? '' }}</td>
                  <td>{{ $ortu->pekerjaan_orangtua ?? '' }}</td>
                  <td>{{ $ortu->pekerjaan_orangtua_dua ?? '' }}</td>
                  @if (is_null($ortu->id_identitas_orangtua))
                    <td></td>  
                  @else    
                  <td>
                    <div class="d-flex justify-content-around">
                      <a href="{{url("/identitas_ortu/".$ortu->id_identitas_orangtua."/edit")}}">
                        <span class="icon text-dark-50">
                          <i class="fas fa-pen"></i>
                        </span>
                      </a>
                      
                      <a href="#" data-toggle="modal" data-target="#delete_identitas_ortu_Modal{{$ortu->id_identitas_orangtua}}">
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

    
    @foreach ($identitas_ortu as $ortu)
@if (is_null($ortu->id_identitas_orangtua))

@else
 <!-- Modal delete identitas siswa -->
 <div class="modal fade" id="delete_identitas_ortu_Modal{{ $ortu->id_identitas_orangtua }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus identitas ortu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{url("identitas_ortu/".$ortu->id_identitas_orangtua)}}" method="POST">
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
@endforeach

@endsection