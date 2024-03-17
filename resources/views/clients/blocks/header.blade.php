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
              <a class="nav-link active users-navbar-home" aria-current="page" href="{{route('home')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active users-navbar-contactus" aria-current="page" href="{{route('contact')}}">Contact us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active users-navbar-contactus" aria-current="page" href="{{route('about')}}">About us</a>
            </li>
            <li class="nav-item">
                {{-- <a class="nav-link active users-navbar-contactus" aria-current="page" href="{{route('pages')}}">Pages</a> --}}
            </li>
          </ul>
        </div>
      </div>
</div>