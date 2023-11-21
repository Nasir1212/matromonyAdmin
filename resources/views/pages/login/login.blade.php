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
        @if (session('message'))
        <div class="alert    alert-danger ">
            {{ session('message') }}
        </div>
        @endif

        <div class="text-center">
            <img style="width: 5rem;height:5rem" src="{{URL::to("/asset/images/logo.png")}}" alt="">
        </div>
        <form action="/login" method="post">
            @csrf
        <div class="form-group">

          <label for="">Email</label>
          <input type="text" name="mail" class="form-control" placeholder="Enter Email " >
        </div>

        <div class="form-group">

            <label for="">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter Password " >
          </div>

          <div class="form-group">
            <a href="{{URL::to("/send_otp")}}" class="link-opacity-75-hover float-right">change password </a>
            <button type="submit" class="btn btn-success btn-block">Login</button>
          </div>
        </form>
    </div>
</div>
    @component("component.JSLink")@endcomponent
   
@yield('file_js')
</body>
</html>
