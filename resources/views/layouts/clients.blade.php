<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yummyrestaurant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/clients/style-header-navbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/clients/style-footer.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/component/logo.css')}}">

    @yield('css')
</head>
<body>
    @include('clients.blocks.header')
    {{-- @include('components.logo') --}}
    <main class="py-5">
        <div class="container">
            <div class="row">
                <div class="content">
                    @yield('content')
                    {{-- @yield('title') --}}
                </div>
            </div>
        </div>
    </main>
        @include('clients.blocks.footer')
    <script src="{{asset('assets/admin/js/bootstrap.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    @yield('js')
    @stack('script')
</body>
</html>