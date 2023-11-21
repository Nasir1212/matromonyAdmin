<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @component("component.CSSLink")@endcomponent
    <title>matrimony</title>
</head>
<body class="d-flex justify-content-center align-items-center">
   
<div class="card" style="width:20rem;height:100%;margin-top: 10rem ">
    <div class="card-body">

        <div class="text-center">
            <img style="width: 5rem;height:5rem" src="{{URL::to("/asset/images/logo.png")}}" alt="">
        </div>

        {{-- @if (session('message')) --}}
        <div class="alert    alert-success ">
            {{-- {{ session('message') }} --}}
            We have sent OTP on your  email 
        </div>
        {{-- @endif --}}



        <form action="{{URL::to("/checking_otp")}}" method="post">
            @csrf
        <div class="form-group">

            <label for="">OTP</label>
            <input type="OTP" name="otp" class="form-control" placeholder="Enter OTP " >
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-success btn-block">Submit</button>
          </div>
        </form>
    </div>
</div>
    @component("component.JSLink")@endcomponent
   
@yield('file_js')
</body>
</html>
