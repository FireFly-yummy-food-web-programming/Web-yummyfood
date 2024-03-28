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
    <a href="{{route('add-category')}}" class="btn btn-primary">Add</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Numerical</th>
                <th>Name</th>
                <th>Created_at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($listCategories))
                @foreach($listCategories as $index => $category)
                @if($category->deleted_at == NULL)
                <tr colspan = "6">
                    <td>{{$index+1}}</td>
                    <td>{{$category->category_name}}</td>
                    <td>{{$category->created_at}}</td>
                    <td>
                        <a href="{{route('edit-category',['id'=>$category->category_id])}}" class="btn btn-success btn-sm"><i class="fa-solid fa-pencil"></i></a>
                        <button type="button" class="btn btn-light border-white bg-white" onclick="handleDelete({{$category->category_id}})">
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
  
  <!-- Modal -->
<form action="" method="POST" id="deleteCategoryForm">
    @csrf
    {{-- @method('DELETE') --}}
    <div class="modal fade" id="delete_category_modal" tabindex="-1" aria-labelledby="delete_categoryLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="delete_categoryLabel">Delete</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this category?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
          </div>
        </div>
      </div>
</form>
{{-- Form confirm restoreCategoryForm --}}
<form action="" method="POST" id="restoreCategoryForm">
    @csrf
    <div class="modal fade" id="restore_category_modal" tabindex="-1" aria-labelledby="restore_categoryLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="restore_categoryLabel">Restore</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to restore this category?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Yes, Restore</button>
            </div>
          </div>
        </div>
      </div>
</form>
{{-- Trash listCategories --}}
<h3>Trash</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Numerical</th>
            <th>Name</th>
            <th>Deleted_at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($listCategories))
            @foreach($listCategories as $index => $category)
                @if($category->deleted_at != NULL)
                <tr colspan = "6">
                    <td>{{$index+1}}</td>
                    <td>{{$category->category_name}}</td>
                    <td>{{$category->deleted_at}}</td>
                    <td>
                        <a href="{{route('edit-category',['id'=>$category->category_id])}}" class="btn btn-success btn-sm"><i class="fa-solid fa-pencil"></i></a>
                        <button type="button" class="btn btn-light border-white bg-white" onclick="handleRestore({{$category->category_id}})">
                            <a href="#" class="btn btn-success btn-sm">Restore</a>
                        </button>
                       
                    </td>    
                </tr>
                @endif
            @endforeach
        @endif
    </tbody>
</table>
  @section('js')
            <script src="{{asset('assets/js/modaldelete.js')}}"></script>
  @endsection