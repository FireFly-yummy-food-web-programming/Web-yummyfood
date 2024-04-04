<div class="sidebar position-fixed" style="padding: 20px">
    <div class="dashboard-sidebar-item">
        <i class="fa-solid fa-house" style="font-size: 25px; margin-right:8px;"></i>
        <a href="{{route('manage-contact')}}">Dashboard</a>
    </div>
    <div class="dashboard-sidebar-item">
        <i class="fa-solid fa-gear"  style="font-size: 25px; margin-right:8px;"></i>
        <a class="sidebar-button collapsed show" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-manage" aria-expanded="false" aria-controls="sidebar-manage">
        Manager
        </a>
        <ul id="sidebar-manage" class="sidebar-collapse collapse" aria-labelledby="flush-headingTwo">
            <li class="sidebar-item"><a href="{{route('manage-orders')}}">Orders</a></li>
            <li class="sidebar-item"><a href="{{route('manage-categories')}}">Categories</a></li>
            <li class="sidebar-item"><a href="{{route('manage-dish')}}">Dish</a></li>
            <li class="sidebar-item"><a href="{{route('manage-banners')}}">Banner</a></li>
            <li class="sidebar-item"><a href="{{route('manage-users')}}">Users</a></li>
        </ul>
    </div>
    <div class="dashboard-sidebar-item">
        <i class="fa-regular fa-clipboard" style="font-size: 25px; margin-right:15px;"></i>
        <a href="">Form</a>
    </div>
    <div class="dashboard-sidebar-item">
        <i class="fa-solid fa-chart-area" style="font-size: 25px; margin-right:8px;"></i>
        <a href="">Charts</a>
    </div>
</div>
