<div class="row d-flex justify-content-md-center dashboard-content" style="margin-top: 110px;">
    <div class="col-md-3 dashboard-content-user bg-primary rounded-3 p-3 m-3" style="width: 30%">
        <h4>Number of users</h4>
        <h5>1234</h5>
        <p>Increased by 30%</p>
    </div>
    <div class="col-md-3 ashboard-content-total-income bg-success rounded-3 p-3 m-3" style="width: 30%">
        <h4>Weakly orders</h5>
        <h5>1234</h5>
        <p>Decreased by 10%</p>
    </div>
    <div class="col-md-3 dashboard-content-total-income bg-info rounded-3 p-3 m-3" style="width: 30%">
        <h4>Revenue</h4>
        <h5>1234</h5>
        <p>Increased by 30%</p>
    </div>
    <div class="container w-75">
        <h3>{{$title}}</h3>
    <div class="d-flex justify-content-between">
        <div class="">
            <p>Search: <input type="text" name="search" id="dashboar-search-input" class="search-bar" placeholder="Search..." style="font-size:16px;;"></p>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width:5%;">Numerical</th>
                <th style="width:40%;">Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Subject</th>
                <th style="width:100%;">Message</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($contactsList))
                @foreach($contactsList as $index => $contact)
                <tr colspan="6">
                    <td>{{$index+1}}</td>
                    <td>{{$contact->Name}}</td>
                    <td>{{$contact->Email}}</td>
                    <td>{{$contact->Phone}}</td>
                    <td>{{$contact->subject}}</td>
                    <td>{{$contact->message}}</td>
                    <form action="{{ route('contacts.updateStatus') }}" method="POST">
                        <td>
                            <select name="status" onchange="this.form.submit()">
                                <option value="{{$contact->status}}" id="status">{{$contact->status}}</option>
                                @if(($contact->status == 'Pending'))
                                    <option id="status-processed" value="Processed">Processed</option>
                                @endif
                                @if(($contact->status == 'Processed'))
                                    <option id="status-pending" value="Pending">Pending</option>
                                @endif
                            </select>
                            @csrf
                            <input type="hidden" name="contact_id" value="{{$contact->contact_id}}">
                        </td>
                    </form>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    </div>
</div>
{{-- <script>
    var updateStatusUrl = '{{ route("contacts.updateStatus") }}';
</script>
<script src="{{ asset('assets/js/contacts.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
@section('css')
    <style>
        #statusSelect{
            border: 2px solid green;
            outline: none;
            border-radius: 5px;
        }
    </style>
@endsection

@section('js')

@endsection