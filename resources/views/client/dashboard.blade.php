@extends('layout.main')
@section('title','Dashboard')
@section('content')

<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Selamat Datang!</strong> {{Auth::user()->name}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

<!-- Content Row -->
<div class="row">

    <!-- Content Column -->
    <div class="col-lg-12 mb-4">
        <!-- Approach -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Petunjuk Registrasi</h6>
            </div>
            <div class="card-body">
                <p>1. Silahkan Lakukan pengisian data identitas siswa pada menu identitas siswa. Setelah selesai maka klik button Next</p>
                <p>2. Silahkan Lakukan pengisian data identitas orang tua pada menu identitas orang tua. Setelah selesai maka klik button Next</p>
                <p>3. Silahkan Lakukan pengisian data periodik siswa pada menu periodik siswa. Setelah selesai maka klik button Next</p>
                <p>4. Silahkan Lakukan pengisian data register siswa pada menu register siswa. Setelah selesai maka klik button Kirim</p>
                <p>5. Tunggu status verifikasi dari Admin Tk Taruna Bahari. Anda bisa melihat bahwa verifikasi sudah di acc atau belum di menu dashboard status verifikasi</p>
            </div>
        </div>


    </div>

    <div class="col-lg-12 mb-4">
        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Status</h6>
            </div>
            <div class="card-body">
                <h4 class="small font-weight-bold">Pengisian identitas Siswa <span class="float-right">20%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Pengisisan identitas Orang Tua <span class="float-right">40%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Pengisian Periodik Siswa <span class="float-right">60%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Pengisisan Register Siswa <span class="float-right">80%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Status Verifikasi<span class="float-right">Complete!</span></h4>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>




    </div>
</div>



@endsection