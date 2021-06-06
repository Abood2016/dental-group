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

    <title>Presences System</title>

</head>

<body>
    <!-- Image and text -->
    <header>
        <nav class="navbar navbar-light" style="background-color: black;">
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{asset('assets/images/logo.jpeg')}}" width="150" height="50" class="d-inline-block align-top"
                    alt="">
            </a>

        </nav>
    </header>
    <main>
        <div class="container" style="margin-top: 1em">
            <div class="row justify-content-center">
                <div id="MyClockDisplay" class="clock" onload="showTime()"></div>

            </div>
        </div>
        <div class="container" style="margin-top: 1em">
            <div class="row justify-content-center">
                <div id="myDay" class="clock" onload="showDate()"></div>
            </div>
        </div>
        <div class="container mt-3">
            <div class="row justify-content-around">
                <div class="col-sm-5 row mr-3 ml-1 border" style="">
                    <form action="" class="col-sm-12 row mt-3" id="form_submit" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group col-sm-12 row">
                            <label for="" class="col-sm-12 row" style="margin-right: 0.01em">
                                <span class="mr-1">
                                    الرقم الوظيفي :
                                </span>
                                <input name="employee_id" class="form-control col-sm-12 mt-2" type="text"
                                    placeholder="ادخل الرقم الوظيفي">
                            </label>
                        </div>
                        <div class="form-group row col-sm-12">
                            <div class=" col-sm-6 text-right">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    تسجيل دخول
                                </label>
                                <input class="form-check-input mr-1 mt-2" checked name="status" value="C/In"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </div>
                            <div class="col-sm-6 text-right">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    تسجيل خروج
                                </label>
                                <input class="form-check-input mr-1 mt-2" name="status" value="C/Out" type="radio"
                                    name="flexRadioDefault" id="flexRadioDefault2">
                            </div>


                            <div id="camera" style="display: none"></div>
                            <div id="result" style=""></div>


                        </div>
                        <div class="form-group col-sm-12 row">
                            <label for="" class="col-sm-12 row" style="margin-right: 0.01em">
                                <span class="mr-1">
                                    الفرع :
                                </span>
                                <select name="branch_id" id="" class="form-control">
                                    @foreach($branches as $item)
                                    <option {{$user_id== $item->id?"selected":""}} value="{{$item->id}}">
                                        {{$item->branchName}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <div class="row w-100 justify-content-center">
                            <div>
                                <button type="button" class="btn btn-primary btn_submit">تسجيل</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6 mr-3 border table-box" style="overflow-y:scroll ;height:50vh!important;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-right" scope="col">#</th>
                                <th class="text-right" scope="col">الرقم الوظيفي</th>
                                <th class="text-right" scope="col">الحالة</th>
                                <th class="text-right" scope="col">الوقت</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($presence as $row)

                            <tr>
                                <th class="text-right" scope="row">{{$loop->iteration}}</th>
                                <th class="text-right" scope="row">{{$row->employee_id}}</th>
                                <td class="text-right"><span
                                        class="{{$row->status=="C/In"?"badge badge-success":"badge badge-primary"}}">
                                        {{$row->status=="C/In"?"تسجيل دخول":"تسجيل خروج"}}
                                    </span> </td>
                                <td class="text-right">{{ $row->created_at->format('h:i') }}
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container-box conatiner-fluid">
            <div class="row justify-content-center" style="margin-top: 20%">

                <div class="lds-dual-ring"></div>
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
        Webcam.set({
            width:350,
            height:350,
            image_format:'jpeg',
            jpeg_quality:90
        })
        Webcam.attach("#camera")

        /*   */
        $(document).on('click','.btn_submit',function (event){
            var form_id = document.getElementById('form_submit');
            var form_data = new FormData(form_id);
          var image ="";
            Webcam.snap(function (data_uri){

               image = data_uri
                form_data.append("image",data_uri)
            })


            $.ajax({
                url:"/add-presences",
                method:"post",
                data:form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function (data){
                    if (data.status==false){
                        var errorMessage = "";
                        for (const error in data["data_validator"]) {
                            if (data["data_validator"].hasOwnProperty(error)) {
                                errorMessage += '<p>'+data["data_validator"][error]+'</p>';
                            }
                        }
                        Swal.fire({
                            title: "",
                            html: errorMessage,
                            type: "error",
                            showCancelButton: false,
                            confirmButtonText: 'موافق',
                            closeOnConfirm: true,
                            closeOnCancel: true
                        });
                    }
                    else if (data.status ==200) {



                        Swal.fire({
                            icon: 'success',
                            title: 'تم',
                            timer: 3000,
                            html: '<img class="image" src="'+image+'"/>',
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: 'Custom image',
                            showCancelButton: false,
                            showConfirmButton: false
                        })

                        setTimeout(function (){
                            $("#form_submit").trigger('reset');
                        $("#image").html('')
                        },5000)
                        $.ajax({
                            url:"/",
                            method:'get',
                            data:{"_token":'{{csrf_token()}}'},
                            success:function (response){
                            $('.table-box').html="";
                            $('.table-box').html(response)
                            }
                        })
                    }
                    else if(data.status ==504){
                        Swal.fire({
                            title: "خطأ",
                            icon:'error',
                            text: data.error,
                            type: "error",
                            showCancelButton: false,
                            confirmButtonText: 'موافق',
                            closeOnConfirm: true,
                            closeOnCancel: true
                        });
                    }
                    else if (data.status ==505){
                        Swal.fire({
                            title:data.message,
                            text: data.error,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'نعم!',
                            cancelButtonText:'الغاء'
                        }).then((result) => {
                            if (result.isConfirmed) {
                              form_data.append('comming_out',true)
                              form_data.append('_token','{{csrf_token()}}')
                                $.ajax({
                                    url:"/add-presences",
                                    method:"post",
                                    data:form_data,
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success:function (data){
                                        if (data.status==false){
                                            var errorMessage = "";
                                            for (const error in data["data_validator"]) {
                                                if (data["data_validator"].hasOwnProperty(error)) {
                                                    errorMessage += '<p>'+data["data_validator"][error]+'</p>';
                                                }
                                            }
                                            Swal.fire({
                                                title: "",
                                                html: errorMessage,
                                                type: "error",
                                                showCancelButton: false,
                                                confirmButtonText: 'موافق',
                                                closeOnConfirm: true,
                                                closeOnCancel: true
                                            });
                                        }
                                        else if (data.status ==200) {


                                            Swal.fire({
                                                icon: 'success',
                                                title: 'تم',
                                                timer: 3000,
                                                html: '<img class="image" src="'+image+'"/>',
                                                imageWidth: 400,
                                                imageHeight: 200,
                                                imageAlt: 'Custom image',
                                                showCancelButton: false,
                                                showConfirmButton: false
                                            })

                                            setTimeout(function (){
                                                $("#form_submit").trigger('reset');
                                                $("#image").html('')
                                            },5000)
                                            $.ajax({
                                                url:"/",
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
    })
    setTimeout(function (){
    $('.container-box').fadeOut();

    },2000)

    </script>
    <script>
        function showTime(){

        var date = new Date();
        var h = date.getHours(); // 0 - 23
        var m = date.getMinutes(); // 0 - 59
        var s = date.getSeconds(); // 0 - 59
        var session = "ص";

        if(h == 0){
            h = 12;
        }

        if(h > 12){
            h = h - 12;
            session = "م";
        }

        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;

        var time = h + ":" + m + ":" + s + " " + session;
        document.getElementById("MyClockDisplay").innerText = time;
        document.getElementById("MyClockDisplay").textContent = time;

        setTimeout(showTime, 1000);

    }

    showTime();
    function showDate(){
    var days = ['الأحد','الاثنين','الثلاثاء','الأربعاء','الخميس','الجمعة','السبت'];
        let now = new Date();



        var full_date = new Date();
        var y = full_date.getFullYear(); // 0 - 23
        var m = full_date.getMonth()+1; // 0 - 59
        var d = full_date.getDate(); // 0 - 59
        var day = days[full_date.getDay()];




        var time = day+ " " + y +"-" + m + "-" + d + " " ;

        document.getElementById("myDay").innerText = time;
        document.getElementById("myDay").textContent = time;

        setTimeout(showTime, 1000);

    }
    showDate()
    </script>
</body>

</html>