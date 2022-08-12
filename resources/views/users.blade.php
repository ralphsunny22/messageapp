@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @include('partials.message')

                <div class="card-header">Users</div>

                <div class="card-body">
                    
                    <table class="table table-hover table-bordered">
                        <select name="filter" id="filter" class="form-control mb-3" style="width: 20%">
                            <option value="">Filter</option>
                            <option value="Pending">Pending</option>
                            <option value="Active">Active</option>
                        </select>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Status</th>
                                <th>Date Joined</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="myTableBody">
                            @if (count($users) > 0)

                            @foreach ($users as $user)
                            <tr class="featured_outer">
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td class="status">{!! $user->status == 'pending' ? '<span class="text-danger">Pending</span>' : '<span class="text-success">Active</span>' !!}</td>
                                <td>{{ $user->created_at }}</td>

                                @if ($user->status == 'pending')
                                    <td><a href="{{ route('updateUserStatus', ['activate', $user->id]) }}" class="btn btn-success btn-sm">Activate</a></td>
                                @else
                                    <td><a href="{{ route('updateUserStatus', ['deactivate', $user->id]) }}" class="btn btn-danger btn-sm">Deactivate</a></td>
                                @endif
                                
                            </tr>
                            @endforeach
                            
                            @else
                                <tr class="text-center"><td colspan="5">No user available</td></tr>
                            @endif
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#filter').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        // console.log(valueSelected)

        // Loop through the tr
        $(".featured_outer").each(function(){
      
            var tds = $(this).find("td.status")
            //console.log(tds.text()) //Active, Pending
            
            // If the list item does not contain the text phrase fade it out
            if (tds.text().search(new RegExp(valueSelected, "i")) < 0) {
                $(this).fadeOut();

            // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).show();
            }
        });
    });
});
</script>
