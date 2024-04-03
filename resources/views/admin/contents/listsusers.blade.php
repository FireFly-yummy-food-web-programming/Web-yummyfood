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
    <a href="{{route('add-users')}}" class="btn btn-primary">Add</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Numerical</th>
                <th>Name</th>
                <th>Username</th>
                <th>Password</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Role</th>
                <th style="width:90px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($listUsers))
                @foreach($listUsers as $index => $users)
                    @if(!$users->deleted_at)
                    <tr colspan="6">
                        <td>{{$index+1}}</td>
                        <td>{{$users->Name}}</td>
                        <td>{{$users->Username}}</td>
                        <td>{{ substr($users->Password, 0, 10) . '...' }}</td>
                        <td>{{$users->Phone}}</td>
                        <td>{{$users->Email}}</td>
                        <td>{{$users->role}}</td>
                        <td>
                            <a href="{{route('edit-users',['id'=>$users->user_id])}}" class="btn btn-success btn-sm"><i class="fa-solid fa-pencil"></i></a>
                            <button type="button" class="btn btn-light border-white bg-white" onclick="handleDelete({{$users->user_id}})">
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
<form action="" method="POST" id="deleteUsersForm">
    @csrf
    {{-- @method('DELETE') --}}
    <div class="modal fade" id="delete_users_modal" tabindex="-1" aria-labelledby="delete_usersLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="delete_usersLabel">Delete</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{--<p>Are you sure you want to delete {{$users->Name}} users?</p>--}}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
          </div>
        </div>
      </div>
</form>

@section('js')
<script>
    function handleDelete(id) {
        var form = document.getElementById('deleteUsersForm');
        form.action = '/admin/delete-users/' + id;
        $('#delete_users_modal').modal('show');
        // console.log(form.action);
    }
</script>
@endsection
 