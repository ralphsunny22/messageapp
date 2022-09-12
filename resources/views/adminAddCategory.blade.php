@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @include('partials.message')

                <div class="card-header d-flex justify-content-between">
                    <span>{{ __('Add Category') }}</span>
                    <a href="{{ route('adminCategory') }}" class="btn btn-success">All Categories</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    
                    <form action="{{ route('adminAddCategory') }}" method="post">@csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="title" class="col-md-4 col-form-label text-md-start">Title</label>
                                <input type="text" name="title" class="form-control" value="">

                                @if ($errors->has('title'))
                                    <p class="help-block" style="color:red; position: relative;">
                                        {{ $errors->first('title') }}
                                    </p>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="col-md-4 col-form-label text-md-start">Status</label>
                                <select id="" class="form-control @if ($errors->has('status')) is-invalid @endif" name="status" autocomplete="status" autofocus>
                                    <option value="">Select</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    
                                </select>
                                
                                @if ($errors->has('status'))
                                    <p class="help-block" style="color:red; position: relative;">
                                        {{ $errors->first('status') }}
                                    </p>
                                @endif

                            </div>
                        </div>

                        

                        <div class="row mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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
