<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @component("component.CSSLink")@endcomponent
    <title>matrimony</title>
</head>
<body class="">
    <div class="wrapper">
       
        @component("component.nav")@endcomponent
        @component("component.aside")@endcomponent
        <div class="content-wrapper">
            @yield("content")
        </div>

        @component("component.footer")@endcomponent

    </div>
    @component("component.JSLink")@endcomponent
   
@yield('file_js')
</body>
</html>