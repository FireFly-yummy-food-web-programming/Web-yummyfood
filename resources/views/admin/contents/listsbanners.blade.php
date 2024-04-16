<div class="container">
    <h3>{{$title}}</h3>
    <div class="d-flex justify-content-between">
        <div class="">
            <p>Search: <input type="text" name="search" id="dashboar-search-input" class="search-bar" placeholder="Search..." style="font-size:16px;"></p>
        </div>
    </div>
    <a href="{{route('add-banner')}}" class="btn btn-primary">Add</a>
    <table class="table table-bordered"> 
        <thead>
            <tr>
                <th>Numerical</th>
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
                <th>Status</th>
                <th style="width:90px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($banners))
                @foreach($banners as $index => $banner)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$banner->name}}</td>
                    <td>
                        <img src="/storage/banners/{{ $banner->image }}" alt="image" style="width:70%">
                    </td>
                    <td>{{$banner->description}}</td>
                    <td>{{$banner->status}}</td>
                    <td>
                        <a href="{{route('edit-banner',['id'=>$banner->id])}}" class="btn btn-success btn-sm"><i class="fa-solid fa-pencil"></i></a>
                        <a href="{{route('soft-delete-banner',['id'=>$banner->id])}}" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<h3>Soft Deleted Banners</h3>
<table id="softDeletedBannersTable" class="table table-bordered">
    <thead>
        <tr>
            <th>Numerical</th>
            <th>Name</th>
            <th>Image</th>
            <th>Description</th>
            <th>Status</th>
            <th style="width:90px;">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($softDeletedBanners))
            @foreach($softDeletedBanners as $index => $banner)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$banner->name}}</td>
                    <td>
                        <img src="{{ asset('images/'. $banner->image) }}" alt="image" style="width:70%">
                    </td>
                    <td>{{$banner->description}}</td>
                    <td>{{$banner->status}}</td>
                    <td>
                        <a href="{{route('edit-banner',['id'=>$banner->id])}}" class="btn btn-success btn-sm"><i class="fa-solid fa-pencil"></i></a>
                        <a href="#" class="btn btn-danger btn-sm" data-id="{{ $banner->id }}"><i class="fa-solid fa-trash"></i></a>
                    </td>    
                </tr>
            @endforeach
        @endif
    </tbody>
</table> 
@section('js')
<script>
$(document).ready(function () {
    $('.btn-danger').click(function () {
        var bannerId = $(this).data('id');
        $.ajax({
            url: '/soft-delete-banner/' + bannerId,
            type: 'GET',
            success: function (response) {
                // Reload page or move data to soft deleted section
                location.reload(); // Reload page
                // Or move data to soft deleted section
                // var deletedBanner = $(this).parents('tr');
                // $('#softDeletedBannersTable tbody').append(deletedBanner); 
            }
        });
    });
});
</script>
@endsection