<div class="container">
    <h3>{{$title}}</h3>
<div class="d-flex justify-content-between">
    <div class="">
        <p>Search: <input type="text" name="search" id="dashboar-search-input" class="search-bar" placeholder="Search..." style="font-size:16px;;"></p>
    </div>
</div>
@if(session("msg"))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
    <a href="{{route('add-dish')}}" class="btn btn-primary">Add</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Numerical</th>
                <th>Name</th>
                <th>Categories</th>
                <th>Images</th>
                <th>Details</th>
                <th>Price</th>
                <th>Discount</th>
                <th style="width: 120px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($listDish))
                @foreach($listDish as $index => $dish)
                @if($dish->deleted_at == NULL)
                <tr colspan = "6">
                    <td>{{$index+1}}</td>
                    <td>{{$dish->dish_name}}</td>
                    <td>{{$dish->category_name}}</td>
                    <td><img src="{{ asset('storage/images/'. $dish->image_dish) }}" alt="image" style="width:70%">
                    </td>
                    <td>{{$dish->details}}</td>
                    <td>{{$dish->price}}</td>
                    <td>{{$dish->discount}}</td>
                    <td>
                        {{-- {{route('edit-dish',['id'=>$dish->dish_id])}} --}}
                        <a href="{{route('edit-dish',['id'=>$dish->dish_id])}}" class="btn btn-success btn-sm"><i class="fa-solid fa-pencil"></i></a>
                        <button type="button" class="btn btn-light border-white bg-white" onclick="handleDeleteDish({{$dish->dish_id}})">
                            <a href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                        </button>
                    </td>    
                </tr>
                @endif
                @endforeach
            @endif
        </tbody>
    </table>
</div>
<form action="" method="POST" id="deleteDishForm">
    @csrf
    {{-- @method('DELETE') --}}
    <div class="modal fade" id="delete_dish_modal" tabindex="-1" aria-labelledby="delete_dishLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="delete_dishLabel">Delete</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this dish?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
          </div>
        </div>
      </div>
</form>
{{-- Form confirm restoredishForm --}}
<form action="" method="POST" id="restoreDishForm">
    @csrf
    <div class="modal fade" id="restore_dish_modal" tabindex="-1" aria-labelledby="restore_dishLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="restore_dishLabel">Restore</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to restore dish?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Yes, Restore</button>
            </div>
          </div>
        </div>
      </div>
</form>
@section('js')
<script src="{{asset('assets/js/modaldelete.js')}}"></script>
@endsection
