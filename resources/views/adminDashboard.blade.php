@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Welcome to Admin</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}

                    <div class="d-flex justify-content-center">
                        <a href="{{ route('users') }}">
                        <div class="users p-3 bg-danger m-1 text-white rounded-3">
                            <h6>Users</h6>
                            <h5>{{ count($users) }}</h5>
                        </div></a>

                        <a href="{{ route('messages') }}">
                        <div class="messages p-3 bg-success m-1 text-white rounded-3">
                            <h6>Messages</h6>
                            <h5>{{ count($messages) }}</h5>
                        </div></a>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>

    

</div>
@endsection
