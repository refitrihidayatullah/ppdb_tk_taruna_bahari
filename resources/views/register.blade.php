<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tk Taruna Bahari - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center ">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img style="max-width: 550px" src="{{asset('assets/img/foto_content2.png')}}" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4 w-2">Register</h1>
                                    </div>

                                @if (session('success'))
                                    <p class="alert alert-success">{{session('success')}}</p>
                                @endif
                                @if(session('password'))
                                <p class="alert alert-danger">{{session('password')}}</p>
                              @endif
                                @if($errors->any())
                                @foreach ($errors->all() as $err)
                                    <p class="alert alert-warning">{{$err}}</p>
                                @endforeach
                                    
                                @endif
                                    <form class="user" action="{{url('store_register')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="name" name="name" value="{{old('name')}}"
                                                placeholder="Enter name">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" name="email" value="{{old('email')}}"
                                                placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" value="{{old('password')}}" class="form-control form-control-user"
                                                id="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password1" value="{{old('password1')}}" class="form-control form-control-user"
                                                id="password" placeholder="Confirm Password">
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-center align-items-center">
                                        {{-- <button class="align-self-center btn btn-primary" type="submit">Masuk</button> --}}
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Register
                                        </button>
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="{{url('/')}}">Sudah punya akun?</a>
                                        </div>
                                    </form>
                                   
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>

</body>

</html>