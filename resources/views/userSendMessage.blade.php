@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @include('partials.message')

                <div class="card-header d-flex justify-content-between">
                    <span>{{ __('Create Message') }}</span>
                    <a href="{{ route('userMessages') }}" class="btn btn-success">My Messages</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    
                    <form action="{{ route('sendMessage') }}" method="post">@csrf
                        <div class="row mb-3">
                            <input type="hidden" name="sender_id" value="{{ Auth::user()->id }}">
                            <label for="receiver" class="col-md-4 col-form-label text-md-end">Send to</label>

                            <div class="col-md-6">
                                <select id="" class="form-control @if ($errors->has('receiver')) is-invalid @endif" name="receiver" autocomplete="receiver" autofocus>
                                    <option value="">Select</option>
                                    @foreach ($admins as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                    @endforeach
                                    
                                </select>
                                
                                @if ($errors->has('receiver'))
                                    <p class="help-block" style="color:red; position: relative;">
                                        {{ $errors->first('receiver') }}
                                    </p>
                                @endif

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Message</label>

                            <div class="col-md-6">
                                <textarea id="" placeholder="Type here..." cols="30" rows="10" class="form-control @if ($errors->has('content')) is-invalid @endif" name="content" autocomplete="content" autofocus>{{ old('content') ? old('content') : '' }}</textarea>

                                @if ($errors->has('content'))
                                    <p class="help-block" style="color:red; position: relative;">
                                        {{ $errors->first('content') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send message') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
