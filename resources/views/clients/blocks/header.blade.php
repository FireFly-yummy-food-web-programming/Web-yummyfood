<div class="header-top d-flex" >
    <div class="header-top-left">
        <div class="phone">
            <i class="fa-solid fa-phone" style="color: white; margin-top: 10px;" aria-hidden="true"></i>
            <p>0123455644</p>
        </div>
        <div class="email">
            <i class="fa-regular fa-envelope" style="color: white; margin-top: 10px;" aria-hidden="true"></i>
            <p>yummyrestaurant@yahoo.com</p>
        </div>
    </div>
    <div class='header-top-right'>
        <a href=''>
            <div class='header-top-right-bg '>
                <i class="fa-brands fa-twitter twitter-icon " aria-hidden='true'></i>
            </div>
        </a>
        <a href=''>
            <div class='header-top-right-bg '>
                <i class="fa-brands fa-facebook facebook-icon" aria-hidden='true'></i>
            </div>
        </a>
        <a href=''>
            <div class='header-top-right-bg '>
                <i class='fa-brands fa-instagram instagram-icon' aria-hidden='true'></i>
            </div>
        </a>
        <a href=''>
            <div class='header-top-right-bg'>
                <i class='fa-brands fa-github github-icon' aria-hidden='true'></i>
            </div>
        </a>
    </div>
</div>
<div class="header-navbarcontainer navbar navbar-expand-lg navbar-light">
    <div class="container-head">
        @include('components.logo')
        {{createLogo("#AD343E", "#474747")}}
    </div>
<div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active users-navbar-home" aria-current="page" href="{{ route('home') }}" style="padding-top: 50px;">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active users-navbar-contactus" aria-current="page" href="{{route('users.contact')}}" style="padding-top: 50px;">Contact us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active users-navbar-contactus" aria-current="page" href="#" style="padding-top: 50px;">About us</a>
            </li>
            @if (!session('logged_in'))
            <li class="nav-item">
                <a class="nav-link active users-navbar-contactus" aria-current="page" href="{{route('users.login')}}" style="padding-top: 50px;">Log in</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active users-navbar-contactus" aria-current="page" href="{{route('users.register')}}" style="padding-top: 50px;">Sign in</a>
            </li>
            
            @endif
            <div>
            @if (session('logged_in'))
            <li class="nav-item dropdown ">
                <h5 class="nav-link dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://tophinhanh.net/wp-content/uploads/2023/11/avatar-heo-de-thuong-10.jpg" alt="avatar" style="width: 50px;height:50px;border-radius:50%; margin-left:170px;">
                </h5>
                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                    <li style="padding-left: 15px;">Hello! <span style="color: blue">{{session('user_name')}}</span></li>
                    <li><a class="dropdown-item" href="{{route('users.logout') }}">Logout</a></li>
                    <li><a class="dropdown-item" href="{{route('users.list-favorites')}}">Favorite</a></li>
                    <li><a class="dropdown-item" href="{{route('users.history-order')}}">History order</a></li>
                </ul>
            </li>
            <li class="nav-item btn-showcart">
                <a class="btn btn-primary" href="{{ route('users.cart') }}" style="color: aliceblue; text-decoration: none"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span></a>
            </li>
            @endif
          </ul>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/header.js') }}"></script>