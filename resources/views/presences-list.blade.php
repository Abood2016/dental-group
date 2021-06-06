<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/index.css')}}">

    <title>سجل الحضور</title>
    <style>


    </style>
</head>

<body>
    <!-- Image and text -->
    <header>
        <nav class="navbar navbar-light" style="background-color: black;">
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{asset('assets/images/logo.jpeg')}}" width="150" height="50" class="d-inline-block align-top"
                    alt="">
            </a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link text-white font-weight-bold" href="{{route('employee.index')}}">اضافة موظف <span
                            class="sr-only">(current)</span></a>
                </li>

            </ul>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="btn btn-sm btn-danger"><i class="fa fa-logout"></i>سجل خروج
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </a>
        </nav>
    </header>
    <main class="mt-4">

        <div class="container mt-4">
            <div class="form-group col-sm-6 row ">
                <label for="" class="col-sm-12 row" style="margin-right: 0.01em">
                    <span class="mr-1">
                        ابحث عن موظف
                    </span>
                    <form class="col-sm-12 row mt-2" action="" method="GET">
                        <div class="form-group col-sm-12 row">
                        <input name="employee_id" class="form-control col-sm-12 mt-2" type="text"
                            value="{{app('request')->get('employee_id')}}" placeholder="ادخل رقم الموظف">
                        </div>
                        <div>
                            <input type="submit" class="btn btn-success" value="بحث عن موظف">
                            <a type="submit" href="{{route('presences.index')}}"  class="btn btn-danger ">إلغاء</a>
                        </div>
                    </form>
                </label>
            </div>


            <div class="col-sm-12 d-flex text-right"><h4>سجل حضور الموظفين</h4></div>
            <div class="row justify-content-around">
                <div class="col-sm-12 mr-3 border table-box">
                    <table class="table table-striped" id="emp_table">
                        <thead>
                            <tr>
                                <th class="text-right" scope="col">#</th>
                                <th class="text-right" scope="col">الرقم الوظيفي</th>
                                <th class="text-right" scope="col">الحالة</th>
                                <th class="text-right" scope="col">تاريخ التسجيل</th>
                                <th class="text-right" scope="col">الصورة</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($presences as $row)

                            <tr>
                                <th class="text-right" scope="row">{{$loop->iteration}}</th>
                                <th class="text-right" scope="row">{{$row->employee_id}}</th>
                                <th class="text-right" scope="row">{{$row->status}}</th>
                                <td class="text-right">{{ $row->created_at->format('y-m-d') }}</td>

                                <th class="text-right" scope="row">
                                    @if ($row->status == 'C/In')
                                    <span class="badge badge-success">تسجيل دخول</span>
                                    @else
                                    <span class="badge badge-primary">تسجيل خروج</span>
                                    @endif
                                </th>
                                <td class="text-right">{{ $row->created_at->format('y-m-d') }}
                                <td>

                                <td class="text-right">
                                    <a href="{{asset('storage/').'/' .$row->image}}" target="_blank"><img width="130px"
                                            style="border-radius: 30px" src="{{ asset('storage/' . $row->image) }}">
                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="col-sm-12  d-flex justify-content-center">

                        {{ $presences->links() }}
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script src="{{asset('assets/js/webcam.min.js')}}"></script>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert.js')}}"></script>
    <script>
        $(document).ready(function (){
          $(document).on('click','.btn_submit',function (event){
            var form_id = document.getElementById('form_submit');
            var form_data = new FormData(form_id);


        })
    });

    </script>

</body>

</html>
