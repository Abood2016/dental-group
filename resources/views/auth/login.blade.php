<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend-assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('backend-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend-assets/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
    .input{
        border-right: 1px solid #404142 !important
    }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html">سجل الدخول</a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">هيا نبدآ هذه الجلسة</p>
                @if($errors->any())
                <div class="alert alert-danger" style="">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li style="">{{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(Session::has('error'))
                <div class="row mr-2 ml-2">
                    <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                        id="type-error">{{Session::get('error')}}
                    </button>
                </div>
                @endif

                <form action="{{ route('login.store') }}" method="post">
                    @csrf
                    <div class="input-group mb-3 " >
                       
                        <input type="email" name="email"  class="form-control input" placeholder="البريد الإلكتروني">
                        <div class="input-group-append">
                         
                        </div>
                        <div>
                        </div>
                    </div>


                    <div class="input-group mb-3 ">
                        <input type="password" name="password" class="form-control input" placeholder="كلمة المرور">
                        <div class="input-group-append">
                            
                        </div>
                    </div>
                    <div class="row">
                      
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">دخول</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
{{-- 
                <p class="mb-1">
                    <a href="{{ route('password.request') }}">I forgot my password</a>
                </p> --}}

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('backend-assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend-assets/dist/js/adminlte.min.js') }}"></script>

</body>

</html>