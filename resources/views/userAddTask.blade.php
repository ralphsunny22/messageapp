@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @include('partials.message')

                <div class="card-header d-flex justify-content-between">
                    <span>{{ __('Add Task') }}</span>
                    <a href="{{ route('userTask') }}" class="btn btn-success">My Tasks</a>
                </div>

                <div class="card-body">
                    
                    
                    <form action="{{ route('userAddTaskPost') }}" method="post">@csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="title" class="col-md-4 col-form-label text-md-start">Title</label>
                                <input type="text" name="title" class="form-control @if ($errors->has('title')) is-invalid @endif" value="">

                                @if ($errors->has('title'))
                                    <p class="help-block" style="color:red; position: relative;">
                                        {{ $errors->first('title') }}
                                    </p>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="category" class="col-md-4 col-form-label text-md-start">Category</label>
                                <select id="" class="form-control @if ($errors->has('category')) is-invalid @endif" name="category" autocomplete="category" autofocus>
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                    
                                </select>
                                
                                @if ($errors->has('category'))
                                    <p class="help-block" style="color:red; position: relative;">
                                        {{ $errors->first('category') }}
                                    </p>
                                @endif

                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="deadline" class="col-md-4 col-form-label text-md-start">Deadline</label>
                                <input type="date" name="deadline" class="form-control @if ($errors->has('deadline')) is-invalid @endif" value="">

                                @if ($errors->has('deadline'))
                                    <p class="help-block" style="color:red; position: relative;">
                                        {{ $errors->first('deadline') }}
                                    </p>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="col-md-4 col-form-label text-md-start">Status</label>
                                <select id="" class="form-control @if ($errors->has('status')) is-invalid @endif" name="status" autocomplete="status" autofocus>
                                    <option value="">Select</option>
                                    <option value="pending">Pending</option>
                                    <option value="done">Done</option>
                                    <option value="overdue">Over Due</option>
                                    
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
