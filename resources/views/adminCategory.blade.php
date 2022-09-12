@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @include('partials.message')

                <div class="card-header">
                    <a href="{{ route('adminAddCategory') }}" class="text-white btn btn-primary">Add Category</a>
                </div>

                <div class="card-body">
                    
                    <table class="table table-hover table-bordered">
                        
                        <thead>
                            <tr>
                                <th>Title</th>
                                
                                <th>Status</th>
                               
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="myTableBody">
                            @if (count($categories) > 0)

                            @foreach ($categories as $category)
                            <tr class="featured_outer">
                                <td>{{ $category->title }}</td>
                                
                                <td class="status">{!! $category->status == 'pending' ? '<span class="text-danger">Inactive</span>' : '<span class="text-success">Active</span>' !!}</td>
                                

                                @if ($category->status == 'pending')
                                    <td><a href="{{ route('updateCategoryStatus', ['activate', $category->id]) }}" class="btn btn-success btn-sm">Activate</a>
                                        <a href="{{ route('adminDeleteCategory', $category->id) }}" class="text-white btn btn-primary btn-sm">Delete</a>
                                    </td>
                                @else
                                    <td><a href="{{ route('updateCategoryStatus', ['deactivate', $category->id]) }}" class="btn btn-danger btn-sm">Deactivate</a>
                                        <a href="{{ route('adminDeleteCategory', $category->id) }}" class="text-white btn btn-primary btn-sm">Delete</a>
                                    </td>
                                @endif
                                
                            </tr>
                            @endforeach
                            
                            @else
                                <tr class="text-center"><td colspan="5">No data available</td></tr>
                            @endif
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


