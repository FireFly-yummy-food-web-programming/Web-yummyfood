<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yummyfood restaurant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/admin/style-header.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/admin/style-sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/component/logo.css')}}">

    @yield('css')
</head>
<body>
    @include('admin.blocks.header')
    <main>
        <div class="row">
            <div class="admin-dashboard-sidebar col-md-2">
                @include('admin.blocks.sidebar')
            </div>
            <div class="col-md-10">   
                <div class="content">
                    @yield('content')
                    @yield('title')
                </div>
            </div>
        </div>
    </main>
        {{-- @include('clients.blocks.footer') --}}
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    @yield('js')
    @stack('script')
</body>
</html>