<div class="container">
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($listCategories))
                @foreach($listCategories as $index => $category)
                <tr colspan = "6">
                    <td>{{$index++}}</td>
                    <td>{{$category->category_name}}</td>
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
