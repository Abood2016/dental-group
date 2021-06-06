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

    <title>تــسـجـيـل مـوظـف جـديـد</title>
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
                    <a class="nav-link text-white font-weight-bold" href="{{route('presences.index')}}">سجل الحضور <span class="sr-only">(current)</span></a>
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
            <form action="" id="branch_form_submit">
                @csrf
                <div class="form-group col-sm-8 row">
                    <label for="" class=" d-flex flex-row col-sm-12" style="margin-right: 0.01em">
                        <p class="mr-1 col-sm-1 pl-3 text-right">
                            الفرع:
                        </p>
                        <select name="branch_id" id="" class="col-sm-6  form-control mr-2">
                                <option selected disabled >اختيار الفرع</option>
                            @foreach($branches as $item)

                            <option {{auth()->user()->branch_id== $item->id?"selected":""}} value="{{$item->id}}">{{$item->branchName}}</option>
                            @endforeach
                        </select>
                        <div class="col-sm-2 text-right">
                            <button type="button" class="btn btn-primary branch_btn_submit">أختيار</button>
                        </div>
                    </label>

                </div>
            </form>
            <div class="row justify-content-around">
                <div class="col-sm-5 row mr-3 ml-1 border" style="">
                    <form action="" class="col-sm-12 row mt-3" id="form_submit">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group col-sm-12 row ">
                            <label for="" class="col-sm-12 row" style="margin-right: 0.01em">
                                <span class="mr-1">
                                    :الرقم الوظيفي
                                </span>
                                <input name="EMP_ID" class="form-control col-sm-12 mt-2" type="text"
                                    placeholder="ادخل رقم الموظف">
                            </label>
                        </div>
                        <div class="form-group col-sm-12 row">
                            <label for="" class="col-sm-12 row" style="margin-right: 0.01em">
                                <span class="mr-1">
                                    إسم الموظف
                                </span>
                                <input name="EMP_NAME" class="form-control col-sm-12 mt-2" type="text"
                                    placeholder="ادخل إسم الموظف">
                            </label>
                        </div>
                        <div class="form-group row col-sm-12">

                            <div class="row w-100 justify-content-center">
                                <div>
                                    <button type="button" class="btn btn-primary btn_submit">تسجيل</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-sm-6 mr-3 border table-box" style="overflow-y:scroll ;height:50vh!important;">
                    <table class="table table-striped" id="emp_table">
                        <thead>
                            <tr>
                                <th class="text-right" scope="col">#</th>
                                <th class="text-right" scope="col">الرقم الوظيفي</th>
                                <th class="text-right" scope="col">الإسم</th>
                                <th class="text-right" scope="col">تاريخ التسجيل</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $emp)

                            <tr>
                                <th class="text-right" scope="row">{{$loop->iteration}}</th>
                                <th class="text-right" scope="row">{{$emp->EMP_ID}}</th>
                                <td class="text-right">{{ $emp->EMP_NAME}}
                                <td class="text-right">{{ $emp->created_at->format('y-m-d') }}
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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

            $.ajax({
                url:"/dashboard/employee-store",
                method:"post",
                data:form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function (response){
                    if (response.status == 504){
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            text: response.error,
                            confirmButtonText:"حسناً"
                        })
                    }
                    else if (response.status ==200) {

                        Swal.fire({
                            icon: 'success',
                            title: 'تم',
                            text: response.success,
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })


                        setTimeout(function (){
                            $("#form_submit").trigger('reset');
                            },5000)
                        $.ajax({
                            url:"/dashboard/employee",
                            method:'get',
                            data:{"_token":'{{csrf_token()}}'},
                            success:function (response){
                            $('.table-box').html="";
                            $('.table-box').html(response)
                            }
                        })
                    }
                }
            })
        })
        $('#form_submit').keypress(function (e) {
            if (e.which == 13) {
                $('.btn_submit').trigger('click');
                return false;    //<---- Add this line
            }
        });
    });


    $(document).ready(function (){
          $(document).on('click','.branch_btn_submit',function (event){
            var form_id = document.getElementById('branch_form_submit');
            var form_data = new FormData(form_id);

            $.ajax({
                url:"/dashboard/branch-store",
                method:"post",
                data:form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function (response){
                    if (response.status == 504){
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            text: response.error,
                            confirmButtonText:"حسناً"
                        })
                    }
                    else if (response.status == 200) {

                        Swal.fire({
                            icon: 'success',
                            title: 'تم',
                            text: response.success,
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })

                    }
                }
            });
        });
    });

    </script>

</body>

</html>
