<div class="container w-75">
    <h3>{{$title}}</h3>
<div class="d-flex justify-content-between">
    <div class="">
        <p>Search: <input type="text" name="search" id="dashboar-search-input" class="search-bar" placeholder="Search..." style="font-size:16px;;"></p>
    </div>
</div>
    <a href="#" class="btn btn-primary">Add</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Numerical</th>
            <th>Name</th>
            <th>Categories</th>
            <th>Images</th>
            <th>Details</th>
            <th>Price</th>
            <th style="width:90px;">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($listDish))
            @foreach($listDish as $index => $dish)
            <tr colspan = "6">
                <td>{{$index++}}</td>
                <td>{{$dish->dish_name}}</td>
                <td>{{$dish->category_name}}</td>
                <td><img src="{{$dish->image_dish}}" alt="image" style="width:70%"></td>
                <td>{{$dish->details}}</td>
                <td>{{$dish->price}}</td>
                <td>
                    <a href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                    <a href="#" class="btn btn-success btn-sm"><i class="fa-solid fa-pencil"></i></a>
                </td>    
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
</div>
@section('css')
    <style>
        .container{
            margin-top: 150px
        }
    </style>
@endsection