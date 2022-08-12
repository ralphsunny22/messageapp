@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @include('partials.message')

                <div class="card-header">My Messages</div>

                <div class="card-body">
                    
                    <table class="table table-hover table-bordered">
                        
                        <thead>
                            <tr>
                                <th>Receiver</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Message</th>
                                
                            </tr>
                        </thead>
                        <tbody id="myTableBody">
                            @if (count($sent_messages) > 0)

                            @foreach ($sent_messages as $msg)
                            <tr class="featured_outer">
                                <td style="width: 15%;">{{ $msg->receiver->name }}</td>
                                <td style="width: 20%;">{{ $msg->created_at->format('F j, Y') }}</td>
                                <td style="width: 15%;">{{ $msg->created_at->format('g:i a') }}</td>
                                <td>{{ $msg->content }}</td>
                            </tr>
                            @endforeach
                            
                            @else
                                <tr class="text-center"><td colspan="5">No meessage available</td></tr>
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

