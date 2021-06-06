<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>

<body>

    <div class="container ">
        <h2>Presences</h2>
        @if (session()->has('message'))
        <div class="alert alert-success" role="alert">
           {{ session('message') }}
        </div>
        @endif
        <form action="{{ route('add-presences') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Emoloyee</label>
                <input type="text" class="form-control" id="employee_id" placeholder="Enter Emoloyee id"
                    name="employee_id">
                @error('employee_id')
                <span class="invalid-feedback" style="color:red">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" checked name="status" value="C/In" type="radio"
                        name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Come IN
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="status" value="C/Out" type="radio" name="flexRadioDefault"
                        id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Come Out
                    </label>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>